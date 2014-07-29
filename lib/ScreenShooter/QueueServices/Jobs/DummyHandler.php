<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 26/07/14
 * Time: 15:06
 */

namespace ScreenShooter\QueueServices\Jobs;

use ScreenShooter\ScreenShooterS3Service;



class DummyHandler
{

    public function fire($job, $data)
    {

        //ImageUploader@upload
        //params array('key');


        echo $job->getJobId() . " - Attempt: " . $job->attempts() . "\n";
        //throw new \Exception("Error Processing Request", 1);

        echo "Job Name: " . $job->getName() . "\n";

        echo "Data: " . $data['index'] . "\n";



//        $example = new ScreenShooterS3Service();
//
//        $fileName = 'faces.jpg';
//        $key = "test/" . $fileName;
//
//        $example->signedUrl($key);
//        $example->getPreSignedUrl($key);


        $job->delete();


    }

} 