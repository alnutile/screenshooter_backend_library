<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 26/07/14
 * Time: 19:19
 */


namespace ScreenShooter\QueueServices\Traits;

//include_once './vendor/autoload.php';

trait LaravelQueueTraits
{

    protected $app;

    protected $queue;

    protected $worker;

    /**
     * @return mixed
     */
    public function getWorker()
    {
        return $this->worker;
    }

    /**
     * @param mixed $worker
     */
    public function setWorker($worker)
    {
        $this->worker = $worker;
    }

    /**
     * @return mixed
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param mixed $queue
     */
    public function setQueue($queue)
    {
        $this->queue = $queue;
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param mixed $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     *
     */
    public function __construct()
    {

        var_dump("__construct");
        $app = new \Illuminate\Container\Container;


        var_dump("Start queue ");

        $queue = new \Illuminate\Queue\Capsule\Manager($app);

        $queue->addConnection(array(
            'driver' => 'beanstalkd',
            'host' => 'localhost',
            'queue' => 'default',
        ), 'default');


//'sqs' => array(
//    'driver' => 'sqs',
//    'key'    => 'your-public-key',
//    'secret' => 'your-secret-key',
//    'queue'  => 'your-queue-url',
//    'region' => 'us-east-1',
//),
//
//		'redis' => array(
//    'driver' => 'redis',
//    'queue'  => 'default',
//),


        $queue->setAsGlobal();


        $queue->getContainer()->bind('encrypter', function () {
            return new \Illuminate\Encryption\Encrypter('foobar');
        });
        $queue->getContainer()->bind('request', function () {
            return new \Illuminate\Http\Request();
        });

        $this->setQueue($queue);
        $this->setApp($app);

        $this->setWorker(new \Illuminate\Queue\Worker($queue->getQueueManager(), null, null));


    }


}