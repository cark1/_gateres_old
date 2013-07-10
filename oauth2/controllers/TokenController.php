<?php

namespace oauth2\controllers;

use \Exception;
use gateres\core\Controller;
use gateres\core\Request;
use gateres\core\Response;
use oauth2\models\Grant;

use gateres\core\Model;


class TokenController extends Controller{
	
	
	/*http methods*/
	
	private function get(){}//get
	
	public function post(){
		
		if(	isset($this->request->username) && 
			isset($this->request->password) &&
			$this->bodyParam('type_grant') === Grant::PASSWORD ){
				
				$this->createTokenByPassword();
				
		}else if(	$this->bodyParam('token') &&
					$this->bodyParam('type_grant') === Grant::REFRESH_TOKEN ){
						
				$this->refreshToken();
						
		}else{
			
			$this->response->setStatus(Response::BAD_REQUEST);
			$this->response->send();
			
		}
		
	}//post
	
	private function put(){}//put
	
	private function delete(){}//delete
	

	/*other methods*/
	
	private function createTokenByPassword(){
		
		/*
		$idUser = User::getIdUserByPassword($this->request->username, $this->request->password);
		$token = new Token();
		$token->expire = 34524;
		$token->tokenType = Token::BEARS;
		$token->accessToken = Token::generateAccessToken($idUser);
		$tokenValue = $token->create();
		
		$this->response->setStatus(Response::CREATED);
		$this->response->addParam('token',$tokenValue);
		$this->response->send();
		*/
		
		print_r('token');
		
	}//createTokenByPassword
	
	
	private function refreshToken(){
		
		print_r('refreshToken');
		
	}//refreshToken
	
	
}//TokenController