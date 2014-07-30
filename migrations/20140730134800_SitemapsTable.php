<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Phpmig\Migration\Migration;

class SitemapsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {

        Capsule::schema()->create('sitemaps', function ($table) {
            $table->increments('id');
            $table->integer('site_id');
            $table->string('name');
            $table->string('user_uuid')->nullable();
            $table->timestamps();
            $table->foreign('site_id')->references('id')->on('sites');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('sitemaps');
    }
}
