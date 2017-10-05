<?php

namespace MVG\Domains\Users\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserPermanentlyDeleted
 * @package MVG\Domains\Users\Events
 */
class UserPermanentlyDeleted
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