<?php

namespace App\Http\Controllers\Payments\Pesapal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PesapalResponsesController extends Controller
{
    public function notification(Request $request){
        Log::info('Pesapal Notification endpoint hit');
        Log::info($request->all());
    }
}
