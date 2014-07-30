<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 29/07/14
 * Time: 20:16
 */

namespace ScreenShooter\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class JobType extends Eloquent
{

    protected $fillable = ['name', 'type', 'data', 'url_id', 'status', 'user_uuid'];


    public $timestamps = true;

    public function url()
    {
        return $this->belongsTo('Url');
    }

}