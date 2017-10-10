<?php

namespace MVG\Domains\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use MVG\Domains\Users\Models\UserTenant;

/**
 * Class UserTenantSeeder
 *
 */
class UserTenantSeeder extends Seeder
{

    public function run()
    {
        factory(UserTenant::class, 1)->create([
            'email' => 'client1@user.com',
            'tenant_id' => '1',
        ]);

        factory(UserTenant::class, 1)->create([
            'email' => 'client2@user.com',
            'tenant_id' => '2',
        ]);
    }
}