<?php
$paystack = [
    'baseUrl' => 'https://api.paystack.co/',
    'privateKey' => 'sk_test_31737395cbfd2350eca352e1e7aa67d6baf8bb7a'
];
$flutter_wave  = [
    'baseUrl' => 'https://api.flutterwave.com/v3/',
];
return [
    // API token name
    'name' => 'LOAN_MANAGER',
    'paystack' => [
        'bank_url' => $paystack['baseUrl'] . 'bank',
        'verifyTransaction' => $paystack['baseUrl'] . 'transaction/verify/',
        'bin_url' => $paystack['baseUrl'] . 'decision/bin/',
        'account_number' => config('api.paystack.bank_url') . 'resolve',
        'bvn_url' => config('api.paystack.bank_url') . 'resolve_bvn/',
        'header' => [
            'auth' => 'Authorization' . '=>' . 'Bearer' . $paystack['privateKey'],
        ],
        'public_key' => 'pk_test_f202379ab28560c102ba8239ff8c8663264427c0',
        'secret_key' => 'sk_test_31737395cbfd2350eca352e1e7aa67d6baf8bb7a',
    ],
    'flutter' => [
        'verify_transaction' => $flutter_wave['baseUrl'] . 'transactions/{id}/verify',
        'public_key' => 'FLWPUBK_TEST-4c896d772c12d571e1bfe3d9dcdc4042-X', //'FLWPUBK-1922d4eba2c227b80c2512c75d095914-X',
        'secret_key' => 'FLWSECK_TEST-e53cedcb9c89dc6b72c0866fd41c888e-X', //'FLWSECK-8974c2ee3f2cd771a540437819656a9e-X',
        'enc_key' => 'FLWSECK_TEST1a221df19fba', //'8974c2ee3f2cb8baef99a761'
    ]
];
