<?php

namespace MVG\Domains\Users\Database\Migrations;

use MVG\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateSocialAccountsTable
 * @package MVG\Domains\Users\Database\Migrations
 */
class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->schema->create(config('user.table_names.social_accounts', 'social_accounts'), function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer(config('user.foreign_keys.users', 'user_id'))->unsigned();
            $table->string('provider', 32);
            $table->string('provider_id');
            $table->string('token')->nullable();
            $table->string('avatar')->nullable();

            $table->foreign(config('user.foreign_keys.users', 'user_id'))
                ->references('id')
                ->on(config('user.table_names.users', 'users'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop(config('user.table_names.social_accounts', 'social_accounts'));
    }
}