<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom config values specific to the Application
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials or dynamic value for app specific values such
    | as Company Name, Company Mail and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'cdn' => env('DBD_CDN_ENDPOINT'),
    'cdnEnable' => env('DBD_CDN_ENABLE', false),

];
