<?php

require 'bootstrap.php';


use Chatter\Middleware\Logging as ChatterLogging;
use Chatter\Middleware\Authentication as ChatterAuth;

$app->add(new ChatterAuth());
$app->add(new ChatterLogging());

$app->run();
