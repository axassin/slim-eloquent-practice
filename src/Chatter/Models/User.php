<?php

namespace Chatter\Models;

use \Illuminate\Database\Eloquent\Model;

class User extends Model {
	
	protected $hidden = ['password'];

	public function authenticate($apiKey) {
		$user = self::where('apikey', '=', $apiKey)->take(1)->get();
		$this->details = $user[0];
		// var_dump($user[0] ? true : false);
		return $user[0] ? true : false;
	}
}