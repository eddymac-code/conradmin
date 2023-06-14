<?php

namespace App\Http\Controllers\Payments\Mpesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    public function getAccessToken()
    {
        $url = env('MPESA_ENV') == 0
        ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
        : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf8'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_USERPWD => env('MPESA_CONSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET')
            )
        );
        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        
        return $response->access_token;

    }

    /**
     * Register callback URLs
     */
    public function registerURLS()
    {
        $body = [
            'ShortCode' => env('MPESA_SHORTCODE'),
            'ResponseType' => 'Completed',
            'ConfirmationURL' => env('MPESA_TEST_URL') . '/api/conrad/mobiconf',
            'ValidationURL' => env('MPESA_TEST_URL') . '/api/conrad/mobivalide'
        ];

        $url = env('MPESA_ENV') == 0
        ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl'
        : 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $response = $this->makeHttp($url, $body);

        return $response;
    }

    public function stkPush(Request $request)
    {
        $timestamp = date('YmdHis');
        $password = base64_encode(env('MPESA_STK_SHORTCODE').env('MPESA_PASSKEY').$timestamp);

        $curl_post_data = array(
            'BusinessShortCode' => env('MPESA_STK_SHORTCODE'),
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $request->amount,
            'PartyA' => $request->phone,
            'PartyB' => env('MPESA_STK_SHORTCODE'),
            'PhoneNumber' => $request->phone,
            'CallBackURL' => env('MPESA_TEST_URL'). '/api/conrad/stkpush',
            'AccountReference' => $request->account,
            'TransactionDesc' => $request->account
        );

        $url = env('MPESA_ENV') == 0
        ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
        : 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $response = $this->makeHttp($url, $curl_post_data);

        return $response;
    }

    public function simulateTransaction(Request $request)
    {
        $body = [
            'ShortCode' => env('MPESA_SHORTCODE'),
            'Msisdn' => env('MPESA_TEST_MSISDN'),
            'Amount' => $request->amount,
            'BillRefNumber' => $request->account,
            'CommandID' => 'CustomerPayBillOnline',
        ];

        $url = env('MPESA_ENV') == 0
        ? "https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate"
        : "https://api.safaricom.co.ke/mpesa/c2b/v1/simulate";

        $response = $this->makeHttp($url, $body);

        return $response;
    }

    /**
     * B2C Request API
     */
    public function b2cRequest(Request $request)
    {
        $curl_post_data = array(
            'InitiatorName' => env('MPESA_B2C_INITIATOR'),
            'SecurityCredential' => env('MPESA_B2C_PASSWORD'),
            'CommandID' => 'SalaryPayment',
            'Amount' => $request->amount,
            'PartyA' => env('MPESA_SHORTCODE'),
            'PartyB' => $request->phone,
            'Remarks' => $request->remarks,
            'QueueTimeOutURL' => env('MPESA_TEST_URL') . '/api/conrad/b2ctimeout',
            'ResultURL' => env('MPESA_TEST_URL') . '/api/conrad/b2ccallback',
            'Occasion' => $request->occasion
          );

          $url = env('MPESA_ENV') == 0
          ? "https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest"
          : "https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest";

        $res = $this->makeHttp($url, $curl_post_data);

        return $res;
    }

    /**
     * Transaction status API
     */
    public function transactionStatus(Request $request)
    {
        $body =  array(
            'Initiator' => env('MPESA_B2C_INITIATOR'),
            'SecurityCredential' => env('MPESA_B2C_PASSWORD'),
            'CommandID' => 'TransactionStatusQuery',
            'TransactionID' => $request->transactionid,
            'PartyA' => env('MPESA_SHORTCODE'),
            'IdentifierType' => '4',
            'ResultURL' => env('MPESA_TEST_URL'). '/api/conrad/transaction-status/result_url',
            'QueueTimeOutURL' => env('MPESA_TEST_URL'). '/api/conrad/transaction-status/timeout_url',
            'Remarks' => 'CheckTransaction',
            'Occasion' => 'VerifyTransaction'
          );

          $url = env('MPESA_ENV') == 0
          ? "https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query"
          : "https://api.safaricom.co.ke/mpesa/transactionstatus/v1/query";

        $response = $this->makeHttp($url, $body);

        return $response;
    }

    /**
     * Reverse Transaction
     */
    public function reverseTransaction(Request $request){
        $body = array(
            'Initiator' => env('MPESA_B2C_INITIATOR'),
            'SecurityCredential' => env('MPESA_B2C_PASSWORD'),
            'CommandID' => 'TransactionReversal',
            'TransactionID' => $request->transactionid,
            'Amount' => $request->amount,
            'ReceiverParty' => env('MPESA_SHORTCODE'),
            'RecieverIdentifierType' => '11',
            'ResultURL' => env('MPESA_TEST_URL') . '/api/conrad/reversal/result_url',
            'QueueTimeOutURL' => env('MPESA_TEST_URL') . '/api/conrad/reversal/timeout_url',
            'Remarks' => 'ReversalRequest',
            'Occasion' => 'ErroneousPayment'
          );

          $url = env('MPESA_ENV') == 0
          ? "https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request"
          : "https://api.safaricom.co.ke/mpesa/reversal/v1/request";

          $response = $this->makeHttp($url, $body);
  
          return $response;
    }
    
    public function makeHttp($url, $body)
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER => ['Content-Type:application/json', 'Authorization:Bearer ' . $this->getAccessToken()],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($body)
            ],
        );

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;

    }
}
