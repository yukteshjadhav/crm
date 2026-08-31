<?php

namespace App\Http\Controllers\API;

use App\Models\Leads;
use App\Models\LeadAction;
use App\Models\LeadHistory;
use App\Models\LeadProfileChange;

use App\Traits\APIMasterTrait;
use App\Events\NewLeadAssigned;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class LeadController extends BaseController
{
    use APIMasterTrait;

    protected $lead;
    protected $leadAction;
    protected $leadHistory;
    protected $leadProfileChange;

    public function __construct(
        Leads $lead,
        LeadAction $leadAction,
        LeadHistory $leadHistory,
        LeadProfileChange $leadProfileChange
    ) {
        $this->lead = $lead;
        $this->leadAction = $leadAction;
        $this->leadHistory = $leadHistory;
        $this->leadProfileChange = $leadProfileChange;
    }

    public function whatsappLead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'mobile'    => 'required|string|max:20',
            'email'     => 'nullable|email|max:255',
            'remark'    => 'nullable|string',
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

            $assignTo = $this->activeUser();
            if (!$assignTo) {
                $assignTo = 1;
            }

            if ($request->email) {
                $leadCheck = $this->lead->where('phone_number', $request->mobile)->orWhere('email', $request->email)->first();
                if ($leadCheck) {
                    DB::commit();
                    $success = 'Already Added.';
                    return $this->sendResponse($success, 'Already Added.');
                }
            } else {
                $leadCheck = $this->lead->where('phone_number', $request->mobile)->first();
                if ($leadCheck) {
                    DB::commit();
                    $success = 'Already Added.';
                    return $this->sendResponse($success, 'Already Added.');
                }
            }

            $lead = $this->lead->create([
                'assigned_to'       => $assignTo,
                'full_name'         => $request->name,
                'phone_number'      => $request->mobile,
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

            event(new NewLeadAssigned([
                'id'        => $lead->id,
                'name'      => $lead->full_name,
                'mobile'    => $lead->phone_number,
            ], $assignTo));

            return response()->json([
                'status'    => true,
                'message'   => 'Lead created successfully.',
                'data'      => [
                    'lead_id' => $lead->id,
                    'name'    => $lead->full_name,
                    'mobile'  => $lead->phone_number,
                ]
            ], 201);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'status'    => false,
                'message'   => 'Something went wrong while creating the lead.',
                'error'     => config('app.debug') ? $th->getMessage() : null
            ], 500);
        }
    }
}
