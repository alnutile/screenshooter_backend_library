<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 29/07/14
 * Time: 20:16
 */

namespace ScreenShooter\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class JobAsset extends Eloquent
{

    protected $fillable = ['url_id', 'screenshooter_job_id', 'data', 'status', 'user_uuid'];


    public $timestamps = true;

    public function url()
    {
        return $this->belongsTo('Url');
    }

    public function screenshooterJob()
    {
        return $this->belongsTo('ScreenshooterJob');
    }

}