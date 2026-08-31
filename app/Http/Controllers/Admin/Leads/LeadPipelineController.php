<?php

namespace App\Http\Controllers\Admin\Leads;

use App\Models\Leads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadPipelineController extends Controller
{
    # Define Base view
    protected $view = 'admin.leads.';

    #Bind Leads model
    protected $leads;

    public function __construct(
        Leads $leads
    ) {
        $this->leads    = $leads;
    }


    public function index(Request $request)
    {
        // try {

        $details['lists'] = $this->leads->orderBy('created_at', 'DESC')->paginate(10);
        #render view
        return view($this->view . 'lead-pipeline', $details);
        // } catch (\Exception $ex) {
        //     toastr()->success($ex->getMessage());
        //     return back()->with('error', $ex->getMessage());
        // }
    }
}
