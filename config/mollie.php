<?php

return [
    'testing' => env('MOLLIE_TEST_MODE', false),

    'api_keys' => [
        'test' => env('MOLLIE_TEST_KEY', ''),
        'live' => env('MOLLIE_LIVE_KEY', ''),
    ],
];