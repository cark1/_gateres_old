<?php

namespace oauth2\models;

use gateres\core\Model;


class Client extends Model{
	
	//client profiles
	const WEB_APPLICATION = 1; //web server (credentials are NOT visible) -> confidential
	const USER_AGENT_BASED_APPLICATION = 2; //browser application (dynamically issued credentials are visible) -> public
	const NATIVE_APPLICATION = 3; //app mobile (dynamically issued credentials are NOT visible) -> public
	
	public $id;
	public $secret;
	public $host;
	public $name;
	public $type;
	public $profile;
	public $redirectUri;
	
	
	function __construct(){
	
	}//__construct
	
}//Client