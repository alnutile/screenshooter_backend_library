<?php

require_once __DIR__.'/../../vendor/autoload.php';

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

$app->get('/users', function () use ($app, $current_user) {
    return $app->json($current_user);
});

$app->run();