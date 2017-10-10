<?php

namespace MVG\Domains\Authentication\Services;

use MVG\Domains\Authentication\Contracts\Services\RoleServiceContract;
use MVG\Domains\Authentication\Repositories\PermissionRepository;
use MVG\Domains\Authentication\Repositories\RoleRepository;

/**
 * Class AbstractService
 *
 */
class AbstractService implements RoleServiceContract
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository){
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate()
    {
        return $this->roleRepository->getPaginated();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id)
    {
        return $this->roleRepository->getByID($id);
    }
}