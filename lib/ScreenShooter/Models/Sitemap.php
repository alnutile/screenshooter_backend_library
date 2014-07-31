<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 29/07/14
 * Time: 20:16
 */

namespace ScreenShooter\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Sitemap extends Eloquent
{

    protected $fillable = ['name', 'site_id', 'user_uuid'];


    public $timestamps = true;


    public function urls()
    {
        return $this->hasMany('ScreenShooter\Models\Url');
    }

    public function site()
    {
        return $this->belongsTo('Site');
    }

    public function screenshooterJobs()
    {
        return $this->hasMany('ScreenShooter\Models\ScreenshooterJob');
    }

    public function pdfs()
    {
        return $this->hasMany('ScreenShooter\Models\Pdf');
    }


}