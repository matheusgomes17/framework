<?php

namespace MVG\Domains\Authentication\Models;

use MVG\Domains\Authentication\Models\Traits\Attribute\RoleAttribute;
use Spatie\Permission\Models\Role as Model;

/**
 * Class Role
 * @package MVG\Domains\Authentication\Models
 */
class Role extends Model
{
    use RoleAttribute;
}