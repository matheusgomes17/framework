<?php

namespace MVG\Domains\Users\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserProviderRegistered
 * @package MVG\Domains\Users\Events
 */
class UserProviderRegistered
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