<?php

namespace MVG\Domains\Users\Services\Frontend;

use MVG\Domains\Users\Repositories\UserRepository;

/**
 * Class AbstractService
 *
 */
class AbstractService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ){
        $this->userRepository = $userRepository;
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

    /**
     * @param $token
     *
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function findByPasswordResetToken($token)
    {
        foreach (\DB::table(config('auth.passwords.users.table'))->get() as $row) {

            if (password_verify($token, $row->token)) {

                return $this->userRepository->getItemByColumn($row->email, 'email');
            }
        }

        return false;
    }
}