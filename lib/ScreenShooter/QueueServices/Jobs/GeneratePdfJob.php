<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 30/07/14
 * Time: 22:29
 */

namespace ScreenShooter\QueueServices\Jobs;

use ScreenShooter\ScreenShooterS3Service;
use ScreenShooter\S3\KeyFactory;
use ScreenShooter\Models\Pdf;
use ScreenShooter\S3\Status;
use ScreenShooter\Models\Sitemap;

class GeneratePdfJob
{

    private $s3Service;

    function __construct()
    {
        $this->s3Service = new ScreenShooterS3Service();
    }

    public function fire($job, $message)
    {
        //1. all goes well remove jobs
        //2. all goes bad put it back in the queue for another try
        //3. it max tries is met add it to failed queue

        $this->generate($message);
        //throw new \Exception("Failed");
    }


    public function generate($message)
    {

        var_dump($message);

        $site_id = $message['site_id'];
        $sitemap_id = $message['sitemap_id'];


        $message['name']='PDF export';
        $message['status'] = Status::STATUS_PROCESSING;

        var_dump($message);

        $pdf = Pdf::create($message);

        $sitemap = Sitemap::find($site_id);

        $urls =$sitemap->urls;


        foreach ($urls as &$url)
        {
            var_dump($url);
        }




    }
} 