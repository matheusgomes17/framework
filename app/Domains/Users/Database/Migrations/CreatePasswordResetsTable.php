<?php

namespace MVG\Domains\Users\Database\Migrations;

use MVG\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePasswordResetsTable
 * @package MVG\Domains\Users\Database\Migrations
 */
class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
        $this->schema->create(config('user.table_names.password_resets', 'password_resets'), function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        $this->schema->drop(config('user.table_names.password_resets', 'password_resets'));
    }
}