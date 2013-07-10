<?php

namespace example\controllers;

use gateres\core\Controller;
use gateres\core\Request;
use gateres\core\Response;
use gateres\core\Model;

use example\models\User;



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
		
		if($this->bodyParam('name') && $this->bodyParam('surname')){
			
			$this->createUser();
			
		}else{
			
			$this->response->setStatus(Response::BAD_REQUEST);
			$this->response->send();
			
		}
		
	}//post
	
	
	public function put(){
		
		if($this->pathParam('users')){
			
			$this->updateUser();
			
		}else{
			
			$this->response->setStatus(Response::BAD_REQUEST);
			$this->response->send();
			
		}
		
	}//put
	
	
	public function delete(){
		
		if($this->pathParam('users')){
			
			$this->deleteUser();
			
		}else{
			
			$this->response->setStatus(Response::BAD_REQUEST);
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
	
	
	private function createUser(){
		
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
		
	}//createUser
	
	
	private function updateUser(){
		
		$user = new User();
		$user->id = $this->pathParam('users');
		$user->name = $this->bodyParam('name');
		$user->surname = $this->bodyParam('surname');
		
		$status = $user->update('name','surname');
		
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
		
	}//updateUser
	
	
	private function deleteUser(){
		
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
		
	}//deleteUser
	
	
}//UsersController