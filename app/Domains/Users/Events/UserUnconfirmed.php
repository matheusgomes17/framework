<?php

namespace MVG\Domains\Users\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserUnconfirmed
 * @package MVG\Domains\Users\Events
 */
class UserUnconfirmed
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