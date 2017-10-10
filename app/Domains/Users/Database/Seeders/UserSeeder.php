<?php

namespace MVG\Domains\Users\Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MVG\Domains\Users\Models\User;

/**
 * Class UsersSeeder
 *
 */
class UsersSeeder extends Seeder
{

    public function run()
    {
        // Add the master administrator, user id of 1
        $users = [
            [
                'tenant_id'         => 1,
                'first_name'        => 'Admin',
                'last_name'         => 'Istrator',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'tenant_id'         => 1,
                'first_name'        => 'Backend',
                'last_name'         => 'User',
                'email'             => 'executive@executive.com',
                'password'          => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'tenant_id'         => 1,
                'first_name'        => 'Default',
                'last_name'         => 'User',
                'email'             => 'user@user.com',
                'password'          => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'tenant_id'         => 2,
                'first_name'        => 'Admin',
                'last_name'         => 'Istrator',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table(config('user.table_names.users'))->insert($users);

        factory(User::class)->times(10)->create();
    }
}