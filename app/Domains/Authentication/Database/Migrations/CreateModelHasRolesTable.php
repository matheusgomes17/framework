<?php

namespace MVG\Domains\Authentication\Database\Migrations;

use MVG\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateModelHasRolesTable
 * @package MVG\Domains\Authentication\Database\Migrations
 */
class CreateModelHasRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->schema->create(config('permission.table_names.model_has_roles', 'model_has_roles'), function (Blueprint $table) {
            $table->integer(config('permission.foreign_keys.roles', 'role_id'))->unsigned();
            $table->morphs('model');

            $table->foreign(config('permission.foreign_keys.roles', 'role_id'))
                ->references('id')
                ->on(config('permission.foreign_keys.roles', 'roles'))
                ->onDelete('cascade');

            $table->primary([config('permission.foreign_keys.roles', 'role_id'), 'model_id', 'model_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop(config('permission.table_names.model_has_roles', 'model_has_roles'));
    }
}