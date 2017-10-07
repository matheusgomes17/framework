<?php

namespace MVG\Domains\Authentication\Database\Factories;

use MVG\Domains\Authentication\Models\Tenant;
use MVG\Support\Database\ModelFactory;

/**
 * Class TenantFactory
 * @package MVG\Domains\Authentication\Database\Factories
 */
class TenantFactory extends ModelFactory
{
    protected $model = Tenant::class;

    protected function fields()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}