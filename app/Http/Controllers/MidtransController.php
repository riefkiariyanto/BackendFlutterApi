<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
   // Set your Merchant Server Key
    public function getPaymentToken(Request $request ){

    // Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-C-s0Sa_aN39P_nL9cdPtrvUm';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => 10000,
    ),
    'customer_details' => array(
        'first_name' => 'budi',
        'last_name' => 'pratama',
        'email' => 'budi.pra@example.com',
        'phone' => '08111222333',
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);

return $snapToken;
    }
}