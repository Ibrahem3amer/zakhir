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

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
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
        'client_id' => '225442501183363',
        'client_secret' => 'b04039af63ef91f933bae117edab208a',
        'redirect' => 'http://localhost:8000/users/callback/facebook',
    ],

    'twitter' => [
        'client_id' => 'bNf4AVqMfZrOudsd1lg73Mxmf',
        'client_secret' => 'f50zRiUHWgDopMpdUfkXw4ThaDYdCGqUyqBk63GGXJmo8Dep18',
        'redirect' => 'http://localhost:8000/users/callback/twitter',
    ],

    'google' => [
        'client_id' => '973147476072-o17ih2mh44pd4l11hbi1i2lrrtv59ohu.apps.googleusercontent.com',
        'client_secret' => 'Az8g8zXus9YOYufGWfAyo2uj',
        'redirect' => 'http://localhost:8000/users/callback/google',
    ],

];
