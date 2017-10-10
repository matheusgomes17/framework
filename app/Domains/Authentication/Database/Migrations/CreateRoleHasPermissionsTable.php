<?php

namespace MVG\Domains\Authentication\Database\Migrations;

use MVG\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateRoleHasPermissionsTable
 *
 */
class CreateRoleHasPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->schema->create(config('permission.table_names.role_has_permissions', 'role_has_permissions'), function (Blueprint $table) {
            $table->integer(config('permission.foreign_keys.permissions', 'permission_id'))->unsigned();
            $table->integer(config('permission.foreign_keys.roles', 'role_id'))->unsigned();

            $table->foreign(config('permission.foreign_keys.permissions', 'permission_id'))
                ->references('id')
                ->on(config('permission.table_names.permissions', 'permissions'))
                ->onDelete('cascade');

            $table->foreign(config('permission.foreign_keys.roles', 'role_id'))
                ->references('id')
                ->on(config('permission.table_names.roles', 'roles'))
                ->onDelete('cascade');

            $table->primary([
                config('permission.foreign_keys.permissions', 'permission_id'),
                config('permission.foreign_keys.roles', 'role_id')
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop(config('permission.table_names.role_has_permissions', 'role_has_permissions'));
    }
}