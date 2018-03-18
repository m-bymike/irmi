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
    'allowedOrigins' => ['flyvienna.herokuapp.com'],
    'allowedOriginsPatterns' => ['/localhost:\d/'],
    'allowedHeaders' => ['Authorization', 'Content-Type', 'Accept'],
    'allowedMethods' => ['OPTIONS', 'GET'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
