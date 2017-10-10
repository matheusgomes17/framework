<?php

namespace MVG\Domains\Categories\Database\Factories;

use MVG\Domains\Categories\Models\Category;
use MVG\Support\Database\ModelFactory;

/**
 * Class CategoryFactory
 *
 */
class CategoryFactory extends ModelFactory
{
    protected $model = Category::class;

    protected function fields()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}