<?php

namespace MVG\Domains\Users\Services\Frontend;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Users\Notifications\UserNeedsConfirmation;
use MVG\Domains\Users\Events\UserConfirmed;
use MVG\Domains\Users\Exceptions\UserException;

/**
 * Class RegisterUserService
 *
 */
class RegisterUserService extends AbstractService
{
    /**
     * @param  $data
     *
     * @return mixed
     */
    protected function createUserStub($data = [])
    {
        $user = [
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'],
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'active'            => 1,
            'password'          => bcrypt($data['password']),
        ];

        return $user;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
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
                /*
                 * Add the default site role to the new user
                 */
                $user->assignRole(config('user.default_role'));
            }

            /*
             * If users have to confirm their email and this is not a social account,
             * and the account does not require admin approval
             * send the confirmation email
             *
             * If this is a social account they are confirmed through the social provider by default
             */
            if (config('user.confirm_email')) {
                // Pretty much only if account approval is off, confirm email is on, and this isn't a social account.
                $user->notify(new UserNeedsConfirmation($user->confirmation_code));
            }

            /*
             * Return the user object
             */
            return $user;
        });
    }
}