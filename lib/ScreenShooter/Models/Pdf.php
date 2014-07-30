<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 29/07/14
 * Time: 20:16
 */

namespace ScreenShooter\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Pdf extends Eloquent
{

    protected $fillable = ['name', 'sitemap_id', 'user_uuid'];


    public $timestamps = true;

    public function sitemap()
    {
        return $this->belongsTo('Sitemap');
    }

}