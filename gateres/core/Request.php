<?php

namespace gateres\core;


class Request{
	
	public $headers;
	
	public $method;
	
	public $username;
	public $password;
	
	public $urlParams;
	public $bodyParams;
	public $pathParams;
	
	public $languages;

	
	function __construct(){
		
		//headers
		$this->headers = getallheaders();
	
		//method
		$this->method = $_SERVER['REQUEST_METHOD'];
		
		//username and password
		$this->username = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : null;
		$this->password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : null;
		
		//urlParams (parse_str automatically urldecodes values)
		if(isset($_SERVER['REDIRECT_QUERY_STRING'])){
			parse_str($_SERVER['REDIRECT_QUERY_STRING'],$this->urlParams);
		}
		
		//bodyParams (parse_str automatically urldecodes values)
		parse_str(file_get_contents('php://input'),$this->bodyParams);

		//pathParams
		$this->pathParams = array();
		
		if(isset($_SERVER['PATH_INFO'])){
			
			$pathExploded = explode('/',$_SERVER['PATH_INFO']);
			array_shift($pathExploded);
		
			for($i=0 , $length = count($pathExploded); $i<$length ; $i+=2){
			
				if(isset($pathExploded[$i+1])){
					$this->pathParams[$pathExploded[$i]] = $pathExploded[$i+1];
				}
			
			}
		
		}
		
		//languages
		$this->languages = explode(',',$this->headers['Accept-Language']);
		
		foreach($this->languages as $key => $value){
			
			$this->languages[$key] = preg_replace('/;.*/', '', $value);
			
		}
	
	}//__construct
	
	
}//Request