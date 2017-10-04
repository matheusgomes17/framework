<?php

namespace MVG\Domains\Users\Services;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Users\Events\UserDeleted;
use MVG\Domains\Users\Events\UserUpdated;
use MVG\Domains\Authentication\Notifications\UserNeedsConfirmation;
use MVG\Domains\Users\Events\UserCreated;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\User;
use MVG\Domains\Users\Repositories\UserRepository;

/**
 * Class UserService
 * @package MVG\Domains\Users\Services
 */
class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param  $data
     *
     * @return mixed
     */
    protected function createUserStub($data = [])
    {
        $user = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => isset($data['active']) ? 1 : 0,
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => isset($data['confirmed']) ? 1 : 0,
        ];

        return $user;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function paginate()
    {
        return $this->userRepository->getPaginated();
    }

    public function findById($id)
    {
        return $this->userRepository->getByID($id);
    }


    public function create(array $data): User
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
            if (config('access.users.confirm_email')) {
                // Pretty much only if account approval is off, confirm email is on, and this isn't a social account.
                $user->notify(new UserNeedsConfirmation($user->confirmation_code));
            }
            /*
             * Return the user object
             */
            return $user;
        });
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);
        $this->checkUserByEmail($user, $data['email']);

        return DB::transaction(function () use ($user, $data) {

            $result = $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            if ($result) {
                event(new UserUpdated($user));

                return true;
            }

            throw new UserException(trans('exceptions.users.update_error'));
        });
    }

    public function delete($id)
    {
        $user = $this->userRepository->findByID($id);

        if ($user->delete()) {

            event(new UserDeleted($user));

            return true;
        }

        throw new UserException(trans('exceptions.users.delete_error'));
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
            if ($this->userRepository->newQuery()->where('email', '=', $email)->first()) {
                throw new UserException(trans('exceptions.users.email_error'));
            }
        }
    }
}