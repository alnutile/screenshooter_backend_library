<?php

date_default_timezone_set('America/Los_Angeles');
require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__ .'/../../config/database.php';


//use Dotenv;

\Dotenv::load(__DIR__.'/../../');


$app = new Silex\Application();
$app['debug'] = true;
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => [
        'users' => array(
            'pattern' => '^/users',
            'http' => true,
            'users' => array(
                'admin' => array('ROLE_ADMIN', '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg=='),
            ),
        ),
    ]
));

$current_user = [
    'mail' => 'user@example.com',
    'active' =>  "1",
    'uuid' => 'foo-bar-foo2-bar'
];

$app->get('/', function() use ($app) {
    return $app->json("You are here");
});

//$app->get('/users', function () use ($app, $current_user) {
//    return $app->json($current_user);
//});


use ScreenShooter\Models\Site;



$app->get('/sites', function() use ($app){
    $sites = Site::all();
    return $app->json($sites);
});

$app->get('/sites/{id}', function($id) use ($app){
    $site = Site::findOrFail($id);
    return $app->json($site->first());
});


use ScreenShooter\QueueServices\Jobs\UploadToS3Job;

$app->get('/upload', function () use ($app) {


    $job = new UploadToS3Job();

    $job->fire(null,array());

    return $app->json('OK');
});


$app->run();



