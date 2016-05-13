<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    // If you want to make use of SSO via EVEOnline, create
    // an application at https://developers.eveonline.com/applications
    // and fill in the ClientID and ClientSecret in the .env file
    'eveonline' => [
        'client_id'     => env('EVE_CLIENT_ID'),
        'client_secret' => env('EVE_CLIENT_SECRET'),
        'redirect'      => env('EVE_CALLBACK_URL'),
    ],

];
