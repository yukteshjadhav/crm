<?php

namespace App\Http\Controllers\Employee\Leads;

use App\Models\User;
use App\Models\City;
use App\Models\Leads;
use App\Models\State;
use App\Models\Source;
use App\Models\Orders;
use App\Models\Country;
use App\Models\Products;
use App\Models\OrderItems;
use App\Models\LeadStatus;
use App\Models\LeadAction;
use App\Models\LeadHistory;
use App\Models\LeadProfileChange;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LeadStatusDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadsController extends Controller
{
    # Define Base view
    protected $view = 'employee.leads.';

    # Bind Leads model
    protected $leads;

    # Bind LeadAction model
    protected $leadAction;

    # Bind LeadHistory model
    protected $leadHistory;

    # Bind LeadProfileChange model
    protected $leadProfileChange;

    public function __construct(
        Leads                   $leads,
        LeadAction              $leadAction,
        LeadHistory             $leadHistory,
        LeadProfileChange       $leadProfileChange
    ) {
        $this->leads                = $leads;
        $this->leadAction           = $leadAction;
        $this->leadHistory          = $leadHistory;
        $this->leadProfileChange    = $leadProfileChange;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get filter values
        $statusFilter = $request->get('status', 'all');
        $counselorFilter = $request->get('counselor', 'all');
        $searchTerm = $request->get('search', '');
        $date_from = $request->get('date_from', '');
        $date_to = $request->get('date_to', '');

        // Base query - only show leads assigned to current user
        $query = $this->leads->with(['assignedTo', 'status', 'state', 'city', 'source'])
            ->where('assigned_to', Auth::id());

        if ($date_from && $date_to) {
            $query->whereDate('created_at', '>=', $date_from)
                ->whereDate('created_at', '<=', $date_to);
        } elseif ($date_from) {
            $query->whereDate('created_at', '>=', $date_from);
        } elseif ($date_to) {
            $query->whereDate('created_at', '<=', $date_to);
        }

        // Apply status filter
        if ($statusFilter !== 'all') {
            $query->whereHas('status', function ($q) use ($statusFilter) {
                $q->where('name', $statusFilter);
            });
        }

        // Apply counselor filter (if admin, can filter by counselor)
        if ($counselorFilter !== 'all' && Auth::user()->is_admin) {
            $query->where('assigned_to', $counselorFilter);
        }

        // Apply search filter
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('full_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('phone_number', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('alternate_phone', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('id', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Get leads with pagination
        $leads = $query->orderBy('created_at', 'DESC')->paginate(10);

        // Get total count for display
        $totalLeads = $this->leads->where('assigned_to', Auth::id())->count();

        // Get all statuses for filter
        $statuses = LeadStatus::all();

        // Get counselors for filter (if admin)
        $counselors = collect();
        if (Auth::user()->is_admin) {
            $counselors = User::whereHas('roles', function ($q) {
                $q->where('name', 'counselor');
            })->get();
        }

        // Get sources for filter
        $sources = Source::all();

        return view($this->view . 'index', compact(
            'leads',
            'totalLeads',
            'statuses',
            'counselors',
            'sources',
            'statusFilter',
            'counselorFilter',
            'searchTerm'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'         => 'required',
            'phone_number'      => 'required|string|max:20',
            'email'             => 'nullable|email|max:255',
            'remark'            => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Validation failed.',
                'errors'    => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $assignTo = Auth::id();

            if ($request->email) {
                $leadCheck = $this->leads->where('phone_number', $request->phone_number)->orWhere('email', $request->email)->first();
                if ($leadCheck) {
                    DB::commit();
                    $success = 'Already Added.';
                    return response()->json([
                        'status'    => false,
                        'message'   => $success,
                        'error'     => 'Something went wrong while creating the lead.'
                    ], 500);
                }
            } else {
                $leadCheck = $this->leads->where('phone_number', $request->phone_number)->first();
                if ($leadCheck) {
                    DB::commit();
                    $success = 'Already Added.';
                    return response()->json([
                        'status'    => false,
                        'message'   => $success,
                        'error'     => 'Something went wrong while creating the lead.'
                    ], 500);
                }
            }

            $lead = $this->leads->create([
                'assigned_to'       => $assignTo,
                'full_name'         => $request->full_name,
                'phone_number'      => $request->phone_number,
                'email'             => $request->email,
                'country_id'        => null,
                'state_id'          => null,
                'city_id'           => null,
                'pincode'           => null,
                'source_id'         => 1,
                'lead_status_id'    => 1,
            ]);

            $this->leadProfileChange->create([
                'lead_from'         => 1,
                'lead_f_status_id'  => 1,
                'lead_to'           => $assignTo,
                'lead_t_status_id'  => 1,
                'lead_id'           => $lead->id,
            ]);

            $remark = 'New Lead';
            if (!empty($request->remark)) {
                $remark .= ' & Lead Remark : ' . $request->remark;
            }

            $historyData = [
                'lead_updated_by'          => $assignTo,
                'lead_status_id'        => 1,
                'lead_status_detail_id' => null,
                'date'                  => currentDate(),
                'time'                  => currentTime(),
                'remark'                => $remark,
                'lead_id'               => $lead->id,
            ];

            $this->leadHistory->create($historyData);

            $this->leadAction->create([
                'lead_updated_by'       => $assignTo,
                'lead_status_id'        => 1,
                'lead_status_detail_id' => null,
                'date'                  => currentDate(),
                'time'                  => currentTime(),
                'remark'                => $remark,
                'lead_id'               => $lead->id,
            ]);

            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   => 'Lead created successfully.',
                'data'      => [
                    'lead_id' => $lead->id,
                    'name'    => $lead->full_name,
                    'mobile'  => $lead->phone_number,
                ]
            ], 200);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'status'    => false,
                'message'   => 'Something went wrong while creating the lead.',
                'error'     => config('app.debug') ? $th->getMessage() : null
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leads $lead)
    {
        // Check if the lead belongs to the current user or user is admin
        if ($lead->assigned_to !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        // Get all required data for dropdowns - EAGER LOAD orders with items
        $statuses = LeadStatus::all();
        $sources = Source::all();
        $countries = Country::all();
        $states = State::whereId(21)->get();
        $cities = City::where('state_id', 21)->orderBy('name', 'ASC')->get();
        $product = Products::first();

        $histories             = LeadHistory::where('lead_id', $lead->id)->orderBy('id', 'DESC')->paginate(5);


        // Eager load the orders relationship with items
        $lead->load(['orders' => function ($query) {
            $query->where('order_status', '!=', 'cancelled')
                ->orderBy('created_at', 'desc');
        }, 'orders.items']);

        return view($this->view . 'edit', compact(
            'lead',
            'statuses',
            'sources',
            'countries',
            'states',
            'cities',
            'product',
            'histories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        DB::beginTransaction();
        $lead_data = [
            'full_name'           => $request->full_name,
            'phone_number'        => $request->phone_number,
            'alternate_phone'     => $request->alternate_phone,
            'email'               => $request->email,
            'country_id'          => $request->country_id,
            'state_id'            => $request->state_id,
            'city_id'             => $request->city_id,
            'pincode'             => $request->pincode,
            'address'             => $request->address,
            'lead_status_id'      => $request->lead_status_id,
        ];


        $this->leads->whereId($id)->update($lead_data);
        $data = [
            'lead_updated_by'                 => Auth::id(),
            'lead_status_id'                  => $request->lead_status_id,
            'lead_status_detail_id'           => $request->lead_status_detail_id,
            'date'                            => dateSave($request->date),
            'time'                            => timeSave($request->time),
            'remark'                          => $request->remark,
            'lead_id'                         => $id,
        ];

        $leadActionCheck = $this->leadAction->where('lead_id', $id)->orderBy('id', 'DESC')->first();

        if (isset($leadActionCheck)) {
            $leadAction = $this->leadAction->where('lead_id', $id)->first();
            $leadFrom = $leadAction->lead_updated_by;
            $lead_F_Status_id = $leadAction->lead_status_id;
            $this->leadAction->whereId($leadActionCheck->id)->update($data);
        } else {
            $leadFrom = Auth::id();
            $lead_F_Status_id = $request->lead_status_id;
            $this->leadAction->create($data);
        }
        $data_history = [
            'lead_updated_by'                    => Auth::id(),
            'lead_status_id'                  => $request->lead_status_id,
            'lead_status_detail_id'           => $request->lead_status_detail_id,
            'date'                            => dateSave($request->date),
            'time'                            => $request->time,
            'remark'                          => $request->remark,
            'lead_id'                         => $id,
        ];
        $this->leadHistory->create($data_history);

        $data_profile = [
            'lead_from'                  => $leadFrom,
            'lead_f_status_id'           => $lead_F_Status_id,
            'lead_to'                    => Auth::id(),
            'lead_t_status_id'           => $request->lead_status_id,
            'lead_id'                    => $id,
        ];
        $this->leadProfileChange->create($data_profile);

        DB::commit();

        return redirect()->route('employee.leads.index')
            ->with('success', 'Lead updated successfully!');

        DB::rollBack();
    }

    /**
     * Handle order items for the lead
     */
    private function handleOrderItems(Request $request, Leads $lead)
    {
        // Process existing order items
        if ($request->has('orders')) {
            foreach ($request->orders as $orderData) {
                if (isset($orderData['items'])) {
                    foreach ($orderData['items'] as $itemData) {
                        if (isset($itemData['id']) && $itemData['id']) {
                            // Update existing item
                            $item = OrderItems::find($itemData['id']);
                            if ($item) {
                                $item->update([
                                    'product_name' => $itemData['product_name'],
                                    'quantity' => $itemData['quantity'],
                                    'unit_price' => $itemData['unit_price'],
                                    'discount' => $itemData['discount'] ?? 0,
                                    'tax_rate' => $itemData['tax_rate'] ?? 0,
                                ]);
                                $this->recalculateItemTotal($item);
                            }
                        }
                    }
                }
            }
        }

        // Process new items
        if ($request->has('new_items')) {
            // Find or create an order for this lead
            $order = Orders::firstOrCreate(
                ['lead_id' => $lead->id, 'order_status' => 'pending'],
                [
                    'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid()),
                    'order_date' => $request->order_date ?? date('Y-m-d'),
                    'created_by' => Auth::id(),
                    'total_amount' => 0,
                    'taken_by' => Auth::id()
                ]
            );

            foreach ($request->new_items as $itemData) {
                if (!empty($itemData['product_name']) && $itemData['quantity'] > 0) {
                    $item = OrderItems::create([
                        'order_id' => $order->id,
                        'product_id' => 1,
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $itemData['unit_price'] ?? 0,
                        // 'discount' => $itemData['discount'] ?? 0,
                        // 'tax_rate' => $itemData['tax_rate'] ?? 0,
                    ]);
                    $this->recalculateItemTotal($item);
                }
            }

            // Update order totals
            $this->recalculateOrderTotal($order);
        }
    }

    /**
     * Recalculate item total
     */
    private function recalculateItemTotal(OrderItems $item)
    {
        $subtotal = $item->quantity * $item->unit_price;
        $discountAmount = $subtotal * ($item->discount / 100);
        $afterDiscount = $subtotal - $discountAmount;
        $taxAmount = $afterDiscount * ($item->tax_rate / 100);
        $total = $afterDiscount + $taxAmount;

        $item->update([
            'total_price' => $total,
            'tax_amount' => $taxAmount,
        ]);
    }

    /**
     * Recalculate order total
     */
    private function recalculateOrderTotal(Orders $order)
    {
        $items = $order->items;
        $subTotal = 0;
        $totalDiscount = 0;
        $totalTax = 0;
        $grandTotal = 0;

        foreach ($items as $item) {
            $itemSubtotal = $item->quantity * $item->unit_price;
            $discountAmount = $itemSubtotal * ($item->discount / 100);
            $afterDiscount = $itemSubtotal - $discountAmount;
            $taxAmount = $afterDiscount * ($item->tax_rate / 100);
            $total = $afterDiscount + $taxAmount;

            $subTotal += $itemSubtotal;
            $totalDiscount += $discountAmount;
            $totalTax += $taxAmount;
            $grandTotal += $total;
        }

        $order->update([
            'sub_total' => $subTotal,
            'discount' => $totalDiscount,
            'tax_amount' => $totalTax,
            'total_amount' => $grandTotal,
            'balance_amount' => $grandTotal - $order->paid_amount,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getStatusDetails($statusId)
    {
        try {
            // Get the status details
            $details = LeadStatusDetails::where('lead_status_id', $statusId)
                ->where('status', 1)
                ->orderBy('name')
                ->get();

            // Get the current lead's selected detail (if editing)
            $selectedDetailId = null;
            if (request()->has('lead_id')) {
                $lead = Leads::find(request()->lead_id);
                if ($lead) {
                    $selectedDetailId = $lead->lead_status_detail_id;
                }
            }

            return response()->json([
                'success' => true,
                'details' => $details,
                'selected_detail_id' => $selectedDetailId
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch status details: ' . $e->getMessage()
            ], 500);
        }
    }
}
