<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payments\Mpesa\MpesaResponsesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('conrad/mobivalide', [MpesaResponsesController::class, 'validation']);
Route::post('conrad/mobiconf', [MpesaResponsesController::class, 'confirmation']);
Route::post('conrad/stkpush', [MpesaResponsesController::class, 'stkPush']);
Route::post('conrad/b2ccallback', [MpesaResponsesController::class, 'b2cCallback']);
Route::post('conrad/transaction-status/result_url', [MpesaResponsesController::class, 'transactionStatusResponse']);
Route::post('conrad/reversal/result_url', [MpesaResponsesController::class, 'transactionReversal']);
