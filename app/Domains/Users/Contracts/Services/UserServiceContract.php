<?php

namespace MVG\Domains\Users\Contracts\Services;

/**
 * Interface UserServiceContract
 * @package MVG\Domains\Users\Contracts\Services
 */
interface UserServiceContract
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate();

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id);
}