<?php

namespace MVG\Domains\Users\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserLoggedOut
 * @package MVG\Domains\Users\Events
 */
class UserLoggedOut
{
    use SerializesModels;
    /**
     * @var
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}