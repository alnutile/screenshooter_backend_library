<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 29/07/14
 * Time: 20:16
 */

namespace ScreenShooter\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Site extends Eloquent
{

    protected $fillable = array('name', 'base_url', 'user_uuid');


    public $timestamps = true;


    public function sitemaps()
    {
        return $this->hasMany('ScreenShooter\Models\Sitemap');
    }

}