<?php

namespace MVG\Domains\Authentication\Database\Seeders;

use MVG\Domains\Users\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder
 * @package MVG\Domains\Authentication\Database\Seeders
 */
class UserRoleTableSeeder extends Seeder
{
    public function run()
    {
        User::find(1)->assignRole('administrator');
        User::find(2)->assignRole('executive');
        User::find(3)->assignRole('user');
    }
}