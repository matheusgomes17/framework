<?php

namespace MVG\Support\Domain\Database\Repository\Contracts\Operations;

use MVG\Support\Domain\Database\Repository\Contracts\Repository;

/**
 * Interface TransformRecords
 * @package MVG\Support\Domain\Database\Repository\Contracts\Operations
 */
interface TransformRecords extends Repository
{
    /**
     * @param \ArrayAccess $item
     * @param array           $meta
     *
     * @return \ArrayAccess
     */
    public function transformItem($item, $meta = []);

    /**
     * @param \Illuminate\Support\Collection $collection
     * @param array                                    $meta
     *
     * @return \ArrayAccess
     */
    public function transformCollection($collection, $meta = []);
}