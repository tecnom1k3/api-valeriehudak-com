<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => [
        'awesome.dev:8080',
        'stage.valeriehudak.com',
        'valeriehudak.com',
    ],
    'allowedHeaders' => ['*'],
    'allowedMethods' => [
        'GET',
        'POST',
    ],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
