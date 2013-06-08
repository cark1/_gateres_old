<?php

use gateres\core\Request;
use gateres\core\Response;
use gateres\core\Router;


$request = new Request();
$response = new Response();

$router = new Router($request,$response);



function __autoload($class){
	
	$pathPrivate = "../project_private/";
	
	$path = $pathPrivate.str_replace('\\', '/', $class).'.php';
	if(file_exists($path)) require_once($path);

}//__autoload