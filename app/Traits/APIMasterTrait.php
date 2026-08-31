<?php

namespace App\Traits;

use App\Models\LeadAttendance;
use App\Models\LeadDistribution;

trait APIMasterTrait
{
    public function activeUser()
    {
        $countCheck      = LeadDistribution::first();
        $countAttendance = LeadAttendance::whereHas('user', function ($query) {
            $query->where('status', 1);
        })->where('present', 1)->get();
        $assignTo = 33;
        if (count($countAttendance) > 0) {
            if (count($countAttendance) < $countCheck->count) {
                $data = ['count' => 0,];
                $assignTo = $countAttendance[0]->user_id;
            } else if (count($countAttendance) == $countCheck->count) {
                $data = ['count' => 0,];
                $assignTo = $countAttendance[$countCheck->count - 1]->user_id;
            } else {
                $assignTo = $countAttendance[$countCheck->count]->user_id;
                $data     = ['count' => $countCheck->count + 1,];
            }
            LeadDistribution::whereId($countCheck->id)->update($data);
        }
        return $assignTo;
    }
}
