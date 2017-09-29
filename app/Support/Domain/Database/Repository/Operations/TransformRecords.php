<?php

namespace MVG\Support\Domain\Database\Repository\Operations;

use MVG\Support\Domain\Database\Repository\Contracts\Fractal\Factory;

/**
 * Trait TransformRecords
 * @package MVG\Support\Domain\Database\Repository\Operations
 */
trait TransformRecords
{
    /**
     * @return Factory
     */
    protected function getFractalFactory()
    {
        return app(Factory::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Contracts\Support\Arrayable $item
     * @param array           $meta
     *
     * @return \ArrayAccess
     */
    public function transformItem($item, $meta = [])
    {
        return $this->getFractalFactory()->makeItem($item, $meta, $this->getTransformer());
    }

    /**
     * @param \Illuminate\Support\Collection $collection
     * @param array      $meta
     *
     * @return \Illuminate\Support\Collection
     */
    public function transformCollection($collection, $meta = [])
    {
        return $this->getFractalFactory()->makeCollection($collection, $meta, $this->getTransformer());
    }

    /**
     * @return \League\Fractal\TransformerAbstract
     */
    protected function getTransformer()
    {
        return app($this->transformerClass);
    }
}