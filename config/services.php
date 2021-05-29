<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'paytm-wallet' => [
    'env' => 'local', // values : (local | production)
    'merchant_id' => env('YOUR_MERCHANT_ID'),
    'merchant_key' => env('YOUR_MERCHANT_KEY'),
    'merchant_website' => env('YOUR_WEBSITE'),
    'channel' => env('YOUR_CHANNEL'),
    'industry_type' => env('YOUR_INDUSTRY_TYPE'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '736811757107933',
        'client_secret' => 'f64cee8d64ea3f57575a94e20c4014d8',
        'redirect' => 'https://fatafatsewa.com/login/facebook/callback',
      ],


    'google' => [
      'client_id' => '737567908728-j59jn16t3ee3i01m328mlt0e40t8c8bg.apps.googleusercontent.com',
      'client_secret' => 'XoHJ2eJ_1WfNjjwO4F-C9ZfU',
      'redirect' => 'https://fatafatsewa.com/login/google/callback',
    ],

];
