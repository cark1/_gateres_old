<?php

namespace gateres\tools\database;

use PDO;
use oauth2\models\User;

class Database{
   
	private static $instance = null;
	private static $pdo;
	private static $stmt;


	public static function getInstance(){
		
	  	if(self::$instance == null){
		  
			self::$instance = new Database();

		  	self::$pdo=new PDO('mysql:host='.$GLOBALS['DB_HOST'].';port='.$GLOBALS['DB_PORT'].';dbname='.$GLOBALS['DB_NAME'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);

	  	}
	
		return self::$instance;
		
	}//getInstance
	
	
	public function setQuery($query){

		self::$stmt = self::$pdo->prepare($query);
		
	}//doQuery
	
	
	public function bindParam($key,$value){
		
		self::$stmt->bindParam($key, $value);
		
	}//bindParam
	
	
	public function execute(){
		
		return self::$stmt->execute();
		
	}//execute
	
	
	public function getResultTable($className = null){
		
		if($className == null){
			
			return self::$stmt->fetchall(PDO::FETCH_ASSOC);
		
		}else{
		
			return self::$stmt->fetchall(PDO::FETCH_CLASS, $className);
		
		}
		
	}//getResultsTable
	
	
	public function getLastInsertId(){
		
		return self::$pdo->lastInsertId();
		
	}//getLastInsertId
	
	
	public function getRowsAffected(){
		
		return self::$stmt->rowCount();
		
	}//getRowsAffected
	
	
	public function getError(){
		
		return self::$stmt->errorCode();
		
	}//getError
	
   
}//Database

