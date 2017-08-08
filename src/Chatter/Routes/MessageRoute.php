<?php

use Chatter\Middleware\FileFilter;
use Chatter\Middleware\ImageRemoveExIf;
use Chatter\Middleware\FileMove;
use Chatter\Models\Message;

$app->get('/messages', function($request, $response, $args) {
	$_message = new Message();
	$messages = $_message->all();

	return $response->withStatus(200)->withJson($messages);
});


$app->post('/messages', function($request, $response, $args) {
	$_message = $request->getParsedBodyParam('message', '');

	$message = new Message();
	$message->body = $_message;
	$message->user_id = 1;
	$message->image_url = $request->getAttribute('png_file');
	$message->save();

	if ($message->id) {
		$payload = ['message_id' => $message->id, 'messege_uri' => '/messages/' . $message->id];
		return $response->withStatus(201)->withJson($payload);
	} else {
		return $response->withStatus(400);
	}

})->add(new FileFilter())->add(new ImageRemoveExIf());

$app->delete('/messages/{message_id}', function($request, $response, $args) {

	$message = Message::find($args['message_id']);
	$payload = ['message_id' => $message->id];
	$message->delete();

	if($message->exist) {
		return $response->withStatus(400);
	} else {
		return $response->withStatus(204)->withJson($payload);
	}
});
