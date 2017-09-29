<?php

namespace MVG\Support\Domain\Database\Repository\Fractal\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use League\Fractal\TransformerAbstract;

/**
 * Class GenericTransformer
 * @package MVG\Support\Domain\Database\Repository\Fractal\Transformers
 */
class GenericTransformer extends TransformerAbstract
{
    /**
     * @param mixed $data
     *
     * @return array
     */
    public function transform($data)
    {
        if (is_array($data)) {
            return $data;
        }

        if (is_object($data) && $data instanceof Arrayable) {
            return $data->toArray();
        }

        return (array) $data;
    }
}
