<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weblink extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from weblink");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/weblink/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexweblink('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}
		
			//LOADING VIEW
			$data['vdata']='v_weblink';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		 
		$data['judulapp']="Data Image Slide";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_weblink';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Image Slide";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editweblink($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_weblink';
			}
			else {
				$data['vdata']='access-denied'; 
			}
		}
		else {
			$data['vdata']='access-denied'; 
		} 
		$data['judulapp']="Edit Image Slide";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
	
	function a_simpan()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			
		/** S:CEK DATA **/  
		/*
		$this->form_validation->set_rules('judul', 'lang:Judul Image Slide', 'required');
        $this->form_validation->set_rules('isi_weblink', 'lang:Isi Image Slide', 'required'); 
		
		if($this->form_validation->run() == TRUE)
        { 
		
		}
		else {
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."weblink/add'>";
		}
		*/	
		/** E:CEK DATA **/ 
		
			$a=substr($this->input->post('tanggal'), 6,9);
			$b=substr($this->input->post('tanggal'), 3,2);
			$c=substr($this->input->post('tanggal'), 0,2);
			$tanggal=$a.'-'.$b.'-'.$c;
			$pathi=$a.'/'.$b.'/'.$c; 
			$jamsekarang = date("H:i:s");
			$tglsekarang=date('Y-m-d');
			/* s: property gambar */
			$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../foto_weblink/'.$pathi.'/';
			/* e: property gambar */    
			
			if (!empty($lokasi_file)){ 
			if ($tipe_file == "image/jpeg"){
			/* s: property gambar */
			RmkDir($upload_dir, $mode = 0777); 
			UploadFoto($filename,$upload_dir,1400,'imagefile'); 
			/* e: property gambar */  
			$this->M_dataadmin->query_manual("insert into weblink (nama_weblink, 
								link,
								keterangan,
								aktif,
								tgl_upload,
								tgl_modif,
								username,
                                gambar)
					values('".$this->input->post('nama')."', 
								'".$this->input->post('link')."',
								'".$this->input->post('keterangan')."', 
								'".$this->input->post('aktif')."', 
								'".$tglsekarang."', 
								'".$tglsekarang."', 
								'".$this->session->userdata('id_user')."',
								'".$filename."')"); 
			}
			else {
				echo "File Harus Berformat .JPG";
			}
			}
			else {
			$this->M_dataadmin->query_manual("insert into weblink (nama_weblink, 
								link,
								keterangan,
								aktif,
								tgl_upload, 
								tgl_modif,
								username)
					values('".$this->input->post('nama')."', 
								'".$this->input->post('link')."',
								'".$this->input->post('keterangan')."', 
								'".$this->input->post('aktif')."', 
								'".$tglsekarang."', 
								'".$tglsekarang."', 
								'".$this->session->userdata('id_user')."')"); 
			} 
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."weblink'>"; 
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
			$kode=$this->input->post('id');
			$a=substr($this->input->post('tanggal'), 6,9);
			$b=substr($this->input->post('tanggal'), 3,2);
			$c=substr($this->input->post('tanggal'), 0,2);
			$tanggal=$a.'-'.$b.'-'.$c;  
			$pathi=date('Y-m-d');
			
			/* s: property gambar */
			$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../foto_weblink/'.$pathi.'/';
			/* e: property gambar */ 

			if (!empty($lokasi_file)){ 
			if ($tipe_file == "image/jpeg"){
			$tglsekarang=date('Y-m-d');
			$query = $this->db->query('SELECT gambar, tgl_modif FROM weblink WHERE id_weblink="'.$kode.'";');
			$row = $query->row();
			if ($row->gambar!=''){
				$pathdelete=str_replace("-","/",$row->tgl_modif); 
				unlink("../foto_weblink/".$pathdelete."/".$row->gambar);
				unlink("../foto_weblink/".$pathdelete."/small_".$row->gambar); 
			}
			
			/* s: property gambar */
			RmkDir($upload_dir, $mode = 0777); 
			UploadFoto($filename,$upload_dir,1400,'imagefile'); 
			/* e: property gambar */  
			
			$this->M_dataadmin->query_manual("UPDATE weblink SET nama_weblink = '".$this->input->post('nama')."', 
						aktif = '".$this->input->post('aktif')."',
						link = '".$this->input->post('link')."',
						keterangan = '".$this->input->post('keterangan')."', 
						tgl_modif = '".$tglsekarang."', 
						gambar = '".$filename."'
			WHERE id_weblink = '".$kode."'"); 
				
			}
			else {
				echo "<script>window.alert('File Harus Berformat .JPG!');
						window.location=('".base_url()."weblink/edit/".$this->uri->segment(3,0)."')</script>"; 
			}
			}
			else {
			$this->M_dataadmin->query_manual("UPDATE weblink SET nama_weblink = '".$this->input->post('nama')."', 
						aktif = '".$this->input->post('aktif')."',
						link = '".$this->input->post('link')."',
						keterangan = '".$this->input->post('keterangan')."' 
			WHERE id_weblink = '".$kode."'"); 
			} 
			$this->redirect();
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
			$query = $this->M_dataadmin->editweblink($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
			$kode=$this->uri->segment(3,0);
			$query = $this->db->query('SELECT gambar,tgl_modif FROM weblink WHERE id_weblink='.$kode.';');
			$row = $query->row(); 
				
			if ($row->gambar!=''){
				$pathi=$row->tgl_modif;
				$pathdelete=str_replace("-","/",$pathi);
				$this->M_dataadmin->query_manual("DELETE FROM weblink WHERE id_weblink='".$kode."'"); 
				unlink("../foto_weblink/".$pathdelete."/".$row->gambar);
				unlink("../foto_weblink/".$pathdelete."/small_".$row->gambar);  
			}
			else{
				$this->M_dataadmin->query_manual("DELETE FROM weblink WHERE id_weblink=".$kode.""); 
			}
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
	
	function deleteall()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{   
		 
				$cek = $this->input->post('cek');  
				$jumlah = count($cek);
				if(!empty($cek)){ 
				if ($leveluser=="admin") {
					for($i=0;$i<$jumlah;$i++){
					//echo $jumlah." - $cek[$i] - ".$cek[$i]; 
						$query = $this->db->query("SELECT gambar,tgl_modif FROM weblink WHERE id_weblink='".$cek[$i]."'");
						$row = $query->row();  
						if ($row->gambar!=''){
							$pathi=$row->tgl_modif;
							$pathdelete=str_replace("-","/",$pathi);
							unlink("../foto_weblink/".$pathdelete."/".$row->gambar);
							unlink("../foto_weblink/".$pathdelete."/small_".$row->gambar);  
						}
						$this->M_dataadmin->query_manual("DELETE FROM weblink WHERE id_weblink='".$cek[$i]."'");    
					}  
				}
				else {
					for($i=0;$i<$jumlah;$i++){
					//echo $jumlah." - $cek[$i] - ".$cek[$i]; 
						$query = $this->db->query("SELECT gambar,tgl_modif FROM weblink WHERE username='".$this->session->userdata('id_user')."' and id_weblink='".$cek[$i]."'");
						$row = $query->row();  
						$jumlah = $query->num_rows();
						if ($jumlah>0) {
						if ($row->gambar!=''){
							$pathi=$row->tgl_modif;
							$pathdelete=str_replace("-","/",$pathi);
							unlink("../foto_weblink/".$pathdelete."/".$row->gambar);
							unlink("../foto_weblink/".$pathdelete."/small_".$row->gambar);  
							}
							$this->M_dataadmin->query_manual("DELETE FROM weblink WHERE username='".$this->session->userdata('id_user')."' and id_weblink='".$cek[$i]."'"); 
						}
					} 
				} 
				}
				//REDIRECT AWAL
				$this->redirect();
			
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
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE weblink SET aktif='Y' WHERE id_weblink=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM weblink WHERE username='".$this->session->userdata('id_user')."' and id_weblink='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE weblink SET aktif='Y' WHERE id_weblink=".$kode."");
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
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE weblink SET aktif='N' WHERE id_weblink=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM weblink WHERE username='".$this->session->userdata('id_user')."' and id_weblink='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE weblink SET aktif='N' WHERE id_weblink=".$kode."");
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

	public function denied () {
		$data['vdata']='access-denied';  
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);
	}
	
	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."weblink'>";
	}
	
	  
}

