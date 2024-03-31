<?php

// Endpoint URL for Test/Prod and Authorization key
define('API_URL', 'https://qa-api.hydrogenpay.com/bepayment/api/v1/Merchant/confirm-payment'); //TEST Endpoint
define('AUTH_KEY', 'Bearer XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'); // Auth Key for Portal Dev

if (isset($_GET['TransactionRef'])) {
    $transactionRef = $_GET['TransactionRef'];

    // Prepare request data
    $verifyRequest = [
        'transactionRef' => $transactionRef
    ];

    // Call Hydrogen Payment API
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => API_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($verifyRequest),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . AUTH_KEY,
            'Content-Type: application/json',
            'Cache-Control: no-cache'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    // Decode the JSON response
    $res = json_decode($response);

    // Check if payment initiation was successful
    if ($res->statusCode == 90000) {
        echo 'Status Message: ' . $res->message . '<br>';
        echo 'Status: ' . $res->data->status . '<br>';
        echo 'Amount: ' . $res->data->amount . '<br>';
        echo 'Transaction Reference: ' . $res->data->transactionRef . '<br>';
        echo 'Payment Type: ' . $res->data->paymentType . '<br>';
        echo 'Recurring Card Token: ' . $res->data->recurringCardToken . '<br>';
    } else {

        // Display error message if payment initiation failed
        echo 'Status: ' . $res->data->status . '<br>';
        echo 'Error Message: ' . $res->message;
    }
}
