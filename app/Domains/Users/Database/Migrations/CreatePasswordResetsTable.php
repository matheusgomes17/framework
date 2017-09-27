<?php

namespace MVG\Domains\Users\Database\Migrations;

use MVG\Support\Domain\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePasswordResetsTable
 * @package MVG\Domains\Users\Database\Migrations
 */
class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
        $this->schema->create(config('user.password_resets.table', 'password_resets'), function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        $this->schema->drop(config('user.password_resets.table', 'password_resets'));
    }
}