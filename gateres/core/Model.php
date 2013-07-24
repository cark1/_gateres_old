<?php

namespace gateres\core;

use gateres\tools\database\Database;

class Model{
	
	protected $db;
	protected $tableName;
	
	protected $id;


	function __construct($_tableName){
		
		$this->tableName = $_tableName;
		
		$this->db = Database::getInstance();
			
	}//__construct
	
	
	function create(){		
		
		$propertyes = get_object_vars($this);
		unset($propertyes['db']);
		unset($propertyes['tableName']);
		$keys = array_keys($propertyes);
		
		$columns = implode(',',$keys);
		$values = implode(',:',$keys);
		
		$query = "INSERT INTO ".$this->tableName." (".$columns.") VALUES (:".$values.")";
		
		$this->db->setQuery($query);
		
		foreach($propertyes as $key => $value){
			
			$this->db->bindParam(':'.$key,$value);
			
		}
		
		$done = $this->db->execute();
		
		if($this->id == null){
			//autoincrement id
			$this->id = $this->db->getLastInsertId();
		}
		
		return $done;
		
	}//create
	
	
	function read(){
		
		$propertyes = get_object_vars($this);
		unset($propertyes['db']);
		unset($propertyes['tableName']);
		$keys = array_keys($propertyes);
		
		$columns = implode(',',$keys);
		
		$query = "SELECT ".$columns." FROM ".$this->tableName." WHERE id = :id";
		
		$this->db->setQuery($query);
		$this->db->bindParam(':id',$this->id);
		
		$done = $this->db->execute();
		if($done==false) return -1;
		
		$results = $this->db->getResultTable();
		if(count($results)<1) return 0;
		
		foreach($results[0] as $key => $result){

			$this->$key = $result;

		}
			
		return 1;
		
	}//read
	
	
	function update(){
		
		$columnsToUpdate = func_get_args();
		
		$columnValueString = "";
		
		foreach($columnsToUpdate as $column){
			
			if(strlen($columnValueString) != 0) $columnValueString.=',';
			
			$columnValueString.=$column.'=:'.$column;
			
		}
		
		$query = "UPDATE ".$this->tableName." SET ".$columnValueString." WHERE id = :id";
		
		$this->db->setQuery($query);
		
		foreach($columnsToUpdate as $column){
			
			$this->db->bindParam(':'.$column, $this->$column);
			
		}
		
		$this->db->bindParam(':id', $this->id);
		
		$done = $this->db->execute();
	
		if($done == false) return false;
		
		//return 0 also if the where clause match, but no one value changes.
		if($this->db->getRowsAffected() <= 0) return false;
			
		return true; 
		
	}//update
	
	
	function delete(){
		
		$query = "DELETE FROM ".$this->tableName." WHERE id = :id";
		
		$this->db->setQuery($query);
		$this->db->bindParam(':id',$this->id);
		
		$done = $this->db->execute();
		
		if($done == false) return false;
		
		//return 0 also if the where clause match, but no one value changes.
		if($this->db->getRowsAffected() <= 0) return false;
			
		return true;
		
	}//delete
	
	
}//Model