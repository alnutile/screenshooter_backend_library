<?php

date_default_timezone_set('America/Los_Angeles');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/database.php';


//use Dotenv;

\Dotenv::load(__DIR__ . '/../../');


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


/**
 * Logging for seeing events in the queue happen
 * Just type
 * tail -f storage/logs/base_queue.log
 * to see the output
 */
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__ . '/../../storage/logs/base_queue.log',
));


$current_user = [
    'mail' => 'user@example.com',
    'active' => "1",
    'uuid' => 'foo-bar-foo2-bar'
];

$app->get('/', function () use ($app) {
    return $app->json("You are here");
});

//$app->get('/users', function () use ($app, $current_user) {
//    return $app->json($current_user);
//});


use ScreenShooter\Models\Site;
use ScreenShooter\Models\Sitemap;
use ScreenShooter\Models\Url;


$app->get('/init', function () use ($app) {

    Site::create(['name' => 'Test', 'base_url' => 'https://www.bbc.com']);

    Sitemap::create(['name' => 'Sitemap 1', 'site_id' => 1]);
    Sitemap::create(['name' => 'Sitemap 2', 'site_id' => 1]);

    Url::create(['url' => '/1', 'sitemap_id' => 1]);
    Url::create(['url' => '/2', 'sitemap_id' => 1]);
    Url::create(['url' => '/3', 'sitemap_id' => 1]);


    return $app->json('');
});


$app->get('/sites', function () use ($app) {
    $sites = Site::all();
    return $app->json($sites);
});

$app->get('/sites/{id}', function ($id) use ($app) {
    $site = Site::findOrFail($id);
    return $app->json($site->first());
});


use Flow\Config;
use ScreenShooter\QueueServices\Jobs\UploadToS3Job;


$app->post('/sites/{site_id}/sitemaps/{sitemap_id}/url/{url_id}/upload', function ($site_id, $sitemap_id, $url_id) use ($app) {

    $user_uuid = '123';

    $config = new Config(array(
        'tempDir' => __DIR__ . '/../../chunks_temp_folder'
    ));
    $request = new Flow\Request();

    $milliseconds = round(microtime(true) * 1000);

    //Add prefix to file name so if two files with the same name are uploader will not be overwritten
    //TODO add user_id to the prefix as well
    $tempPath = __DIR__ . '/../../temp/' . $milliseconds . '_';

    $filePath = $tempPath . $request->getFileName();

    if (\Flow\Basic::save($filePath, $config, $request)) {
        $app['monolog']->addInfo("Hurray, file was saved in " . $filePath);

        $job = new UploadToS3Job();
        $job->fire(null, array('file_path' => $filePath, 'user_uuid' => $user_uuid, 'site_id' => $site_id, 'sitemap_id' => $sitemap_id, 'url_id' => $url_id));

    }


    return $app->json('');
});


use ScreenShooter\QueueServices\Jobs\GeneratePdfJob;

$app->get('/pdf', function () use ($app) {

    $site_id=1;
    $sitemap_id=1;


    $job = new GeneratePdfJob();
    $job->fire(null, array('user_uuid' => $user_uuid, 'site_id' => $site_id, 'sitemap_id' => $sitemap_id));


    return $app->json('');
});




$app->run();



