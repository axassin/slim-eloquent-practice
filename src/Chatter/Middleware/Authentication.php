<?php

namespace Chatter\Middleware;

use Chatter\Models\User;

class Authentication
{
	public function __invoke($request, $response, $next) {
		
		$auth = $request->getHeader('Authorization');
		$_apikey = $auth[0];
		$apiKey = substr($_apikey, strpos($_apikey, ' ') + 1);
		
		$user = new User();
		if (!$user->authenticate($apiKey)) {
			$response->withStatus(401);
			return $response;
		}

		$response = $next($request, $response);

		return $response;
	}
}