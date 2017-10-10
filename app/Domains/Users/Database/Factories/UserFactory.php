<?php

namespace MVG\Domains\Users\Database\Factories;

use MVG\Domains\Users\Models\User;
use MVG\Support\Database\ModelFactory;

/**
 * Class UserFactory
 *
 */
class UserFactory extends ModelFactory
{
    protected $model = User::class;

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