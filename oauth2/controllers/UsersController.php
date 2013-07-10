<?php

namespace oauth2\controllers;

use \Exception;
use gateres\core\Controller;
use gateres\core\Request;
use gateres\core\Response;
use gateres\core\Model;

use oauth2\models\User;



class UsersController extends Controller{
	
	
	/*http methods*/
	
	public function get(){
		
		if($this->pathParam('users')){
			
			$this->getUserById();
			
		}else{
			
			$this->getAllUsers();
			
		}
		
	}//get
	
	
	public function post(){
		
		$user = new User();
		$user->name=$this->bodyParam('name');
		$user->surname=$this->bodyParam('surname');
		$done = $user->create();
		
		if($done){
			$this->response->setStatus(Response::CREATED);
			$this->response->addToBody('idUser',$user->id);
			$this->response->send();
		}else{
			$this->response->setStatus(Response::INTERNAL_SERVER_ERROR);
			$this->response->send();
		}
		
	}//post
	
	
	public function put(){
		
		$user = new User();
		$user->id = $this->pathParam('users');
		$user->name = 'cambio2';
		
		$status = $user->update('name');
		
		if($status == 1){
			$this->response->setStatus(Response::OK);
			$this->response->send();
		}else if($status == 0){
			$this->response->setStatus(Response::NOT_FOUND);
			$this->response->send();
		}else{
			$this->response->setStatus(Response::INTERNAL_SERVER_ERROR);
			$this->response->send();
		}
		
	}//put
	
	
	public function delete(){
		
		$user = new User();
		$user->id = $this->pathParam('users');
		
		$status = $user->delete();
		
		if($status == 1){
			$this->response->setStatus(Response::OK);
			$this->response->send();
		}else if($status == 0){
			$this->response->setStatus(Response::NOT_FOUND);
			$this->response->send();
		}else{
			$this->response->setStatus(Response::INTERNAL_SERVER_ERROR);
			$this->response->send();
		}
		
	}//delete
	

	/*other methods*/
	
	
	private function getUserById(){
		
		$user = new User();
		$user->id = $this->pathParam('users');
		
		$status = $user->read();
		
		if($status == 1){
			$this->response->setStatus(Response::OK);
			$this->response->addToBody('user',$user);
			$this->response->send();
		}else if($status == 0){
			$this->response->setStatus(Response::NOT_FOUND);
			$this->response->send();
		}else{
			$this->response->setStatus(Response::INTERNAL_SERVER_ERROR);
			$this->response->send();
		}
		
	}//getUserById
	
	
	private function getAllUsers(){
		
		$users = User::getAllUsers();
		
		$this->response->setStatus(Response::OK);
		$this->response->addToBody('users',$users);
		$this->response->send();
		
	}//getAllUsers
	
	
}//UsersController