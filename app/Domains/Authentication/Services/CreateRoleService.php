<?php

namespace MVG\Domains\Authentication\Services;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Authentication\Events\RoleCreated;
use MVG\Domains\Authentication\Models\Role;
use MVG\Domains\Users\Exceptions\UserException;

/**
 * Class CreateRoleService
 * @package MVG\Domains\Authentication\Services
 */
class CreateRoleService extends AbstractService
{
    /**
     * @param array $data
     * @return Role
     * @throws UserException
     */
    public function create(array $data) : Role
    {
        if (!isset($data['permissions'])) {
            $data['permissions'] = [];
        }

        //See if the role must contain a permission as per config
        if (config('access.roles.role_must_contain_permission') && count($data['permissions']) == 0) {
            throw new UserException(__('exceptions.roles.needs_permission'));
        }

        return DB::transaction(function () use ($data) {

            $role = $this->roleRepository->create(['name' => $data['name']]);

            if ($role) {

                if (count($data['permissions'])) {
                    $role->givePermissionTo($data['permissions']);
                }

                event(new RoleCreated($role));

                return $role;
            }

            throw new UserException(trans('exceptions.roles.create_error'));
        });
    }
}