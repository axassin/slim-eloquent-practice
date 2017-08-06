<?php

require 'vendor/autoload.php';
include 'bootstrap.php';

use Chatter\Models\Message;
use Chatter\Middleware\Logging as ChatterLogging;
use Chatter\Middleware\Authentication as ChatterAuth;

$app = new Slim\App();

$app->add(new ChatterAuth());
$app->add(new ChatterLogging());

$app->get('/messages', function($request, $response, $args) {
	$_message = new Message();
	$messages = $_message->all();

	return $response->withStatus(200)->withJson($messages);
});

$app->run();