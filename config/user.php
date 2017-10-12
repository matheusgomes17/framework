<?php


return [

    'models' => [
        /*
         * User model
        */
        'user' => \MVG\Domains\Users\Models\User::class,
    ],

    'table_names' => [
        /*
         * Users table used to store users
         */
        'users' => 'users',

        /*
         * Users password reset table used to store password_resets
         */
        'password_resets' => 'password_resets',

        /*
         * Users social account table used to store social_accounts
         */
        'social_accounts' => 'social_accounts'
    ],

    'foreign_keys' => [
        /*
         *
         */
        'users' => 'user_id',

        /*
         *
         */
        '' => '',
    ],

    /*
     * The default role all new registered users get added to
     */
    'default_role' => 'user',
    /*
     * Whether or not registration is enabled
     */
    'registration' => env('ENABLE_REGISTRATION', true),
    /*
     * Whether or not the user has to confirm their email when signing up
     */
    'confirm_email' => true,
    /*
     * Whether or not the users email can be changed on the edit profile screen
     */
    'change_email' => false,
    /*
     * Whether or not new users need to be approved by an administrator before logging in
     * If this is set to true, then confirm_email is not in effect
     */
    'requires_approval' => env('REQUIRES_APPROVAL', false),
    /*
     * Session Database Driver Only
     * When active, a user can only have one session active at a time
     * That is all other sessions for that user will be deleted when they log in
     * (They can only be logged into one place at a time, all others will be logged out)
     */
    'single_login' => true,
];