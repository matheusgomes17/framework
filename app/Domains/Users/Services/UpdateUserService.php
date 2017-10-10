<?php

namespace MVG\Domains\Users\Services;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Users\Events\UserPasswordChanged;
use MVG\Domains\Users\Events\UserUpdated;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\User;

/**
 * Class UpdateUserService
 *
 */
class UpdateUserService extends AbstractService
{
    /**
     * @param User $user
     * @param array $data
     * @return User
     * @throws UserException
     */
    public function update(User $user, array $data) : User
    {
        // Create different named function so we don't need another query to find
        // the user instead of passing the User object in as the first parameter
        $user = $this->findById($user->id);

        $this->checkUserByEmail($user, $data['email']);

        return DB::transaction(function () use ($user, $data) {

            if ($user->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
            ])
            ) {
                // Add selected roles
                $user->syncRoles($data['roles']);

                // See if adding any additional permissions
                if (isset($data['permissions']) && count($data['permissions'])) {
                    $user->syncPermissions($data['permissions']);
                }

                event(new UserUpdated($user));

                return $user;
            }

            throw new UserException(__('exceptions.backend.access.users.update_error'));
        });
    }

    /**
     * @param User $user
     * @param      $email
     *
     * @throws UserException
     */
    protected function checkUserByEmail(User $user, $email)
    {
        //Figure out if email is not the same
        if ($user->email != $email) {

            //Check to see if email exists
            if ($this->userRepository->getItemByColumn($email->first(), 'email')) {

                throw new UserException(trans('user::exceptions.email_error'));
            }
        }
    }
}