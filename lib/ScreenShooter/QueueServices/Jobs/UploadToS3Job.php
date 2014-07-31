<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 30/07/14
 * Time: 10:57
 */

namespace ScreenShooter\QueueServices\Jobs;

use ScreenShooter\ScreenShooterS3Service;
use ScreenShooter\S3\KeyFactory;
use ScreenShooter\Models\JobType;
use ScreenShooter\S3\Status;

class UploadToS3Job
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

        $this->upload($message);
        //throw new \Exception("Failed");
    }


    public function upload($message)
    {

        var_dump($message);

        $filePath = $message['file_path'];
        $site_id = $message['site_id'];
        $sitemap_id = $message['sitemap_id'];
        $url_id = $message['url_id'];
        $message['status'] = Status::STATUS_UPLOADING;
        $message['type'] = 'image';

        $jobType = JobType::create($message);

        $job_type_id = $jobType->id;

        $path_parts = pathinfo($filePath);

//        echo $path_parts['dirname'], "\n";
//        echo $path_parts['basename'], "\n";
//        echo $path_parts['extension'], "\n";
//        echo $path_parts['filename'], "\n"; // since PHP 5.2.0

        $filename_extension = $path_parts['extension'];

        $key = KeyFactory::generateKey($site_id, $sitemap_id, $url_id, $job_type_id, $filename_extension);

        $this->s3Service->upload($filePath, $key);

        $jobType->status = Status::STATUS_DONE;
        $jobType->data = $path_parts['filename'];

        $jobType->save();


    }

}



