<?php

namespace gateres\core;


class Router{

	public $request;
	public $response;
	
	function __construct($_request,$_response){
		
		$this->request = $_request;
		$this->response = $_response;
		
		//the name of last path params is the name of controller
		end($this->request->pathParams);
		$lastKey = key($this->request->pathParams);
		
		$controller = $GLOBALS['APP_DIR'].'\\controllers\\'.$lastKey.'Controller';
		$this->callController($controller, $this->request->method);
		
	}//__construct
	
	
	private function callController($controllerName,$methodName){
		
		//check if controller exists
		if(class_exists($controllerName)){
			
			$controller = new $controllerName($this->request,$this->response);
			
			//check if method is callable
			if(is_callable(array($controller, $methodName))){

				$controller->$methodName();

			}else{

				$this->response->setStatus(Response::METHOD_NOT_ALLOWED);
				$this->response->send();

			}
			
		}else{
			
			$this->response->setStatus(Response::BAD_REQUEST);
			$this->response->send();
			
		}
		
	}//callController
	
	
}//Router