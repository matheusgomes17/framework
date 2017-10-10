<?php

namespace MVG\Domains\Authentication\Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class TenantsTableSeeder
 *
 */
class TenantsTableSeeder extends Seeder
{

    public function run()
    {
        factory(\MVG\Domains\Authentication\Models\Tenant::class, 1)->create([
            'subdomain' => 'client1'
        ]);

        factory(\MVG\Domains\Authentication\Models\Tenant::class, 1)->create([
            'subdomain' => 'client2'
        ]);
    }
}