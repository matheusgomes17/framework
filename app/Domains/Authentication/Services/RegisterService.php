<?php

namespace MVG\Domains\Authentication\Services;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use MVG\Domains\Authentication\Repositories\RegisterRepository;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\User;

/**
 * Class RegisterService
 * @package MVG\Domains\Users\Services
 */
class RegisterService
{
    /**
     * @var RegisterRepository
     */
    protected $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    /**
     * @param  $data
     *
     * @return mixed
     */
    protected function getModelData($data = [])
    {
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => isset($data['active']) ? 1 : 0,
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => isset($data['confirmed']) ? 1 : 0,
        ];

        return $data;
    }

    /**
     * @param array $data
     *
     * @return User
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = $this->registerRepository->create($this->getModelData($data));

            if ($user->save()) {

                event(new Registered($user));

                return $user;
            }

            throw new UserException(trans('auth::exceptions.users.create_error'));
        });
    }
}