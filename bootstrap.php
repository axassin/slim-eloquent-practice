<?php

include 'config/credentials.php';
include 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$settings = require 'config/config.php';

$app = new \Slim\App($settings);

$container = $app->getContainer();


$capsule->addConnection($container->get('settings')['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

require 'routes.php';