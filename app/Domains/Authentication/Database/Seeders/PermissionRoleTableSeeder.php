<?php

namespace MVG\Domains\Authentication\Database\Seeders;

use MVG\Domains\Authentication\Models\Permission;
use MVG\Domains\Authentication\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder
 *
 */
class PermissionRoleTableSeeder extends Seeder
{

    public function run()
    {
        // Create Roles
        $admin = Role::create(['name' => 'administrator']);
        $executive = Role::create(['name' => 'executive']);
        $user = Role::create(['name' => 'user']);

        // Create Permissions
        Permission::create(['name' => 'view backend']);

        // Assign Permissions to Roles
        $admin->givePermissionTo('view backend');
        $executive->givePermissionTo('view backend');
    }
}