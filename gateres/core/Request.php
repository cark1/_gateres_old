<?php

namespace gateres\core;


class Request{
	
	public $headers;
	public $method;
	public $body;
	
	public $bodyParams;
	public $pathParams;
	public $urlParams;
	public $params;
	
	public $languages;

	
	function __construct($_pathApi){
		
		//headers
		$this->headers = getallheaders();
	
		//method
		$this->method = $_SERVER['REQUEST_METHOD'];
		
		//body
		$this->body = file_get_contents('php://input');
		
		//bodyParams
		parse_str($this->body,$this->bodyParams);

		//pathParams
		$this->pathParams = array();
		$pathExploded = explode('/',$_SERVER['PATH_INFO']);
		array_shift($pathExploded);
		
		for($i=0 , $length = count($pathExploded); $i<$length ; $i+=2){
			
			if(isset($pathExploded[$i+1])){
				
				$this->pathParams[$pathExploded[$i]] = $pathExploded[$i+1];
				
			}
			
		}
		
		//urlParams
		$this->urlParams=array();
		
		$queryStringArray = explode('&',$_SERVER['REDIRECT_QUERY_STRING']);
				
		foreach($queryStringArray as $param){
			
			$param = explode('=',$param);
			if($param[0]!=null){
				$this->urlParams[$param[0]] = urldecode($param[1]);
			}
		
		}
		
		//params
		$this->params = array_merge($this->bodyParams,$this->pathParams,$this->urlParams);
		
		//languages
		$this->languages = explode(',',$this->headers['Accept-Language']);
		
		foreach($this->languages as $key => $value){
			
			$this->languages[$key] = preg_replace('/;.*/', '', $value);
			
		}
	
	}//__construct
	
	
}//Request