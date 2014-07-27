<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 26/07/14
 * Time: 20:18
 */

include_once './vendor/autoload.php';

use  ScreenShooter\QueueServices\QueueWorker;


$worker = new QueueWorker();
$worker ->run();