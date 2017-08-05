<?php

require __DIR__ . '/vendor/autoload.php';

$app = new Slim\App;

$app->get('/messages', function($request, $response, $args) {
	return $response->write("messeges");
});

$app->run();