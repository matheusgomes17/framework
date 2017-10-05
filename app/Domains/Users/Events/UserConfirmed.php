<?php

namespace MVG\Domains\Users\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserConfirmed
 * @package MVG\Domains\Users\Events
 */
class UserConfirmed
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