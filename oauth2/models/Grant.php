<?php

namespace oauth2\models;

use gateres\core\Model;


abstract class Grant extends Model{
	
	//types
	const AUTHORIZATION_CODE = 'authorization_code';
	const PASSWORD = 'password';
	const CLIENT_CREDENTIALS = 'client_credentials';
	const REFRESH_TOKEN = 'refresh_token';
	
	
	public $type;
	
	
}//Grant