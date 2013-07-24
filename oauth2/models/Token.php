<?php

namespace oauth2\models;

use gateres\core\Model;


class Token extends Model{
	
	const ACCESS = 1;
    const REFRESH = 2;
    
	//data token
	public $id;
	public $idUser;
	public $type;
	public $creationTime;
	public $expireTime;
	
	function __construct(){
        
        parent::__construct('tokens');
        
	}//__construct
	
	
	public static function generateToken($len){
		
		$randomString = bin2hex(openssl_random_pseudo_bytes($len, $strong));

		if ($strong) {
			return $randomString;
		}

	}//generateToken
	
}//Token