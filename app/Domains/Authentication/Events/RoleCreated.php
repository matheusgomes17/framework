<?php

namespace MVG\Domains\Authentication\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class RoleCreated
 * @package MVG\Domains\Authentication\Events
 */
class RoleCreated
{
    use SerializesModels;
    /**
     * @var
     */
    public $role;

    /**
     * @param $role
     */
    public function __construct($role)
    {
        $this->role = $role;
    }
}