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
      // la request contiene i dati per autorizzare il pagamento, ma non quelli
      // del pagamento stesso come il prezzo o altro
      $payload = $request->input('payload', false);
      $nonce = $payload['nonce'];
      //$amount = '76.46';
      $amount = $request->input('totale');


      $status = Braintree\Transaction::sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
          'submitForSettlement' => True
        ]
      ]);

      return response()->json($status);
      // response rimanda indietro diversi dati tra cui l'amount e la data della transazione
    }
}


        // parte OLD, la lascio per sicurezza al momento

        // richiamo ENV parametri

        // $env= Env::get('BRAINTREE_ENV');
        // $merchantId = Env::get('BRAINTREE_MERCHANT_ID');
        // $publicKey = Env::get('BRAINTREE_PUBLIC_KEY');
        // $privateKey = Env::get('BRAINTREE_PRIVATE_KEY');

        // Braintree Gateway

        // $gateway = new Braintree\Gateway([
        //     'environment' => $env,
        //     'merchantId' => $merchantId,
        //     'publicKey' => $publicKey,
        //     'privateKey' => $privateKey
        //     ]);
        //
        // $nonce = $gateway->paymentMethodNonce();
        // dd($nonce);

        // $result = $gateway->paymentMethodNonce()->create('A_PAYMENT_METHOD_TOKEN');
        // $nonce = $result->paymentMethodNonce->nonce;
        // return response()->json($status);
        // $clientToken = $gateway->clientToken()->generate();
        // dd($clientToken);
