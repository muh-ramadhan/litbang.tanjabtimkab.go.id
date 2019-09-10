<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My404 extends CI_Controller {

	function __construct(){  
		parent::__construct();
		$this->load->helper(array('captcha','date','text_helper','permissionadmin')); 
		$this->load->library(array('recaptcha')); 
		$this->load->model('M_dataadmin');
		is_logged_in();  
	}
    
function index()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='error-404';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Sorry, Page Not Found";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 
}
