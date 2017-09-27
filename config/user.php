<?php

use MVG\Domains\Users\Models\User;

return [
    /*
     * User model
    */
    'model' => User::class,
    /*
     * Users table used to store users
     */
    'table' => 'users',

    'password_resets' => [
        /*
         * Users table used to store users
         */
        'table' => 'password_resets',
    ]
];