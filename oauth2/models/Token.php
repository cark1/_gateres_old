<?php

namespace oauth2\models;

use gateres\core\Model;


class Token extends Model{
	
	
	//data token
	public $accessToken;
	public $tokenType;
	public $expiresIn;
	public $scopes = array();
	public $refreshToken;
	
	
	function __construct(){
	
	}//__construct
	
	
	private static function generateAccessToken($len = 40){
		
		/* 1]
		$randomString = bin2hex(openssl_random_pseudo_bytes($len, $strong));
		// @codeCoverageIgnoreStart
		if (FALSE === $strong) {
			throw new Exception("unable to securely generate random string");
		}
		// @codeCoverageIgnoreEnd
		return $randomString;
		*/
		
		/* 2]
		// We generate twice as many bytes here because we want to ensure we have
		// enough after we base64 encode it to get the length we need because we
		// take out the "/", "+", and "=" characters.
		$bytes = openssl_random_pseudo_bytes($len * 2, $strong);
		
		// We want to stop execution if the key fails because, well, that is bad.
		if ($bytes === false || $strong === false) {
			// @codeCoverageIgnoreStart
			throw new \Exception('Error Generating Key');
			// @codeCoverageIgnoreEnd
		}
		
		return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $len);
		*/
	}//generateAccessToken
	
}//Token