<?php

namespace MVG\Domains\Categories\Database\Migrations;

use MVG\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateCategoriesTable
 *
 */
class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->schema->create(config('category.table_names.categories', 'categories'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');

            $table->integer(config('auth.foreign_keys.tenants', 'tenant_id'))->unsigned();
            $table->foreign(config('auth.foreign_keys.tenants', 'tenant_id'))
                ->references('id')
                ->on(config('auth.table_names.tenants', 'tenants'));

//            $table->foreign(config('category.foreign_keys.categories', 'category_id'))
//                ->references('id')
//                ->on(config('category.foreign_keys.categories', 'category_id'))
//                ->onDelete('cascade');

            $table->primary([
                config('auth.foreign_keys.tenants', 'tenant_id'),
            ]);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop(config('category.table_names.categories', 'categories'));
    }
}