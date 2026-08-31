<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function saveSubscription(Request $request)
    {
        $request->user()->updatePushSubscription(

            $request->endpoint,

            $request->keys['p256dh'],

            $request->keys['auth']

        );

        return response()->json([
            'success' => true
        ]);
    }
}
