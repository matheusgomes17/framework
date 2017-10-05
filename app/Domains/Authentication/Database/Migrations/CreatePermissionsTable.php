<?php

namespace MVG\Domains\Authentication\Database\Migrations;

use MVG\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePermissionsTable
 * @package MVG\Domains\Authentication\Database\Migrations
 */
class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->schema->create(config('permission.table_names.permissions', 'permissions'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop(config('permission.table_names.permissions', 'permissions'));
    }
}