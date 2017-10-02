<?php

namespace MVG\Domains\Users\Repositories;

use MVG\Domains\Users\Contracts\Repositories\UserRepositoryContract;
use MVG\Suport\Database\Eloquent\Model;
use MVG\Support\Domain\Database\Repository\BaseEloquentRepository;
use MVG\Domains\Users\Models\User;

/**
 * Class UserRepository
 * @package MVG\Domains\Users\Repositories
 */
class UserRepository extends BaseEloquentRepository implements UserRepositoryContract
{
    protected $model = User::class;
}