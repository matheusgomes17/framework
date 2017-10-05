<?php

namespace MVG\Domains\Users\Services;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Users\Events\UserCreated;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\User;
use MVG\Domains\Users\Notifications\UserNeedsConfirmation;

/**
 * Class CreateUserService
 * @package MVG\Domains\Users\Services
 */
class CreateUserService extends AbstractService
{
    /**
     * @param  $data
     *
     * @return mixed
     */
    protected function createUserStub($data = [])
    {
        $user = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => isset($data['active']) ? 1 : 0,
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => isset($data['confirmed']) ? 1 : 0,
        ];

        return $user;
    }

    public function create(array $data) : User
    {
        return DB::transaction(function () use ($data) {

            $user = $this->userRepository->create($this->createUserStub($data));

            // If users require approval or needs to confirm email
            if (config('user.requires_approval') || config('user.confirm_email')) {
                $user->confirmed = 0;
            } else {
                $user->confirmed = 1;
            }

            if ($user) {
                // User must have at least one role
                if (! count($data['roles'])) {
                    throw new UserException(__('auth::exceptions.role_needed_create'));
                }

                // Add selected roles
                $user->syncRoles($data['roles']);

                // See if adding any additional permissions
                if (isset($data['permissions']) && count($data['permissions'])) {
                    $user->syncPermissions($data['permissions']);
                }

                //Send confirmation email if requested and account approval is off
                if (isset($data['confirmation_email']) && $user->confirmed == 0 && ! config('user.requires_approval')) {
                    $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                }

                event(new UserCreated($user));

                return $user;
            }

            throw new UserException(__('user::exceptions.create_error'));
        });
    }
}