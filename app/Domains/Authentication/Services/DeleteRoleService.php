<?php

namespace MVG\Domains\Authentication\Services;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Authentication\Events\RoleDeleted;
use MVG\Domains\Authentication\Events\RoleUpdated;
use MVG\Domains\Users\Exceptions\UserException;

/**
 * Class DeleteRoleService
 * @package MVG\Domains\Authentication\Services
 */
class DeleteRoleService extends AbstractService
{

    public function delete($id)
    {
        $role = $this->roleRepository->getById($id);

        return DB::transaction(function () use ($role) {

            if ($role->delete()) {

                event(new RoleDeleted($role));
                
                return $role;
            }
            
            throw new UserException(trans('auth::exceptions.roles.deleted'));
        });
    }
}