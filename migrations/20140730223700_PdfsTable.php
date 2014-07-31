<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 30/07/14
 * Time: 22:37
 */

use Illuminate\Database\Capsule\Manager as Capsule;
use Phpmig\Migration\Migration;

class PdfsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {

        Capsule::schema()->create('pdfs', function ($table) {
            $table->increments('id');
            $table->integer('sitemap_id');
            $table->string('name');
            $table->string('user_uuid')->nullable();
            $table->enum('status', array('processing', 'uploading' ,'done'));
            $table->timestamps();
            $table->foreign('sitemap_id')->references('id')->on('sitemaps');


        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('pdfs');
    }
}