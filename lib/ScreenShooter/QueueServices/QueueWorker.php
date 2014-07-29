<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 26/07/14
 * Time: 20:14
 */

namespace ScreenShooter\QueueServices;

use ScreenShooter\QueueServices\Traits\LaravelQueueTraits;
use \Illuminate\Queue\Capsule\Manager as Queue;



class QueueWorker
{
    use LaravelQueueTraits;

    public function run()
    {

        //../../bootstrap.php
        $oldtime = microtime();

        while (true) {
            try {

                var_dump("----------queue.worker");

                $nowtime = microtime();


                echo (($nowtime - $oldtime) / 1000) . " s \n";
                echo ($nowtime - $oldtime) . " ms \n";

                $oldtime = $nowtime;

                //pop($connectionName, $queue = null, $delay = 0, $sleep = 3, $maxTries = 0)
                $this->getWorker()->pop('default', 'default', 0, 64, 2, 3);

            } catch (\Exception $e) {
                // Log or do something here

                var_dump($e->getMessage());
                //break;
            }
        }
    }

} 