<?php

namespace oauth2\models;

use gateres\core\Model;
use oauth2\models\Grant;


class PasswordGrant extends Grant{
	
	private $username;
	private $password;
	private $scope;
	
	function __construct(){
	
		$this->type = Grant::$PASSWORD;
	
	}//__construct
	
	
}//PasswordGrant