<?php

namespace MVG\Domains\Users\Database\Factories;

use MVG\Domains\Authentication\Models\Tenant;
use MVG\Support\Database\ModelFactory;

/**
 * Class UserTenantFactory
 * @package MVG\Domains\Authentication\Database\Factories
 */
class UserTenantFactory extends ModelFactory
{
    protected $model = Tenant::class;

    protected function fields()
    {
        static $password;

        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => $password ?: $password = bcrypt('secret'),
            'remember_token' => str_random(10),
        ];
    }
}