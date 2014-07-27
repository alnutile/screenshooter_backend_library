<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 25/07/14
 * Time: 17:40
 */

namespace ScreenShooter\Tests;

use ScreenShooter\ScreenShooterQueue;

use Dotenv;

\Dotenv::load(__DIR__.'/../../');


class ScreenShooterQueueTest extends Base {


    /**
     * @test
     */
    public function sqs()
    {
        $example = new ScreenShooterQueue();
        $this->assertTrue($example->addJob());

    }



} 