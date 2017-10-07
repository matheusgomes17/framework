<?php

namespace MVG\Domains\Categories\Services;

use MVG\Domains\Categories\Repositories\CategoryRepository;
use MVG\Domains\Users\Contracts\Services\UserServiceContract;

/**
 * Class AbstractService
 * @package MVG\Domains\Categories\Services
 */
class AbstractService implements UserServiceContract
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate()
    {
        return $this->categoryRepository->getPaginated();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id)
    {
        return $this->categoryRepository->getByID($id);
    }
}