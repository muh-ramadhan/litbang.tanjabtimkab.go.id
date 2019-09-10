<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){ 
		parent::__construct();
		$this->load->helper(array('captcha','date','text_helper')); 
		$this->load->library(array('recaptcha')); 
		$this->load->model('M_dataadmin'); 
		is_logged_in();
    }

    
function index()
    {
				$data['judulapp']="Administrator";
				$data['vnavigasi']='navigasi';
				$data['vdata']='d-dashboard';
				$this->load->view("dashboard",$data);  
    } 
	
	public function lihatweb() {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."../'>";
	}
    
}
