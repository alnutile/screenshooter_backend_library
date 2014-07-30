<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Phpmig\Migration\Migration;

class JobAssetsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {

        Capsule::schema()->create('job_assets', function ($table) {
            $table->increments('id');
            $table->integer('url_id');
            $table->integer('screenshooter_job_id');
            $table->string('data');
            $table->string('user_uuid')->nullable();
//    $table->string('status');
            $table->enum('status', array('processing', 'uploading' ,'done'));
            $table->timestamps();
            $table->foreign('url_id')->references('id')->on('urls');
            $table->foreign('screenshooter_job_id')->references('id')->on('screenshooter_jobs');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('job_assets');
    }
}
