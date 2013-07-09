<?php

namespace gateres\core;


class Response{
	
	// Informational 1xx
	const _CONTINUE = '100 Continue';
	const SWITCHING_PROTOCOLS = '101 Switching Protocols';
	// Successful 2xx
	const OK = '200 OK';
	const CREATED = '201 Created';
	const ACCEPTED = '202 Accepted';
	const NONAUTHORITATIVE_INFORMATION = '203 Non-Authoritative Information';
	const NO_CONTENT = '204 No Content';
	const RESET_CONTENT = '205 Reset Content';
	const PARTIAL_CONTENT = '206 Partial Content';
	// Redirection 3xx
	const MULTIPLE_CHOICES = '300 Multiple Choices';
	const MOVED_PERMANENTLY = '301 Moved Permanently';
	const FOUND = '302 Found';
	const SEE_OTHER = '303 See Other';
	const NOT_MODIFIED = '304 Not Modified';
	const USE_PROXY = '305 Use Proxy';
	const UNUSED_= '306 [Unused]';
	const TEMPORARY_REDIRECT = '307 Temporary Redirect';
	// Client Error 4xx
	const BAD_REQUEST = '400 Bad Request';
	const UNAUTHORIZED  = '401 Unauthorized';
	const PAYMENT_REQUIRED = '402 Payment Required';
	const FORBIDDEN = '403 Forbidden';
	const NOT_FOUND = '404 Not Found';
	const METHOD_NOT_ALLOWED = '405 Method Not Allowed';
	const NOT_ACCEPTABLE = '406 Not Acceptable';
	const PROXY_AUTHENTICATION_REQUIRED = '407 Proxy Authentication Required';
	const REQUEST_TIMEOUT = '408 Request Timeout';
	const CONFLICT = '409 Conflict';
	const GONE = '410 Gone';
	const LENGTH_REQUIRED = '411 Length Required';
	const PRECONDITION_FAILED = '412 Precondition Failed';
	const REQUEST_ENTITY_TOO_LARGE = '413 Request Entity Too Large';
	const REQUEST_URI_TOO_LONG = '414 Request-URI Too Long';
	const UNSUPPORTED_MEDIA_TYPE = '415 Unsupported Media Type';
	const REQUESTED_RANGE_NOT_SATISFIABLE = '416 Requested Range Not Satisfiable';
	const EXPECTATION_FAILED = '417 Expectation Failed';
	// Server Error 5xx
	const INTERNAL_SERVER_ERROR = '500 Internal Server Error';
	const NOT_IMPLEMENTED = '501 Not Implemented';
	const BAD_GATEWAY = '502 Bad Gateway';
	const SERVICE_UNAVAILABLE = '503 Service Unavailable';
	const GATEWAY_TIMEOUT = '504 Gateway Timeout';
	const VERSION_NOT_SUPPORTED = '505 HTTP Version Not Supported';
	
	
	private $body;
	
	
	function __construct(){
		
		header("Content-type: application/json");
		$this->body=array();
		
	}//__construct
	
	
	public function setStatus($_status){
		
		header("HTTP/1.1 ".$_status);
		
	}//setStatus
	
	
	public function addToBody($_key,$_value){
		
		$this->body[$_key] = $_value;
		
	}//addToBody
	
	
	public function send(){

		echo json_encode($this->body);
		
	}//send
	
	
}//Response