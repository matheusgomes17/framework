<?php

namespace MVG\Domains\Authentication\Services;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Authentication\Events\RoleUpdated;
use MVG\Domains\Users\Exceptions\UserException;

/**
 * Class UpdateRoleService
 *
 */
class UpdateRoleService extends AbstractService
{
    /**
     * @param $id
     * @param array $data
     * @return mixed
     * @throws UserException
     */
    public function update($id, array $data)
    {
        $role = $this->roleRepository->getById($id);
        
        if (! isset($data['permissions'])) {
            $data['permissions'] = [];
        }
        
        //See if the role must contain a permission as per config
        if (config('permission.roles.role_must_contain_permission') && count($data['permissions']) == 0) {
            throw new UserException(__('exceptions.roles.needs_permission'));
        }
        
        return DB::transaction(function () use ($role, $data) {

            if ($role->update(['name' => $data['name']])) {
                if (count($data['permissions'])) {
                    $role->syncPermissions($data['permissions']);
                }
                
                event(new RoleUpdated($role));
                
                return $role;
            }
            
            throw new UserException(trans('auth::exceptions.roles.update_error'));
        });
    }
}