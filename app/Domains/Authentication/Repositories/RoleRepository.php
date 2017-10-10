<?php

namespace MVG\Domains\Authentication\Repositories;

use MVG\Domains\Authentication\Contracts\Repositories\RoleRepositoryContract;
use MVG\Domains\Authentication\Models\Role;
use MVG\Support\Domain\Database\Repository\BaseEloquentRepository;
use MVG\Support\Domain\Database\Repository\Traits\CacheResults;

/**
 * Class RoleRepository
 *
 */
class RoleRepository extends BaseEloquentRepository implements RoleRepositoryContract
{
    use CacheResults;

    /**
     * @var array
     */
    protected $relationships = ['permissions', 'users'];

    /**
     * @var string
     */
    protected $model = Role::class;
}