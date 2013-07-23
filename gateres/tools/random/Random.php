<?php

namespace gateres\tools\random;


class Random{


	public static function getRandomString($length = 8, $possible = "12346789ABCDEFGHIJKLMNPQRSTUVWXYZ"){
		
	  	$password = "";
	
	    $possibleLength = strlen($possible);

		for($i=0;$i<$length;$i++){

			$char = substr($possible, mt_rand(0, $possibleLength-1), 1);
			$password .= $char;

		}

		return $password;
		
	}//getRandomString
	

?>