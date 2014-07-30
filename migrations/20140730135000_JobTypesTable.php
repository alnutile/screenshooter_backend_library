<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Phpmig\Migration\Migration;

class JobTypesTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {       
        Capsule::schema()->create('job_types', function ($table) {
            $table->increments('id');
            $table->integer('url_id');
            $table->string('type');
            $table->string('user_uuid')->nullable();
            $table->string('data')->nullable();
//    $table->string('status');
            $table->enum('status', array('processing', 'uploading' ,'done'))->nullable();
            $table->timestamps();
            $table->foreign('url_id')->references('id')->on('urls');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('job_types');
    }
}
