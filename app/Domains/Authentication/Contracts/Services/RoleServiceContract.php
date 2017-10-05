<?php

namespace MVG\Domains\Authentication\Contracts\Services;

/**
 * Interface RoleServiceContract
 * @package MVG\Domains\Authentication\Contracts\Services
 */
interface RoleServiceContract
{
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