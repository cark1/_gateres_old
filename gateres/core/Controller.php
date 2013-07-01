<?php

namespace gateres\core;


class Controller{
	
	protected $request;
	protected $response;
	
	function __construct($_request,$_response){
		
		$this->request = $_request;
		$this->response = $_response;
	
	}//__construct
	
	
	protected function urlParam($_paramName){
		
		if(isset($this->request->urlParams[$_paramName]) == false){
			return null;
		}else{
			return $this->request->urlParams[$_paramName];
		}
		
	}//urlParam
	
	
	protected function bodyParam($_paramName,$_value=null){
		
		if(isset($this->request->bodyParams[$_paramName]) == false){
			return null;
		}else{
			return $this->request->bodyParams[$_paramName];
		}
		
	}//bodyParam
	
	
	protected function pathParam($_paramName,$_value=null){
		
		if(isset($this->request->pathParams[$_paramName]) == false){
			return null;
		}else{
			return $this->request->pathParams[$_paramName];
		}
		
	}//pathParam
	
	
	private function get(){}//get
	
	private function post(){}//post
	
	private function put(){}//put
	
	private function delete(){}//delete
	
	
}//Controller