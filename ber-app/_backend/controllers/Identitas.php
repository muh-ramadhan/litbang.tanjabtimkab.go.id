<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Identitas extends CI_Controller {

	function __construct(){  
		parent::__construct();
		$this->load->helper(array('html','form','url','text',  'captcha','date','text_helper','permissionadmin')); 
		$this->load->library(array('recaptcha', 'form_validation')); 
		$this->load->model('M_dataadmin'); 
		$this->load->library('session');
		$this->load->helper('fungsi_seo');
		$this->load->helper('fungsi_thumb');
		$this->load->helper('fungsi_mkdir');
		$this->load->helper('fungsi_backup');
		is_logged_in();  
	}
    
function index()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_identitas';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Identitas Website";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 
	
	function a_simpan()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{  
			$kode=$this->input->post('id'); 
			
			/* s: property gambar */
			$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../style/images/';
			/* e: property gambar */ 
		 
			
			if (!empty($lokasi_file)){  
			$query = $this->db->query('SELECT logo FROM identitas WHERE id_identitas="'.$kode.'";');
			$row = $query->row(); 
			unlink("../style/images/".$row->logo);  
			RmkDir($upload_dir, $mode = 0777); 
			UploadLogo($filename,$upload_dir,1000,'imagefile');  
			
			$this->M_dataadmin->query_manual("UPDATE identitas SET nama_website = '".$this->input->post('nama_website')."',
						kantor  = '".$this->input->post('kantor')."',
						twiter = '".$this->input->post('twitter')."',
						youtube  = '".$this->input->post('youtube')."', 
						foursquare   = '".$this->input->post('foursquare')."', 
						instagram   = '".$this->input->post('instagram')."',
						googleplus   = '".$this->input->post('googleplus')."',
						email    = '".$this->input->post('email')."',
						alamat    = '".$this->input->post('alamat')."',
						title_bottom       = '".$this->input->post('title_bottom')."',
						copyright     = '".$this->input->post('copyright')."',
						url      = '".$this->input->post('alamat_website')."',
						facebook = '".$this->input->post('facebook')."',
						no_telp  = '".$this->input->post('telpweb')."',
						fax  = '".$this->input->post('fax')."', 
						gmap = '".$this->input->post('gmap')."',
						meta_deskripsi = '".$this->input->post('meta_deskripsi')."',
						meta_keyword  = '".$this->input->post('meta_keyword')."',
						favicon     = '".$this->input->post('favicon')."',
						logo     = '".$filename."' 
				WHERE id_identitas   = '".$kode."'"); 
				
			 
			}
			else {
				$this->M_dataadmin->query_manual("UPDATE identitas SET nama_website = '".$this->input->post('nama_website')."',
						kantor  = '".$this->input->post('kantor')."',
						twiter = '".$this->input->post('twitter')."',
						youtube  = '".$this->input->post('youtube')."', 
						foursquare   = '".$this->input->post('foursquare')."', 
						instagram   = '".$this->input->post('instagram')."',
						googleplus   = '".$this->input->post('googleplus')."',
						email    = '".$this->input->post('email')."',
						alamat    = '".$this->input->post('alamat')."',
						title_bottom       = '".$this->input->post('title_bottom')."',
						copyright     = '".$this->input->post('copyright')."',
						url      = '".$this->input->post('alamat_website')."',
						facebook = '".$this->input->post('facebook')."',
						no_telp  = '".$this->input->post('telpweb')."',
						fax  = '".$this->input->post('fax')."', 
						gmap = '".$this->input->post('gmap')."',
						meta_deskripsi = '".$this->input->post('meta_deskripsi')."',
						meta_keyword  = '".$this->input->post('meta_keyword')."',
						favicon     = '".$this->input->post('favicon')."' 
				WHERE id_identitas   = '".$kode."'"); 
			} 
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."identitas'>"; 
		}
		else {
			$data['vdata']='access-denied';  
			$data['judulapp']="Access Denied";
			$data['vnavigasi']='navigasi'; 
			$this->load->view('dashboard',$data);	 
		} 
    }	
	
}

