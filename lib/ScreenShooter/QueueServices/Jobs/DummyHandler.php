<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 26/07/14
 * Time: 15:06
 */

namespace ScreenShooter\QueueServices\Jobs;

class DummyHandler {

    public function fire($job, $data)
    {


        echo $job->getJobId() . " - Attempt: " . $job->attempts() . "\n";
        //throw new \Exception("Error Processing Request", 1);

        echo "Job Name: ".$job->getName() . "\n";

        echo "Data: ".$data['index'] . "\n";

//        sleep(2);

        $job->delete();


    }

} 