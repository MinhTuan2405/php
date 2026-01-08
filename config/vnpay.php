<?php
return [
    'tmn_code' => env('VNPAY_TMN_CODE', 'T4XS89W2'),
    'hash_secret' => env('VNPAY_HASH_SECRET', 'P6XJODTSEZW9931O15RFR56UB4DTGOD3'),
    // url of payment
    'url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
    'api_url' => 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html',
    // 'return_url' => 'http://localhost:8000/return-vnpay',
    'return_url' => env('VNPAY_RETURN_URL', 'http://localhost:8000/return-vnpay'),
];
