<?php

use App\Http\Controllers\API\LeadController;
use Illuminate\Support\Facades\Route;


Route::POST('whatsApp_Lead', [LeadController::class, 'whatsappLead']);
