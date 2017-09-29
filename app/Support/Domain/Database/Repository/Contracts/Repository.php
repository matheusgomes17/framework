<?php

namespace MVG\Support\Domain\Database\Repository\Contracts;

/**
 * Interface Repository
 * @package MVG\Support\Domain\Database\Repository\Contracts
 */
interface Repository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function newQuery();

    /**
     * Creates a Model object with the $data information.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function factory(array $data = []);
}
