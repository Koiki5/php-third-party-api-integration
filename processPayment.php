<?php

// Endpoint URL for Test/Prod and Authorization key
define('API_URL', 'https://qa-dev.hydrogenpay.com/qa/bepay/api/v1/merchant/initiate-payment'); //TEST Endpoint
define('AUTH_KEY', 'Bearer XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'); // Auth Key

// Check if the form was submitted
if (isset($_POST['processPayment'])) {
    // Retrieve form data
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['email'];
    $amount = $_POST['amount'];
    $paymentDescription = $_POST['description'];
    $otherPaymentInformation = $_POST['meta'];

    // Prepare payment request data
    $hydrogenRequest = [
        'amount' => $amount,
        'email' => $customerEmail,
        'currency' => 'NGN',
        'description' => $paymentDescription,
        'customerName' => $customerName,
        'meta' => $otherPaymentInformation,
        'callback' => 'http://hydrogen_pg_php_integration.test/verifyPayment.php', // Define your callback URL here
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
        CURLOPT_POSTFIELDS => json_encode($hydrogenRequest),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . AUTH_KEY, // Auth Key for dev portal (TEST or PROD)
            'Content-Type: application/json',
            'Cache-Control' => 'no-cache'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    // Decode the JSON response
    $res = json_decode($response);

    // Check if payment initiation was successful
    if ($res->statusCode == 90000) {
        $result = $res->message;
        $paymentLink = $res->data->url; // Get Payment Link

        // Redirect to Payment URL
        header('Location: ' . $paymentLink);
        
    } else {
        // Display error message if payment initiation failed
        echo 'Initiate payment not successful: ' . $res->message;

    }
}
