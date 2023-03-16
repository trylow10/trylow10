<?php
function getIp() {
    	$ip = $_SERVER['REMOTE_ADDR'];
    	
 
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        	$ip = $_SERVER['HTTP_CLIENT_IP'];
   		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
 
    	return $ip;
    	
    	
	}//close of getip()

	echo $ip = getIp(); 
?>