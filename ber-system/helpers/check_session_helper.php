<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('check_session'))
{
	function check_session()
	{
		//Get Current CI Instance
    $CI = & get_instance();
    //Use $CI instead of $this
    //Check for session details here, here's an example
    $user = $CI->session->userdata('user_id');

    //Get current controller to avoid infinite loop
    $controller = $CI->router->class;

    //Check if user session exists and you are not already on the login page
    if(empty($user) && $controller != "login" ) {
        redirect('login/', 'refresh');
    }
    else {
        return true;
    }
	}
} 
