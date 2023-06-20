<?php

namespace App\Http\Controllers\Payments\Pesapal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesapalController extends Controller
{
    public function getToken()
    {
        $url = env('PESAPAL_ENV') == 0
        ? 'https://cybqa.pesapal.com/pesapalv3/api/Auth/RequestToken'
        : 'https://pay.pesapal.com/v3/api/Auth/RequestToken';

        $curl = curl_init($url);
        $data = json_encode([
            'consumer_key' => env('PESAPAL_CONSUMER_KEY'), 
            'consumer_secret' => env('PESAPAL_CONSUMER_SECRET')
        ]);

        curl_setopt_array(
            $curl,
            [
                CURLOPT_HTTPHEADER => ['Accept: application/json','Content-Type: application/json'],
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_RETURNTRANSFER => true,
            ]
        );

        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        // Check if there are any JSON decoding errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            $error = json_last_error_msg();
            echo "JSON decoding error: $error";
        } else {
            return $response->token;
        }
    }

    public function registerURLS()
    {
        $url = env('PESAPAL_ENV') == 0
        ? 'https://cybqa.pesapal.com/pesapalv3/api/URLSetup/RegisterIPN'
        : 'https://pay.pesapal.com/v3/api/URLSetup/RegisterIPN';

        $body = [
            'url' => env('PESAPAL_TEST_URL') . '/api/conrad/palnotify',
            'ipn_notification_type' => 'POST'
        ];

        $response = $this->makeHttp($url, $body);

        return $response;
    }

    public function getRegisteredIPNS()
    {
        $url = env('PESAPAL_ENV') == 0
        ? 'https://cybqa.pesapal.com/pesapalv3/api/URLSetup/GetIpnList'
        : 'https://pay.pesapal.com/v3/api/URLSetup/GetIpnList';
        
        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            [
                CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $this->getToken()],
                CURLOPT_RETURNTRANSFER => true
            ]
        );

        $response = curl_exec($curl);

        return $response;
    }

    public function submitOrder(Request $request)
    {
        $url = env('PESAPAL_ENV') == 0
        ? 'https://cybqa.pesapal.com/pesapalv3/api/Transactions/SubmitOrderRequest'
        : 'https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest';
        
        $data = json_encode(["email_address" => $request->email_address, "phone_number"=> $request->phone_number]);
        $body = [
            'id' => $request->reference,
            'currency' => $request->currency,
            'amount' => $request->amount,
            'description' => $request->description,
            'redirect_mode' => '',
            'callback_url' => route('order.response'),
            'cancellation_url' => route('client.rooms.available'),
            'notification_id' => env('PESAPAL_TEST_URL') . '/api/conrad/palnotify',
            'branch' => '',
            'billing_address' => $data

            /* 'billing_address' =>  '{
                "email_address": "john.doe@example.com",
                "phone_number": "0723xxxxxx",
                "country_code": "KE",
                "first_name": "John",
                "middle_name": "",
                "last_name": "Doe",
                "line_1": "Pesapal Limited",
                "line_2": "",
                "city": "",
                "state": "",
                "postal_code": "",
                "zip_code": ""
            }' */
        ];

        $response = $this->makeHttp($url, $body);

        return $response;
    }

    public function getTransactionStatus(Request $request)
    {
        $url = env('PESAPAL_ENV') == 0
        ? 'https://cybqa.pesapal.com/pesapalv3/api/Transactions/GetTransactionStatus?orderTrackingId=' . $request->tracking_id
        : 'https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId=' . $request->tracking_id;

        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            [
                CURLOPT_HTTPHEADER => ['Accept:application/json' , 'Content-Type:application/json', 'Authorization:Bearer ' . $this->getToken()],
            ],
        );

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function makeHttp($url, $body)
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER => ['Accept:application/json' , 'Content-Type:application/json', 'Authorization: Bearer ' . $this->getToken()],
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
