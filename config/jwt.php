<?php

return [
    'issuer'     => env('JWT_ISS'),
    'audience'   => env('JWT_AUD'),
    'expiration' => env('JWT_EXPIRATION'),
    'secret'     => env('JWT_SECRET'),
];