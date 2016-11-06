<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('push_session_array')) {
	function push_session_array($name=NULL,$data=NULL){
		$CI =& get_instance();
		if(isset($name) && isset($data)){
			if(is_array($data)){
				if($CI->session->userdata($name)){
				//re new session value
				 foreach($CI->session->userdata($name) as $key1 => $value){
				 	  $session[$key1]=$value;	 
					}
				//over write the new value
				 foreach($data as $key2 => $val){
					  $session[$key2]=$val;
					}
				$CI->session->set_userdata($name,$session);
			  }else{
			  	$CI->session->set_userdata($name,$data);
			  }
			}

		}else{
			return false;
		}

	}
 }
?>