<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct(){ 
		parent::__construct();
 
		 
    }
 
  function index()
	{
	$this->session->sess_destroy();

  //redirect('login');
		//session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."login'>";
		//echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
	}
    
}
