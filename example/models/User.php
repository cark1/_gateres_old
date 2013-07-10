<?php

namespace example\models;

use gateres\core\Model;
use gateres\tools\database\Database;


class User extends Model{
	
	public $id;
	public $name;
	public $surname;
	
	function __construct(){
		
		parent::__construct('users');
	
	}//__construct
	
	
	public static function getAllUsers(){
		
		$query = "SELECT * FROM users";

		Database::getInstance()->setQuery($query);

		Database::getInstance()->execute();
		
		return Database::getInstance()->getResultTable(__CLASS__);
		
	}//getAllUsers
	
	
}//User