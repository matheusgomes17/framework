<?php

namespace MVG\Domains\Users\Repositories;

use MVG\Domains\Users\Contracts\Repositories\UserRepositoryContract;
use MVG\Support\Domain\Database\Repository\BaseEloquentRepository;
use MVG\Support\Domain\Database\Repository\Traits\CacheResults;
use MVG\Domains\Users\Models\User;

/**
 * Class UserRepository
 * @package MVG\Domains\Users\Repositories
 */
class UserRepository extends BaseEloquentRepository implements UserRepositoryContract
{
    use CacheResults;

    /**
     * @var string
     */
    protected $model = User::class;
}