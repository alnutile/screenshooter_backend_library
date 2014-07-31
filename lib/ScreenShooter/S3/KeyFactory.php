<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 30/07/14
 * Time: 21:27
 */

namespace ScreenShooter\S3;

class KeyFactory {

    /**
     * @param $site_id
     * @param $sitemap_id
     * @param $url_id
     * @param $job_type_id
     * @param $filename_extension
     * @return string
     */
    public static function generateKey($site_id,$sitemap_id,$url_id,$job_type_id,$filename_extension)
    {
        return 'site_'.$site_id.'/'.'sitemap_'.$sitemap_id.'/'.'url_'.$url_id.'/'.$job_type_id.'.'.$filename_extension;
    }

} 