<?php

namespace MVG\Domains\Users\Database\Migrations;

use MVG\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateUsersTable
 *
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->schema->create(config('user.table_names.users', 'users'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->tinyInteger('active')->default(1)->unsigned();
            $table->string('confirmation_code')->nullable();
            $table->boolean('confirmed')->default(config('user.confirm_email') ? false : true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop(config('user.table_names.users', 'users'));
    }
}