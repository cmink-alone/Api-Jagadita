<?php
    require_once __DIR__ . '/vendor/autoload.php';
    // Set your Merchant Server Key
    Veritrans_Config::$serverKey = 'SB-Mid-server-hfTWZInpHDkuw7MiX9SVRtLQ';
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    Veritrans_Config::$isProduction = false;
    // Set sanitization on (default)
    Veritrans_Config::$isSanitized = true;

    $transaction_details = array(
        'order_id' => rand(),
        'gross_amount' => 20000, // no decimal allowed for creditcard
    );

    try {
        $snapToken = Veritrans_Snap::getSnapToken(['transaction_details' => $transaction_details]);
        echo json_encode($snapToken);
        // return ['code' => 1 , 'message' => 'success' , 'result' => $snapToken];
    } catch (\Exception $e) {
        dd($e);
        echo ['code' => 0 , 'message' => 'failed'];
    }