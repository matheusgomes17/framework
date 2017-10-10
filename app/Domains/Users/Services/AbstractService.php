<?php

namespace MVG\Domains\Users\Services;

use MVG\Domains\Users\Contracts\Services\UserServiceContract;
use MVG\Domains\Users\Repositories\UserRepository;

/**
 * Class AbstractService
 *
 */
class AbstractService implements UserServiceContract
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    /**
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate()
    {
        return $this->userRepository->getPaginated();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id)
    {
        return $this->userRepository->getByID($id);
    }
}