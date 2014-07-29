<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 7/23/14
 * Time: 12:10 PM
 */

namespace ScreenShooter;


use ScreenShooter\Traits\AmazonTraits;


use \Illuminate\Queue\Capsule\Manager as Queue;

use  ScreenShooter\QueueServices\QueueFactory;

class ScreenShooterQueue
{
    use AmazonTraits;


    //http://stackoverflow.com/questions/11250691/aws-sqs-practical-code-php

    //http://squirrelshaterobots.com/programming/php/building-a-queue-server-in-php-part-1-understanding-the-project/

    //http://symfony.com/doc/current/components/process.html  !!!!

    //http://www.alfrednutile.info/posts/59
    public function addJob()
    {


//        $aws = $this->aws_factory($this->config);
//        $client = $aws->get('Sqs');
//
//        $result = $client->createQueue(array('QueueName' => 'my-queue'));
//
//        var_dump($result);
//
//        $queueUrl = $result->get('QueueUrl');
//
//
//        var_dump($queueUrl);
//
//
//        $client->sendMessage(array(
//            'QueueUrl'    => $queueUrl,
//            'MessageBody' => 'An awesome message!',
//        ));
//
//        $result = $client->receiveMessage(array(
//            'QueueUrl' => $queueUrl,
//        ));
//
//        foreach ($result->getPath('Messages/*/Body') as $messageBody) {
//            // Do something with the message
//            echo $messageBody;
//        }


        $instance = QueueFactory::Instance();


//        for ($x = 0; $x <= 10; $x++) {
//            Queue::push('\ScreenShooter\QueueServices\Jobs\DummyHandler', array('index' => $x));
//        }


        Queue::push('\ScreenShooter\QueueServices\Jobs\DummyHandler', array('index' => $x));

        return true;

    }


}