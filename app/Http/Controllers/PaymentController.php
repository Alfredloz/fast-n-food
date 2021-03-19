<?php

namespace App\Http\Controllers;

use Braintree;
use Braintree\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\App;

class PaymentController extends Controller
{
    public function make(Request $request)
    {   
        // richiamo ENV parametri

        $env= Env::get('BRAINTREE_ENV');
        $merchantId = Env::get('BRAINTREE_MERCHANT_ID');
        $publicKey = Env::get('BRAINTREE_PUBLIC_KEY');
        $privateKey = Env::get('BRAINTREE_PRIVATE_KEY');

        
        
        // Braintree Gateway
        
        $gateway = new Braintree\Gateway([
            'environment' => $env,
            'merchantId' => $merchantId,
            'publicKey' => $publicKey,
            'privateKey' => $privateKey
            ]);



        $nonce = $gateway->paymentMethodNonce();    
        
        dd($nonce);


            
        // $token = 'sandbox_mfrr887s_7cxbszb7hywbswm5';

        // $result = $gateway->paymentMethodNonce()->create('A_PAYMENT_METHOD_TOKEN');
        // $nonce = $result->paymentMethodNonce->nonce;


        // $status = Braintree\Transaction::sale([
        // 'amount' => '10.00',
        // 'paymentMethodNonce' => 'fake-valid-nonce',
        // 'options' => [
        //     'submitForSettlement' => True
        // ]
        // ]);
         
        // return response()->json($status);

        // dd($status);
        // return response()->json($status);
        // return response()->json(Braintree\ClientToken::generate());
    

        // $clientToken = $gateway->clientToken()->generate();
        // dd($clientToken);   
    }
}
