<?php

use gateres\core\Request;
use gateres\core\Response;
use gateres\core\Router;


if($GLOBALS['SHOW_ERRORS'] == true){
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}


$request = new Request();
$response = new Response();
$router = new Router($request,$response);


function __autoload($class){
	
	$pathGateres = $GLOBALS['GATERES_PATH'].str_replace('\\', '/', $class).'.php';	
	$pathApp = '../'.str_replace('\\', '/', $class).'.php';
	
	if(file_exists($pathGateres)) require_once($pathGateres);
	else if(file_exists($pathApp)) require_once($pathApp);
	
}//__autoload