<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 29/07/14
 * Time: 20:16
 */

namespace ScreenShooter\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Url extends Eloquent
{

    protected $fillable = ['url', 'sitemap_id', 'user_uuid'];


    public $timestamps = true;

    public function sitemap()
    {
        return $this->belongsTo('ScreenShooter\Models\Sitemap');
    }

    public function jobTypes()
    {
        return $this->hasMany('ScreenShooter\Models\JobType');
    }

    public function jobAsset()
    {
        return $this->hasMany('ScreenShooter\Models\JobAsset');
    }

}