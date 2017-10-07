<?php

namespace MVG\Domains\Authentication\Database\Migrations;

use MVG\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateTenantsTable
 * @package MVG\Domains\Authentication\Database\Migrations
 */
class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->schema->create(config('auth.table_names.tenants', 'tenants'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('subdomain');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop(config('permission.table_names.tenants', 'tenants'));
    }
}