<?php

namespace MVG\Support\Domain\Database\Repository\Contracts\Operations;

use MVG\Support\Domain\Database\Repository\Contracts\Repository;

/**
 * Interface DeleteRecords
 * @package MVG\Support\Domain\Database\Repository\Contracts\Operations
 */
interface DeleteRecords extends Repository
{
    /**
     * Run the delete command model.
     * The goal is to enable the implementation of your business logic before the command.
     *
     * @param \Illuminate\Database\Eloquent\Model
     *
     * @return bool
     */
    public function delete($model);
}