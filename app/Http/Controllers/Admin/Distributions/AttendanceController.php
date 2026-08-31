<?php

namespace App\Http\Controllers\Admin\Distributions;

use App\Models\User;
use App\Models\LeadAttendance;
use App\Models\LeadDistribution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    # Define Base view
    protected $view = 'admin.distribution.attendance.';

    #Bind User model
    protected $user;

    #Bind LeadAttendance model
    protected $leadAttendance;

    #Bind LeadDistribution model
    protected $leadDistribution;

    public function __construct(
        User                $user,
        LeadAttendance      $leadAttendance,
        LeadDistribution    $leadDistribution

    ) {
        $this->user                 = $user;
        $this->leadAttendance       = $leadAttendance;
        $this->leadDistribution     = $leadDistribution;
    }
    public function index()
    {
        try {

            $details['lists'] = $this->user->with(['attendance'])->where('is_admin', 0)->where('status', 1)->orderBy('created_at','DESC')->get();
            #render view
            return view($this->view . 'index', $details);
        } catch (\Exception $ex) {
            toastr()->success($ex->getMessage());
            return back()->with('error', $ex->getMessage());
        }
    }
    public function changeStatus(Request $request, $id)
    {

        #get the detail of requested resources
        $attendances = $this->leadAttendance->where('user_id', $request->id)->first();
        if ($attendances) {
            if ($attendances->present == 1) {
                $status = '0';
            } else {
                $status = '1';
            }
            #get the status in data variable
            $data = ['present' => $status];
            #update status
            $this->leadAttendance->whereId($attendances->id)->update($data);
            $attendanceid = $attendances->id;
        } else {
            $data = [
                'user_id'           => $request->id,
                'present'           => 1,
            ];
            #store the newly creted resoures
            $atten = $this->leadAttendance->create($data);
            $attendanceid = $atten->id;
        }
        $genders = $this->leadAttendance->whereId($attendanceid)->first();
        $message = $genders->present == 0 ? 'Absent' : 'Present';
        toastr()->success('You are successfully ' . $message);
        return redirect('admin/employee-lead-distribution');
    }
}
