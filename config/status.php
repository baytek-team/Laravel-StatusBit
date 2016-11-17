<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Status Column Name
    |--------------------------------------------------------------------------
    |
    | This option is which column should be used as the status indicator
    |
    */

    'column' => env('STATUS_COLUMN', 'status'),

    /*
    |--------------------------------------------------------------------------
    | Use Status Histories
    |--------------------------------------------------------------------------
    |
    | This is if you would like to store the values of status changes. Date of change
    | and previous status values
    |
    */

    'use_history' => true,

    /*
    |--------------------------------------------------------------------------
    | Table name of status histories
    |--------------------------------------------------------------------------
    |
    |
    */

    'history_table' => 'status_histories',

    /*
    |--------------------------------------------------------------------------
    | The models you'd like to observe for changes
    |--------------------------------------------------------------------------
    |
    |
    */

    'history_models' => [
        //
    ]
];
