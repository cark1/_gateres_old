<?php

namespace oauth2\models;

use gateres\core\Model;
use gateres\tools\database\Database;


class User extends Model{
    
	public $id;
	public $email;
	public $password;
	
	function __construct(){
		
		parent::__construct('users');
	
	}//__construct
	
    
	public static function getUserByEmailAndPassword($_email, $_password){
        
        $db = Database::getInstance();
		
		$query = "SELECT * FROM users WHERE email=:email AND password=:password";

		$db->setQuery($query);
        $db->bindParam(":email",$_email);
        $db->bindParam(":password",sha1($_password));
		$db->execute();
		
        $results = $db->getResultTable(__CLASS__);
        
        if(count($results) == 0) return null;
        else return $results[0];
		
	}//getUserByEmailAndPassword
	
	
	public static function isEmailValid($_email){
		
		return filter_var($_email, FILTER_VALIDATE_EMAIL);
		
	}//isEmailValid
    
    
}//User