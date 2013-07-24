<?php

namespace oauth2\controllers;

use \Exception;
use gateres\core\Controller;
use gateres\core\Request;
use gateres\core\Response;
use oauth2\models\Grant;

use gateres\core\Model;

use oauth2\models\User;
use oauth2\models\Token;


class TokenController extends Controller{
	
	
	/*http methods*/
	
	private function get(){}//get
	
	public function post(){
		
		if(	isset($this->request->username) && 
			isset($this->request->password) &&
			$this->bodyParam('typeGrant') === Grant::PASSWORD ){
				
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
		
		
		$user = User::getUserByEmailAndPassword($this->request->username, $this->request->password);
        
        $currentTime = time();
        
		$accessToken = new Token();
        $accessToken->id = Token::generateToken($GLOBALS['LEN_TOKEN']);
		$accessToken->idUser = $user->id;
		$accessToken->type = Token::ACCESS;
		$accessToken->creationTime = $currentTime;
        $accessToken->expireTime = $currentTime + $GLOBALS['EXPIRE_IN_ACCESS'];
		$accessTokenDone = $accessToken->create();
		
        $refreshToken = new Token();
        $refreshToken->id = Token::generateToken($GLOBALS['LEN_TOKEN']);
		$refreshToken->idUser = $user->id;
		$refreshToken->type = Token::REFRESH;
		$refreshToken->creationTime = $currentTime;
        $refreshToken->expireTime = $currentTime + $GLOBALS['EXPIRE_IN_REFRESH'];
		$refreshTokenDone = $refreshToken->create();
        
		$this->response->setStatus(Response::CREATED);
		$this->response->addToBody('accessToken',$accessToken);
        $this->response->addToBody('refreshToken',$refreshToken);
		$this->response->send();
		
		
	}//createTokenByPassword
	
	
	private function refreshToken(){
		
		print_r('refreshToken');
		
	}//refreshToken
	
	
}//TokenController