<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 26/07/14
 * Time: 15:32
 */



//require __DIR__.'/../../vendor/autoload.php';

date_default_timezone_set('America/New_York');

include_once './vendor/autoload.php';

use \Illuminate\Queue\Capsule\Manager as Queue;
use \Carbon\Carbon;


$queue = new Queue;

//$queue->addConnection(require __DIR__.'/config/queue.php');


$queue->addConnection(array(
    'driver' => 'beanstalkd',
    'host' => 'localhost',
    'queue' => 'default',
), 'default');




// Make this Capsule instance available globally via static methods... (optional)
$queue->setAsGlobal();

$date = Carbon::now()->addMinutes(2);
$queue->getContainer()->bind('encrypter', function() {
    return new \Illuminate\Encryption\Encrypter('foobar');
});
$queue->getContainer()->bind('request', function() {
    return new \Illuminate\Http\Request();
});
//Queue::push($date, 'EmailTest', array('foo' => 'bar'));
Queue::push('EmailTest', array('foo' => 'bar'));

class EmailTest
{
    public function fire($job, $data)
    {
        var_dump($job);
        var_dump($data);
        mail('matej.dolanc@yahoo.com', 'hiya', $data['foo']);
    }
}

//var_dump("SLEEP");
//
//sleep(30);

var_dump("END");