<?php

namespace gateres\core;


class Controller{
	
	protected $request;
	protected $response;
	
	function __construct($_request,$_response){
		
		$this->request = $_request;
		$this->response = $_response;
	
	}//__construct
	
	protected function is($paramName,$value=null){
		
		// 1. check if param exists
		
		if(isset($this->request->params[$paramName]) == false) return false;
		
		// 2. check if is passed a value
		
		if($value==null) return true;
		
		if(is_string($value)){ // if is a string
			
			return strcmp($this->request->params[$paramName],$value) == 0;
			
		}else{ // if is another type
			
			return $this->request->params[$paramName] == $value;
			
		}
		
	}//is
	
	private function get(){}//get
	
	private function post(){}//post
	
	private function put(){}//put
	
	private function delete(){}//delete
	
}//Controller