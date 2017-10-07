<?php

return [

    'models' => [
        /*
         * User model
        */
        'tenant' => \MVG\Domains\Authentication\Models\Tenant::class,
    ],

    'table_names' => [
        /*
         * Tenants table used to store tenant
         */
        'tenants' => 'tenants',

        /*
         * Tenants table used to store tenant
         */
        'user_tenants' => 'user_tenants',
    ],

    'foreign_keys' => [

        'tenants' => 'tenant_id',
    ],

    'tenants' => [

        'field_name' => 'subdomain',
        'route_param' => 'tenant',

        'subdomains_except' => [
            'master',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'api_tenants',
        'passwords' => 'user_tenants',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Repositories user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'web_tenants' => [
            'driver' => 'session',
            'provider' => 'user_tenants'
        ],

        'api_tenants' => [
            'driver' => 'jwt',
            'provider' => 'user_tenants'
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => MVG\Domains\Users\Models\User::class,
        ],

        'user_tenants' => [
            'driver' => 'eloquent',
            'model' => MVG\Domains\Users\Models\UserTenant::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'user_tenants' => [
            'provider' => 'user_tenants',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
