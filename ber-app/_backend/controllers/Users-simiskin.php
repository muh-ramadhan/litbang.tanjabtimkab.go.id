<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		if ($leveluser=="admin")
		{ 
		$query = $this->db->query("select count(*) as jml from users");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/users/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexusers('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}
		
			//LOADING VIEW
			$data['vdata']='v_users';
		}
		else {
			$data['vdata']='v_users_level2'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Users";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$data['judulapp']="Tambah Users";
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin")
		{
			/** S:CEK DATA **/ 
			$level = $this->input->post('level');
			$this->form_validation->set_rules('username', 'lang:Username', 'required');
			$this->form_validation->set_rules('password', 'lang:Password', 'required'); 
			$this->form_validation->set_rules('level', 'Level', 'callback_select_validate'); 
			//$this->form_validation->set_rules('email', 'lang:Email', 'required|trim|valid_email'); 
			//$this->form_validation->set_rules('kontak', 'lang:Kontak', 'required');
			/** E:CEK DATA **/
			
			if($this->form_validation->run() == TRUE)
			{
				//$data['vdata']='v_users';
				$a=substr($this->input->post('tanggal'), 6,9);
				$b=substr($this->input->post('tanggal'), 3,2);
				$c=substr($this->input->post('tanggal'), 0,2);
				$tanggal=$a.'-'.$b.'-'.$c;
				 
				$jamsekarang = date("H:i:s");
				
				$pass=md5($this->input->post('password'));
				$idsession=$pass.$this->input->post('username');
				
				$this->M_dataadmin->query_manual("INSERT INTO users (username,
									 password,
									 level,
									 id_instansi,
									 nama_lengkap,
									 email, 
									 kontak,
									 jabatan,
									 jam,
									 keterangan,
									 tanggal,
									 blokir,
									 id_session) 
							   VALUES('".$this->input->post('username')."', 
									'".$pass."',
									'".$this->input->post('level')."',
									'".$this->input->post('instansi')."',
									'".$this->input->post('nama_lengkap')."',
									'".$this->input->post('email')."',
									'".$this->input->post('kontak')."',
									'".$this->input->post('jabatan')."',
									'".$jamsekarang."',
									'".$this->input->post('keterangan')."',
									'".$tanggal."',
									'".$this->input->post('blokir')."',
									'".$idsession."')");   
				 
				$mod=count($this->input->post('modul'));
				$modul=$this->input->post('modul');
				for($i=0;$i<$mod;$i++){
					$this->M_dataadmin->query_manual("INSERT INTO users_modul SET id_session='".$idsession."',id_modul='".$modul[$i]."'");
				} 
				//REDIRECT 
				$this->redirect();
			}
			else {
			$data['vdata']='v_users';
			$data['vnavigasi']='navigasi'; 
			$this->load->view('dashboard',$data);
			}
		}
		else {
			$data['vdata']='access-denied'; 
			$data['judulapp']="Tambah Users";
			$data['vnavigasi']='navigasi'; 
			$this->load->view('dashboard',$data);
		}  
    }
	
	/** VALIDASI KELURAHAN **/
	function select_validate($level)
	{ 
		if($level =='')
		{
			$this->form_validation->set_message('select_validate', '%s harus dipilih');
			return false;
		}
		else // user picked something
		{
			return true;
		}
	}
	
function edit()
    {
		
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin")
		{
			$data['vdata']='v_users'; 
		}
		else if ($leveluser=="user")
		{
			$data['vdata']='v_users2'; 
		}
		else {
			$data['vdata']='access-denied';  
		} 
		$data['judulapp']="Edit Users";	
		$data['judulapp']="Edit Users";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);		
	} 
	
	function a_edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
				$kode=$this->input->post('id');
				$pass=$this->input->post('password'); 
				
				if (empty($pass)) {
					$this->M_dataadmin->query_manual("UPDATE users SET  nama_lengkap  = '".$this->input->post('nama_lengkap')."',
						email = '".$this->input->post('email')."',
						id_instansi = '".$this->input->post('instansi')."',
						kontak = '".$this->input->post('kontak')."',
						alamat = '".$this->input->post('alamat')."',
						jabatan = '".$this->input->post('jabatan')."',
						level = '".$this->input->post('level')."',
						blokir = '".$this->input->post('blokir')."',
						keterangan = '".$this->input->post('keterangan')."'
					WHERE id_session = '".$kode."'");
					//echo "password kosong ".$kode;
				}	
				else {
					$pass=md5($this->input->post('password')); 
					$this->M_dataadmin->query_manual("UPDATE users SET  password  = '".$pass."',
						nama_lengkap  = '".$this->input->post('nama_lengkap')."',
						email = '".$this->input->post('email')."',
						id_instansi = '".$this->input->post('instansi')."',
						kontak = '".$this->input->post('kontak')."',
						alamat = '".$this->input->post('alamat')."',
						jabatan = '".$this->input->post('jabatan')."',
						level = '".$this->input->post('level')."',
						blokir = '".$this->input->post('blokir')."',
						keterangan = '".$this->input->post('keterangan')."'
					WHERE id_session = '".$kode."'");
					//echo "ada password ".$kode;
				}
				//$idsession=$pass.$this->input->post('username');
				$mod=count($this->input->post('modul'));
				$modul=$this->input->post('modul');
				for($i=0;$i<$mod;$i++){
					$this->M_dataadmin->query_manual("INSERT INTO users_modul SET id_session='".$kode."',id_modul='".$modul[$i]."'");
				}
				//REDIRECT 
				$this->redirect();
		}
		else {
			$this->denied();
		} 
    }	
	/*
	function delete()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{  
			$kode=$this->uri->segment(3,0);
			$query = $this->M_dataadmin->editusers($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") { 
				$this->M_dataadmin->query_manual("DELETE FROM users WHERE id_users=".$kode."");  
				//REDIRECT AWAL
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
	*/
	function hapusakses()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin")
		{  
			$kode=$this->uri->segment(3,0);
			$kode2=$this->uri->segment(4,0);
			$query = $this->M_dataadmin->editusers($this->uri->segment(3,0)); 
			$row = $query->row(); 
			
			$this->M_dataadmin->query_manual("DELETE FROM users_modul WHERE id_umod='".$kode."'");  
			//REDIRECT AWAL
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."users/edit/".$kode2."'>";
			 
			
		}
		else {
			$this->denied();
		} 
    }	
	  
	function aktif()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin")
		{
			$kode=$this->uri->segment(3,0); 
			$this->M_dataadmin->query_manual("UPDATE users SET blokir='N' WHERE username='".$kode."'");  
			$this->redirect();  
		}
		else {
			$this->denied();
		} 
    }	
	
	function nonaktif()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin")
		{
			$kode=$this->uri->segment(3,0); 
			$this->M_dataadmin->query_manual("UPDATE users SET blokir='Y' WHERE username='".$kode."'");  
			$this->redirect();  
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
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."users'>";
	}
	
	  
}

