<?php

namespace Chatter\Models;

use \Illuminate\Database\Eloquent\Model;

class User extends Model {
	
	public function authenticate($apiKey) {
		
		$user = User::Where('apikey', '=', $apiKey)->take(1)->get();
		$this->details = $user[0];

		return ($user[0]->exist) ? true : false;
	}
}