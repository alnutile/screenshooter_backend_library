<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 26/07/14
 * Time: 19:15
 */


namespace ScreenShooter\QueueServices;


use ScreenShooter\QueueServices\Traits\LaravelQueueTraits;

final class QueueFactory
{

    use LaravelQueueTraits;

    /**
     * Call this method to get singleton
     *
     * @return QueueFactory
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new QueueFactory();
        }
        return $inst;
    }

    /**
     * Private ctor so nobody else can instance it
     *
     */
//    private function __construct()
//    {
//
//    }


}