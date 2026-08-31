<?php

namespace App\Http\Controllers\Employee\Orders;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a newly created order.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'lead_id' => 'required|exists:leads,id',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required',
                'items.*.product_name' => 'required|string|max:255',
                'items.*.quantity' => 'required|numeric|min:1',
                'items.*.unit_price' => 'required|numeric|min:0',
                'items.*.discount' => 'nullable|numeric|min:0|max:100',
                'items.*.tax_rate' => 'nullable|numeric|min:0|max:100',
                'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
                'order_date' => 'nullable|date',
                'notes' => 'nullable|string'
            ]);

            $lead = Leads::findOrFail($validated['lead_id']);

            // Calculate totals
            $subTotal = 0;
            $totalDiscount = 0;
            $totalTax = 0;
            $totalAmount = 0;

            foreach ($validated['items'] as $item) {
                $itemSubtotal = $item['quantity'] * $item['unit_price'];
                $discountAmount = $itemSubtotal * (($item['discount'] ?? 0) / 100);
                $afterDiscount = $itemSubtotal - $discountAmount;
                $taxAmount = $afterDiscount * (($item['tax_rate'] ?? 0) / 100);
                $itemTotal = $afterDiscount + $taxAmount;

                $subTotal += $itemSubtotal;
                $totalDiscount += $discountAmount;
                $totalTax += $taxAmount;
                $totalAmount += $itemTotal;
            }

            // Create order
            $order = Orders::create([
                'order_number' => 'ORD-' . str_pad(Orders::max('id') + 1, 6, '0', STR_PAD_LEFT),
                'lead_id' => $validated['lead_id'],
                'taken_by' => Auth::id(),
                'order_date' => $validated['order_date'] ?? now(),
                'order_status' => $validated['status'],
                'total_amount' => $subTotal,
                'total_discount' => $totalDiscount,
                'total_tax' => $totalTax,
                'final_amount' => $totalAmount,
                'payment_status' => 'pending',
                'shipping_address' => null,
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create order items
            foreach ($validated['items'] as $item) {
                $itemSubtotal = $item['quantity'] * $item['unit_price'];
                $discountAmount = $itemSubtotal * (($item['discount'] ?? 0) / 100);
                $afterDiscount = $itemSubtotal - $discountAmount;
                $taxAmount = $afterDiscount * (($item['tax_rate'] ?? 0) / 100);
                $itemTotal = $afterDiscount + $taxAmount;

                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    // 'discount' => $item['discount'] ?? 0,
                    // 'tax_rate' => $item['tax_rate'] ?? 0,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully!',
                'order' => $order->load('items')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified order.
     */
    public function update(Request $request, Orders $order)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'status' => 'sometimes|in:pending,confirmed,processing,shipped,delivered,cancelled',
                'order_date' => 'nullable|date',
                'notes' => 'nullable|string',
                'shipping_address' => 'nullable|string',
                'items' => 'sometimes|array',
                'items.*.id' => 'nullable|exists:order_items,id',
                'items.*.product_name' => 'required|string|max:255',
                'items.*.quantity' => 'required|numeric|min:1',
                'items.*.unit_price' => 'required|numeric|min:0',
                'items.*.discount' => 'nullable|numeric|min:0|max:100',
                'items.*.tax_rate' => 'nullable|numeric|min:0|max:100',
            ]);

            // Update order details
            if (isset($validated['status'])) {
                $order->status = $validated['status'];
            }
            if (isset($validated['order_date'])) {
                $order->order_date = $validated['order_date'];
            }
            if (isset($validated['notes'])) {
                $order->notes = $validated['notes'];
            }
            if (isset($validated['shipping_address'])) {
                $order->shipping_address = $validated['shipping_address'];
            }

            // Update items if provided
            if (isset($validated['items'])) {
                // Get existing item IDs
                $existingItemIds = $order->items->pluck('id')->toArray();
                $updatedItemIds = [];

                $subTotal = 0;
                $totalDiscount = 0;
                $totalTax = 0;
                $totalAmount = 0;

                foreach ($validated['items'] as $itemData) {
                    $itemSubtotal = $itemData['quantity'] * $itemData['unit_price'];
                    $discountAmount = $itemSubtotal * (($itemData['discount'] ?? 0) / 100);
                    $afterDiscount = $itemSubtotal - $discountAmount;
                    $taxAmount = $afterDiscount * (($itemData['tax_rate'] ?? 0) / 100);
                    $itemTotal = $afterDiscount + $taxAmount;

                    if (isset($itemData['id']) && in_array($itemData['id'], $existingItemIds)) {
                        // Update existing item
                        $item = OrderItems::find($itemData['id']);
                        if ($item) {
                            $item->update([
                                'product_name' => $itemData['product_name'],
                                'quantity' => $itemData['quantity'],
                                'unit_price' => $itemData['unit_price'],
                                'discount' => $itemData['discount'] ?? 0,
                                'tax_rate' => $itemData['tax_rate'] ?? 0,
                                'total_price' => $itemTotal,
                            ]);
                            $updatedItemIds[] = $itemData['id'];
                        }
                    } else {
                        // Create new item
                        $item = OrderItems::create([
                            'order_id' => $order->id,
                            'product_name' => $itemData['product_name'],
                            'quantity' => $itemData['quantity'],
                            'unit_price' => $itemData['unit_price'],
                            'discount' => $itemData['discount'] ?? 0,
                            'tax_rate' => $itemData['tax_rate'] ?? 0,
                            'total_price' => $itemTotal,
                        ]);
                        $updatedItemIds[] = $item->id;
                    }

                    $subTotal += $itemSubtotal;
                    $totalDiscount += $discountAmount;
                    $totalTax += $taxAmount;
                    $totalAmount += $itemTotal;
                }

                // Delete items that were removed
                $itemsToDelete = array_diff($existingItemIds, $updatedItemIds);
                if (!empty($itemsToDelete)) {
                    OrderItems::whereIn('id', $itemsToDelete)->delete();
                }

                $order->total_amount = $subTotal;
                $order->discount_amount = $totalDiscount;
                $order->final_amount = $totalAmount;
            }

            $order->save();

            DB::commit();
            return redirect('/employee/leads/' . $order->lead_id .'/edit');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified order.
     */
    public function destroy(Orders $order)
    {
        try {
            DB::beginTransaction();

            // Delete order items
            $order->items()->delete();

            // Delete order
            $order->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Orders $order)
    {
        return view('employee.orders.edit', compact('order'));
    }

    /**
     * Display the specified order.
     */
    public function show(Orders $order)
    {
        return view('employee.orders.show', compact('order'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 1) {
            return response()->json([]);
        }


        try {
            $products = Products::where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
                // ->orWhere('sku', 'LIKE', "%{$query}%")
                // ->orWhere('description', 'LIKE', "%{$query}%");
            })
                ->limit(10)
                ->get(['id', 'name', 'sku', 'selling_price']);

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([]);
        }
    }
}
