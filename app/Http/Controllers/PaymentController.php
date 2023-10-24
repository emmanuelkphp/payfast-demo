<?php
/*
Merchant ID:    10031315
Merchant Key:   sbijrnrrkonrs
Sandbox URL:    https://sandbox.payfast.co.za/eng/process
Passphrase:     test123456789
Email:          emmanuel.k.php@gmail.com
url:            http://localhost/payfast-demo/public/success
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class PaymentController extends Controller{

    public function initiate_payment(){
        // Construct variables
        $cartTotal = 10.00; // This amount needs to be sourced from your application
        $passphrase = 'test123456789';
        $data = array(
            // Merchant details
            'merchant_id' => '10031315',
            'merchant_key' => 'sbijrnrrkonrs',
            'return_url' => 'http://localhost/payfast-demo/public/payment/success',
            'cancel_url' => 'http://localhost/payfast-demo/public/payment/cancel',
            'notify_url' => 'http://localhost/payfast-demo/public/payment/cancel',
            // Buyer details
            'name_first' => 'First Name',
            'name_last'  => 'Last Name',
            'email_address'=> 'test@test.com',
            // Transaction details
            'm_payment_id' => '1234', //Unique payment ID to pass through to notify_url
            'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', '' ),
            'item_name' => 'Order#123'
        );

        //$signature = generateSignature($data, $passphrase);
        //$data['signature'] = $signature;

        // If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
        $testingMode = true;
        $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
        $htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post">';
        foreach($data as $name=> $value)
        {
            $htmlForm .= '<input name="'.$name.'" type="hidden" value=\''.$value.'\' />';
        }
        $htmlForm .= '<input type="submit" value="Pay Now" /></form>';
        echo $htmlForm;

    }

    public function payment_success(Request $request){
        return "success";
    }
    public function payment_cancel(){
        return "canceled";
    }

    public function test_BK(){
         // Set your PayFast API credentials and other data
        $merchantId = '10031315';
        $merchantKey = 'sbijrnrrkonrs';
        $amount = '100.00';
        $itemName = 'Test Product';

        // URL to PayFast's endpoint
        $payfastUrl = 'https://sandbox.payfast.co.za/eng/process';

        // Create a Guzzle HTTP client
        $client = new Client();

        // Send a POST request to PayFast
        $response = $client->post($payfastUrl, [
            'form_params' => [
                'merchant_id' => $merchantId,
                'merchant_key' => $merchantKey,
                'amount' => $amount,
                'item_name' => $itemName,
            ],
        ]);

        //return $response->getBody();
    }

    public function test(){
        $merchant_id = env('PAYFAST_MERCHANT_ID');
        $merchant_key = env('PAYFAST_MERCHANT_KEY');
        $amount = '100.00';
        $item_name = 'Test Product';
        $return_url = 'http://localhost/payfast-demo/public/payment/success';
        $notify_url = 'http://localhost/payfast-demo/public/payment/notify';
        $payfast_url = 'https://sandbox.payfast.co.za/eng/process';

        $data = array(
            'merchant_id' => $merchant_id,
            'merchant_key' => $merchant_key,
            'amount' => $amount,
            'item_name' => $item_name,
            'return_url' => $return_url,
            'notify_url' => $notify_url,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $payfast_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'cURL Error: ' . curl_error($ch);
        }

        curl_close($ch);
        return $response;
    }

    public function payment_notify(Request $request){
        return $request;
    }

    public function home(){
        app()->setLocale('es');
        return $greeting = trans('messages.welcome', ['name' => 'Jane']);
        return view('home');
    }

}
