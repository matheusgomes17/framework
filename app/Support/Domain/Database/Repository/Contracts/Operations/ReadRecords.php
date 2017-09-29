<?php

namespace MVG\Support\Domain\Database\Repository\Contracts\Operations;

use MVG\Support\Domain\Database\Repository\Contracts\Repository;

/**
 * Interface ReadRecords
 * @package MVG\Support\Domain\Database\Repository\Contracts\Operations
 */
interface ReadRecords extends Repository
{
    /**
     * Returns all records.
     * If $take is false then brings all records
     * If $paginate is true returns Paginator instance.
     *
     * @param int  $take
     * @param bool $paginate
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Pagination\AbstractPaginator
     */
    public function getAll($take = 15, $paginate = true);

    /**
     * Retrieves a record by his id
     * If $fail is true fires ModelNotFoundException. When no record is found.
     *
     * @param int  $id
     * @param bool $fail
     *
     * @return Model
     */
    public function findByID($id, $fail = true);

    /**
     * @param string      $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function pluck($column, $key = null);
}