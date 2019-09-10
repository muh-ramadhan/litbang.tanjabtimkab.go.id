<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fil3manag3r extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('html','form','url','text',  'captcha','date','text_helper','permissionadmin')); 
		$this->load->library(array('recaptcha', 'form_validation'));
		$this->load->library('pagination'); 
		$this->load->model('M_dataadmin'); 
		$this->load->library('session'); 
		$this->load->helper('tgl_indonesia'); 
		$this->load->helper('combo');
		//$this->load->library("security"); 
		$this->load->helper('fungsi_seo');
		$this->load->helper('fungsi_thumb');
		$this->load->helper('fungsi_mkdir');
		$this->load->helper('fungsi_backup');
		is_logged_in(); 
	}
	
	public function index()
	{ 
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['judulapp']="File Manager";
			$data['vnavigasi']='navigasi';
			$data['vdata']='d-dashboard';
			$this->load->view('d-fm',$data);
		}
		else {
			$data['vdata']='access-denied'; 
		}
		 
	}
	 
}
