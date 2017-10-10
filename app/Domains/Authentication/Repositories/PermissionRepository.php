<?php

namespace MVG\Domains\Authentication\Repositories;

use MVG\Domains\Authentication\Contracts\Repositories\PermissionRepositoryContract;
use MVG\Domains\Authentication\Models\Permission;
use MVG\Support\Domain\Database\Repository\BaseEloquentRepository;
use MVG\Support\Domain\Database\Repository\Traits\CacheResults;

/**
 * Class PermissionRepository
 *
 */
class PermissionRepository extends BaseEloquentRepository implements PermissionRepositoryContract
{
    use CacheResults;

    /**
     * @var array
     */
    protected $relationships = ['roles', 'users'];

    /**
     * @var string
     */
    protected $model = Permission::class;

}