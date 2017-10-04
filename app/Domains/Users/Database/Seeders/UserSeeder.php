<?php

namespace MVG\Domains\Users\Database\Seeders;

use MVG\Domains\Users\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersSeeder
 * @package MVG\Domains\Users\Database\Seeders
 */
class UsersSeeder extends Seeder
{

    public function run()
    {
        factory(User::class)->times(10)->create();
    }
}