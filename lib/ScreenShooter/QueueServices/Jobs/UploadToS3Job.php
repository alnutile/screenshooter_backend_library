<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 30/07/14
 * Time: 10:57
 */

namespace ScreenShooter\QueueServices\Jobs;

use ScreenShooter\ScreenShooterS3Service;

class UploadToS3Job
{


    public function fire($job, $message)
    {
        //1. all goes well remove jobs
        //2. all goes bad put it back in the queue for another try
        //3. it max tries is met add it to failed queue

        $this->upload($message);
        throw new \Exception("Failed");
    }


    public function upload($message)
    {

        var_dump($message);

        $s3Service = new ScreenShooterS3Service();

        $fileName           = 'faces.jpg';
        $fileNameAndPath    = __DIR__ . '/../../assets/' . $fileName;

        $key="test/".$fileName;

        $s3Service->upload($fileNameAndPath, $key);

    }

}



