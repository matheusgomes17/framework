<?php

namespace MVG\Domains\Categories\Repositories;

use MVG\Domains\Categories\Contracts\Repositories\CategoryRepositoryContract;
use MVG\Domains\Categories\Models\Category;
use MVG\Support\Domain\Database\Repository\BaseEloquentRepository;
use MVG\Support\Domain\Database\Repository\Traits\CacheResults;

/**
 * Class CategoryRepository
 *
 */
class CategoryRepository extends BaseEloquentRepository implements CategoryRepositoryContract
{
    use CacheResults;

    /**
     * @var array
     */
    protected $relationships = [];

    /**
     * @var string
     */
    protected $model = Category::class;
}