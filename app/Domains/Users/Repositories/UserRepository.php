<?php

namespace MVG\Domains\Users\Repositories;

use Illuminate\Database\Eloquent\Model;
use MVG\Domains\Users\Contracts\Repositories\UserRepository as UserRepositoryContract;
use MVG\Support\Domain\Database\Repository\CrudRepository as BaseRepository;
use MVG\Domains\Users\Models\User;

/**
 * Class UserRepository
 * @package MVG\Domains\Users\Repositories
 */
class UserRepository extends BaseRepository implements UserRepositoryContract
{
    protected $modelClass = User::class;

    protected function setModelData(Model $model, array $data = [])
    {
        if (array_key_exists('password', $data)) {
            $data['password'] = bcrypt($data['password']);
        }

        parent::setModelData($model, $data);
    }
}