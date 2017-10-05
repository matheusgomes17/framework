<?php

namespace MVG\Domains\Authentication\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class RoleDeleted
 * @package MVG\Domains\Authentication\Events
 */
class RoleDeleted
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