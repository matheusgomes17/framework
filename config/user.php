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
    /*
     * Whether or not the user has to confirm their email when signing up
     */
    'confirm_email' => true,
    /*
     * Whether or not the users email can be changed on the edit profile screen
     */
    'change_email' => false,
    /*
     * The default role all new registered users get added to
     */
    'default_role' => 'user',
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

    'password_resets' => [
        /*
         * Users password reset table used to store password_resets
         */
        'table' => 'password_resets',
    ],

    'social_accounts' => [
        /*
         * Users social account table used to store social_accounts
         */
        'table' => 'social_accounts'
    ],

    'gravatar' => [

        'default' => [
            // By default, images are presented at 80px by 80px if no size parameter is supplied.
            // You may request a specific image size, which will be dynamically delivered from Gravatar
            // by passing a single pixel dimension (since the images are square):
            'size' => 80,
            // the fallback image, can be a string or a url
            // for more info, visit: http://en.gravatar.com/site/implement/images/#default-image
            'fallback' => 'mm',
            // would you like to return a https://... image
            'secure' => false,

            // Gravatar allows users to self-rate their images so that they can indicate if an image
            // is appropriate for a certain audience. By default, only 'G' rated images are displayed
            // unless you indicate that you would like to see higher ratings.
            // Available options:
            // g: suitable for display on all websites with any audience type.
            // pg: may contain rude gestures, provocatively dressed individuals, the lesser swear words, or mild violence.
            // r: may contain such things as harsh profanity, intense violence, nudity, or hard drug use.
            // x: may contain hardcore sexual imagery or extremely disturbing violence.
            'maximumRating' => 'g',
            // If for some reason you wanted to force the default image to always load, you can do that setting this to true
            'forceDefault' => false,
            // If you require a file-type extension (some places do) then you may also add an (optional) .jpg extension to that URL
            'forceExtension' => 'jpg',
        ]
    ],
];