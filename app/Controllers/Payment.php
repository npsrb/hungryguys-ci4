<?php

namespace App\Controllers;

use Midtrans\Config;
use Midtrans\Snap;

class Payment extends BaseController
{
    public function index()
    {
        $transaction = new \Midtrans\Transaction();
        Config::$serverKey = 'SB-Mid-server-nNS3EILyAfaF_Ovt9TF4lzeA';
        Config::$clientKey = 'SB-Mid-client-KpsIaNJcMWQUc-to';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $transaction_params = array(
            'transaction_details' => array(
                'order_id' => 'ORD-12345678',
                'gross_amount' => 100000
            )
        );


        // $token = Snap::getSnapToken($transaction_params);
        $snapurl = Snap::getSnapUrl($transaction_params);
        return redirect()->to($snapurl);
    }
    public function succes()
    {
        echo "success";
    }
    public function failed()
    {
        echo "failed";
    }
    public function pending()
    {
    }
}
