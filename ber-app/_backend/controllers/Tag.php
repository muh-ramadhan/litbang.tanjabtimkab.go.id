<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {

	function __construct(){  
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
		is_logged_in();  
	}
    
function index()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{ 
		$query = $this->db->query("select count(*) as jml from tag");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/tag/index/';
        $config['total_rows'] = $jumlah;
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config); 
		$data['pagination']=$this->pagination->create_links();
		if($this->uri->segment(3) > 0)
			$offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
		else
			$offset = $this->uri->segment(3);
        $data['artikel'] = $this->M_dataadmin->indextag('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}
		
			//LOADING VIEW
			$data['vdata']='v_tag';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Tag Berita";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_tag';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Tag Berita";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->edittag($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_tag';
			}
			else {
				$data['vdata']='access-denied'; 
			}
		}
		else {
			$data['vdata']='access-denied'; 
		} 
		$data['judulapp']="Edit Tag Berita";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
	
function a_simpan()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$jamsekarang = date("H:i:s");
			$tanggal=date('Y-m-d');  
			$seo_judul=seo_link($this->input->post('nama_tag'));
			$this->M_dataadmin->query_manual("insert into tag (nama_tag, 
											tag_seo,
											trending,
											jam,
											aktif,
											tgl_upload,
											tgl_modif,
											username )
					values('".$this->input->post('nama_tag')."', 
											'".$seo_judul."',
											'".$this->input->post('trending')."',
											'".$jamsekarang."' ,
											'".$this->input->post('aktif')."',
											'".$tanggal."',
											'".$tanggal."',
											'".$this->session->userdata('id_user')."' )");  
			 
			$this->redirect();
		}
		else {
			$this->denied();
		} 
    }
	
function a_edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{  
			$tanggal=date('Y-m-d'); 
			$jamsekarang = date("H:i:s");			
			$kode=$this->input->post('id'); 
			$seo_judul=seo_link($this->input->post('nama_tag'));   
			
			$this->M_dataadmin->query_manual("UPDATE tag SET nama_tag = '".$this->input->post('nama_tag')."',
						tag_seo  = '".$seo_judul."', 
						aktif  = '".$this->input->post('aktif')."', 
						jam = '".$jamsekarang."',
						tgl_modif = '".$tanggal."',
						trending = '".$this->input->post('trending')."' 
				WHERE id_tag   = '".$kode."'");  
			$this->redirect();  
		}
		else {
			$this->denied();
		} 
    }	
	
function trending()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$tanggal=date('Y-m-d'); 
		$jamsekarang = date("H:i:s");	
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE tag SET trending='Y',jam = '".$jamsekarang."',
						tgl_modif = '".$tanggal."' WHERE id_tag=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM tag WHERE username='".$this->session->userdata('id_user')."' and id_tag='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE tag SET treding='Y',jam = '".$jamsekarang."',
						tgl_modif = '".$tanggal."' WHERE id_tag=".$kode."");
					$this->redirect();
				}
				else {
					$this->denied();
				}
			} 
		}
		else {
			$this->denied();
		} 
    }	
	
function nontrending()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$tanggal=date('Y-m-d'); 
		$jamsekarang = date("H:i:s");	
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE tag SET trending='N',jam = '".$jamsekarang."',
						tgl_modif = '".$tanggal."' WHERE id_tag=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM tag WHERE username='".$this->session->userdata('id_user')."' and id_tag='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE tag SET trending='N',jam = '".$jamsekarang."',
						tgl_modif = '".$tanggal."' WHERE id_tag=".$kode."");
					$this->redirect();
				}
				else {
					$this->denied();
				}
			} 
		}
		else {
			$this->denied();	 
		} 
    }
	
function aktif()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$tanggal=date('Y-m-d'); 
		$jamsekarang = date("H:i:s");	
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE tag SET aktif='Y',jam = '".$jamsekarang."',
						tgl_modif = '".$tanggal."' WHERE id_tag=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM tag WHERE username='".$this->session->userdata('id_user')."' and id_tag='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE tag SET aktif='Y',jam = '".$jamsekarang."',
						tgl_modif = '".$tanggal."' WHERE id_tag=".$kode."");
					$this->redirect();
				}
				else {
					$this->denied();
				}
			} 
		}
		else {
			$this->denied();
		} 
    }	
	
	function nonaktif()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$tanggal=date('Y-m-d'); 
		$jamsekarang = date("H:i:s");	
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE tag SET aktif='N',jam = '".$jamsekarang."',
						tgl_modif = '".$tanggal."' WHERE id_tag=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM tag WHERE username='".$this->session->userdata('id_user')."' and id_tag='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE tag SET aktiff='N',jam = '".$jamsekarang."',
						tgl_modif = '".$tanggal."' WHERE id_tag=".$kode."");
					$this->redirect();
				}
				else {
					$this->denied();
				}
			} 
		}
		else {
			$this->denied();	 
		} 
    }	
	
	function delete()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{  
		$kode=$this->uri->segment(3,0);
			$query = $this->M_dataadmin->edittag($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") { 
				$this->M_dataadmin->query_manual("DELETE FROM tag WHERE id_tag='".$kode."'"); 
				$this->redirect();
			}
			else {
				$this->denied();
			}  
		}
		else {
			$this->denied();
		}  
    }	 

	public function denied () {
		$data['vdata']='access-denied';  
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);
	}
	
	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."tag'>";
	} 
}

