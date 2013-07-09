<?php

namespace example\controllers;

use gateres\core\Controller;
use gateres\core\Request;
use gateres\core\Response;

use example\models\User;


class Users extends Controller{
	
	
	/*http methods*/
	
	public function get(){
		
		if($this->pathParam('users')){
				
			$this->getUserById();	
				
		}else if($this->urlParam('name')){
			
			$this->getUserByName();	
			
		}else{

			$this->response->setStatus(Response::BAD_REQUEST);
			$this->response->send();
			
		}
		
	}//get
	
	private function post(){}//post
	
	private function put(){}//put
	
	private function delete(){}//delete
	
	
	/*other methods*/
	
	private function getUserById(){
		
		$id = $this->pathParam('users');
		
		$user = new User();
		$user->id = $id;
		
		$this->response->setStatus(Response::OK);
		$this->response->addToBody('user',$user);
		$this->response->send();
		
	}//getUserById
	
	
	private function getUserByName(){
		
		$name = $this->urlParam('name');
		
		$user = new User();
		$user->name = $name;
		
		$this->response->setStatus(Response::OK);
		$this->response->addToBody('user',$user);
		$this->response->send();
		
	}//getUserByName
	
	
}//Users