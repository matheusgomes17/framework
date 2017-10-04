<?php

namespace MVG\Domains\Authentication\Repositories;

use MVG\Domains\Authentication\Contracts\Repositories\RegisterRepositoryContract;
use MVG\Support\Domain\Database\Repository\BaseEloquentRepository;
use MVG\Domains\Users\Models\User;

/**
 * Class RegisterRepository
 * @package MVG\Domains\Authentication\Repositories
 */
class RegisterRepository extends BaseEloquentRepository implements RegisterRepositoryContract
{
    /**
     * @var \MVG\Support\Database\Eloquent\Model $model
     */
    protected $model = User::class;
}