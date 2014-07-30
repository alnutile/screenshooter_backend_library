<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Phpmig\Migration\Migration;

class UrlsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('urls', function ($table) {
            $table->increments('id');
            $table->integer('sitemap_id');
            $table->string('url');
            $table->string('user_uuid')->nullable();
            $table->timestamps();
            $table->foreign('sitemap_id')->references('id')->on('sitemaps');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('urls');
    }
}
