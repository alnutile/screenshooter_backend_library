<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Phpmig\Migration\Migration;

class ScreenshooterJobsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {

        Capsule::schema()->create('screenshooter_jobs', function ($table) {
            $table->increments('id');
            $table->integer('sitemap_id');
            $table->string('name');
            $table->string('user_uuid')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->foreign('sitemap_id')->references('id')->on('sitemaps');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('screenshooter_jobs');
    }
}
