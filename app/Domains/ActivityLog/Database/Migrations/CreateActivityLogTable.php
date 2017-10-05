<?php

namespace MVG\Domains\ActivityLog\Database\Migrations;

use MVG\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateActivityLogTable
 * @package MVG\Domains\ActivityLog\Database\Migrations
 */
class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->schema->create(config('activitylog.table', 'activity_log'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('log_name')->nullable();
            $table->string('description');
            $table->integer('subject_id')->nullable();
            $table->string('subject_type')->nullable();
            $table->integer('causer_id')->nullable();
            $table->string('causer_type')->nullable();
            $table->text('properties')->nullable();
            $table->timestamps();

            $table->index('log_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->schema->drop(config('activitylog.table', 'activity_log'));
    }
}