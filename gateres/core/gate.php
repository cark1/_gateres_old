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
	
	$path = $GLOBALS['GATERES_PATH'].str_replace('\\', '/', $class).'.php';	
	if(file_exists($path))require_once($path);
	
}//__autoload