<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 7/23/14
 * Time: 12:52 PM
 */

namespace ScreenShooter\QueueServices;


interface QueueInterface {

    public function fire($job, $params);
} 