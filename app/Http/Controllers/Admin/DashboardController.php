<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Leads;
use App\Models\Orders;
use App\Models\Payments;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $role_id = $user->roles->pluck('id', 'id')->first();
        return view('dashboard.index');
    }
}
