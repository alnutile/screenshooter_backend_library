<?php
/**
 * Created by IntelliJ IDEA.
 * User: matej
 * Date: 29/07/14
 * Time: 20:10
 */


use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();


$capsule->addConnection([
    'driver'=> 'sqlite',
    'database'=>__DIR__.'/../db/database.sqlite',
    'prefix' => ''
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();