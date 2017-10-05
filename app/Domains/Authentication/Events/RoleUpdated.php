<?php

namespace MVG\Domains\Authentication\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class RoleUpdated
 * @package MVG\Domains\Authentication\Events
 */
class RoleUpdated
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