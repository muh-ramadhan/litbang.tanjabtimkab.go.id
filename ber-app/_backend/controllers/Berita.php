<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from berita");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/berita/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexberita('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}
		
			//LOADING VIEW
			$data['vdata']='v_berita';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Berita";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_berita';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Berita";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editberita($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_berita';
			}
			else {
				$data['vdata']='access-denied'; 
			}
		}
		else {
			$data['vdata']='access-denied'; 
		} 
		$data['judulapp']="Edit Berita";
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
		$this->form_validation->set_rules('judul', 'lang:Judul Berita', 'required');
        $this->form_validation->set_rules('isi_berita', 'lang:Isi Berita', 'required'); 
		
		if($this->form_validation->run() == TRUE)
        { 
		
		}
		else {
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."berita/add'>";
		}
		*/	
		/** E:CEK DATA **/ 
		
			$a=substr($this->input->post('tanggal'), 6,9);
			$b=substr($this->input->post('tanggal'), 3,2);
			$c=substr($this->input->post('tanggal'), 0,2);
			$tanggal=$a.'-'.$b.'-'.$c;
			$pathi=$a.'/'.$b.'/'.$c;
			$seo_judul=seo_link($this->input->post('judul'));
			$hariini=nama_hari($this->input->post('tanggal'));
			$jamsekarang = date("H:i:s");
			
			/* s: property gambar */
			$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../foto_berita/'.$pathi.'/';
			/* e: property gambar */   
			
			$tag_seo=$this->input->post('tag_seo');
			if (!empty($tag_seo)){
				$tag_seo = $this->input->post('tag_seo');
				$tag=implode(',',$tag_seo);
			}
			else {
				$tag="";
			}
			
			if (!empty($lokasi_file)){ 
			if ($tipe_file == "image/jpeg"){
			/* s: property gambar */
			RmkDir($upload_dir, $mode = 0777); 
			UploadFoto($filename,$upload_dir,1000,'imagefile'); 
			/* e: property gambar */  
			$this->M_dataadmin->query_manual("insert into berita (judul,  
											sub_judul,
											id_kategori,
											id_daerah,
											id_subkategori,
											id_subdomain,
											username,
											kutipan,
											youtube,
											judul_seo,
											headline,
											headline_utama,
											aktif,
											utama,
											pilihan,
											text_foto,
											kredit,
											penulis,
											editor,
											sumber,
											hari,
											tanggal,
											tanggal_modif,
											jam,
											gambar,
											dibaca,
											tag,
											isi_berita)
					values('".$this->input->post('judul')."', 
											'".$this->input->post('sub_judul')."',
											'".$this->input->post('kategori')."',
											'".$this->input->post('daerah')."',
											'".$this->input->post('subkategori')."',
											'".$this->input->post('subdomain')."',
											'".$this->session->userdata('id_user')."',
											'".$this->input->post('kutipan')."',
											'".$this->input->post('youtube')."',
											'".$seo_judul."',
											'".$this->input->post('headline')."',
											'".$this->input->post('headline_utama')."',
											'".$this->input->post('aktif')."',
											'".$this->input->post('utama')."',
											'".$this->input->post('pilihan')."',
											'".$this->input->post('text_foto')."',
											'".$this->input->post('kredit')."',
											'".$this->input->post('penulis')."',
											'".$this->input->post('editor')."',
											'".$this->input->post('sumber')."',
											'".$hariini."',
											'".$tanggal."',
											'".$tanggal."',
											'".$jamsekarang."',
											'".$filename."',
											'1',
											'".$tag."',
											'".$this->input->post('isi_berita')."')"); 
			}
			else {
				echo "File Harus Berformat .JPG";
			}
			}
			else {
				$this->M_dataadmin->query_manual("insert into berita (judul,  
											sub_judul,
											id_kategori,
											id_daerah,
											id_subkategori,
											id_subdomain,
											username,
											kutipan,
											youtube,
											judul_seo,
											headline,
											headline_utama,
											aktif,
											utama,
											pilihan,
											text_foto,
											kredit,
											penulis,
											editor,
											sumber,
											hari,
											tanggal,
											tanggal_modif,
											jam, 
											dibaca,
											tag,
											isi_berita)
					values('".$this->input->post('judul')."', 
											'".$this->input->post('sub_judul')."',
											'".$this->input->post('kategori')."',
											'".$this->input->post('daerah')."',
											'".$this->input->post('subkategori')."',
											'".$this->input->post('subdomain')."',
											'".$this->session->userdata('id_user')."',
											'".$this->input->post('kutipan')."',
											'".$this->input->post('youtube')."',
											'".$seo_judul."',
											'".$this->input->post('headline')."',
											'".$this->input->post('headline_utama')."',
											'".$this->input->post('aktif')."',
											'".$this->input->post('utama')."',
											'".$this->input->post('pilihan')."',
											'".$this->input->post('text_foto')."',
											'".$this->input->post('kredit')."',
											'".$this->input->post('penulis')."',
											'".$this->input->post('editor')."',
											'".$this->input->post('sumber')."',
											'".$hariini."',
											'".$tanggal."',
											'".$tanggal."',
											'".$jamsekarang."', 
											'1',
											'".$tag."',
											'".$this->input->post('isi_berita')."')");  
			} 
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."berita'>"; 
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
			$pathi = date('Y/m/d');
			
			$seo_judul=seo_link($this->input->post('judul'));
			$hariini=nama_hari($this->input->post('tanggal'));
			$jamsekarang = date("H:i:s");
			
			/* s: property gambar */
			$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../foto_berita/'.$pathi.'/';
			/* e: property gambar */ 
			
			$tag_seo=$this->input->post('tag_seo');
			if (!empty($tag_seo)){
				$tag_seo = $_POST['tag_seo'];
				$tag=implode(',',$tag_seo);
			}else {
				$tag="";
			}
			 
			if (!empty($lokasi_file)){ 
			if ($tipe_file == "image/jpeg"){
			$tglsekarang=date('Y-m-d');
			$query = $this->db->query('SELECT gambar, tanggal_modif FROM berita WHERE id_berita="'.$kode.'";');
			$row = $query->row();
			if ($row->gambar!=''){
				$pathdelete=str_replace("-","/",$row->tanggal_modif); 
				unlink("../foto_berita/".$pathdelete."/".$row->gambar);
				unlink("../foto_berita/".$pathdelete."/small_".$row->gambar); 
			}
			
			/* s: property gambar */
			RmkDir($upload_dir, $mode = 0777); 
			UploadFoto($filename,$upload_dir,1000,'imagefile'); 
			/* e: property gambar */  
			
			$this->M_dataadmin->query_manual("UPDATE berita SET judul = '".$this->input->post('judul')."',
						id_daerah  = '".$this->input->post('daerah')."',
						sub_judul = '".$this->input->post('sub_judul')."',
						kutipan  = '".$this->input->post('kutipan')."',
						youtube   = '".$this->input->post('youtube')."',
						judul_seo   = '".$seo_judul."',
						id_kategori   = '".$this->input->post('kategori')."',
						id_subkategori   = '".$this->input->post('sub_kategori')."',
						headline    = '".$this->input->post('headline')."',
						headline_utama    = '".$this->input->post('headline_utama')."',
						aktif       = '".$this->input->post('aktif')."',
						pilihan     = '".$this->input->post('pilihan')."',
						utama      = '".$this->input->post('utama')."',
						tag = '".$tag."',
						isi_berita  = '".$this->input->post('isi_berita')."',
						text_foto  = '".$this->input->post('text_foto')."', 
						tanggal = '".$tanggal."',
						tanggal_modif = '".$tglsekarang."',
						kredit  = '".$this->input->post('kredit')."',
						penulis     = '".$this->input->post('penulis')."',
						editor     = '".$this->input->post('editor')."',
						sumber     = '".$this->input->post('sumber')."',
						gambar      = '".$filename."'
				WHERE id_berita   = '".$kode."'"); 
				
			}
			else {
				echo "<script>window.alert('File Harus Berformat .JPG!');
						window.location=('".base_url()."berita/edit/".$this->uri->segment(3,0)."')</script>"; 
			}
			}
			else {
				$this->M_dataadmin->query_manual("UPDATE berita SET judul = '".$this->input->post('judul')."',
						id_daerah  = '".$this->input->post('daerah')."',
						sub_judul = '".$this->input->post('sub_judul')."',
						kutipan  = '".$this->input->post('kutipan')."',
						youtube   = '".$this->input->post('youtube')."',
						judul_seo   = '".$seo_judul."',
						id_kategori   = '".$this->input->post('kategori')."',
						id_subkategori   = '".$this->input->post('sub_kategori')."',
						headline    = '".$this->input->post('headline')."',
						headline_utama    = '".$this->input->post('headline_utama')."',
						aktif       = '".$this->input->post('aktif')."',
						pilihan     = '".$this->input->post('pilihan')."',
						utama      = '".$this->input->post('utama')."',
						tag = '".$tag."',
						tanggal = '".$tanggal."',
						isi_berita  = '".$this->input->post('isi_berita')."',
						text_foto  = '".$this->input->post('text_foto')."',  
						kredit  = '".$this->input->post('kredit')."',
						penulis     = '".$this->input->post('penulis')."',
						editor     = '".$this->input->post('editor')."',
						sumber     = '".$this->input->post('sumber')."'  
				WHERE id_berita   = '".$kode."'"); 
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
			$query = $this->M_dataadmin->editberita($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
			$kode=$this->uri->segment(3,0);
			$query = $this->db->query('SELECT gambar,tanggal_modif FROM berita WHERE id_berita='.$kode.';');
			$row = $query->row(); 
				
			if ($row->gambar!=''){
				$pathi=$row->tanggal_modif;
				$pathdelete=str_replace("-","/",$pathi);
				$this->M_dataadmin->query_manual("DELETE FROM berita WHERE id_berita='".$kode."'"); 
				unlink("../foto_berita/".$pathdelete."/".$row->gambar);
				unlink("../foto_berita/".$pathdelete."/small_".$row->gambar);  
			}
			else{
				$this->M_dataadmin->query_manual("DELETE FROM berita WHERE id_berita=".$kode.""); 
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
						$query = $this->db->query("SELECT gambar,tanggal_modif FROM berita WHERE id_berita='".$cek[$i]."'");
						$row = $query->row();  
						if ($row->gambar!=''){
							$pathi=$row->tanggal_modif;
							$pathdelete=str_replace("-","/",$pathi);
							unlink("../foto_berita/".$pathdelete."/".$row->gambar);
							unlink("../foto_berita/".$pathdelete."/small_".$row->gambar);  
						}
						$this->M_dataadmin->query_manual("DELETE FROM berita WHERE id_berita='".$cek[$i]."'");    
					}  
				}
				else {
					for($i=0;$i<$jumlah;$i++){
					//echo $jumlah." - $cek[$i] - ".$cek[$i]; 
						$query = $this->db->query("SELECT gambar,tanggal_modif FROM berita WHERE username='".$this->session->userdata('id_user')."' and id_berita='".$cek[$i]."'");
						$row = $query->row();  
						$jumlah = $query->num_rows();
						if ($jumlah>0) {
						if ($row->gambar!=''){
							$pathi=$row->tanggal_modif;
							$pathdelete=str_replace("-","/",$pathi);
							unlink("../foto_berita/".$pathdelete."/".$row->gambar);
							unlink("../foto_berita/".$pathdelete."/small_".$row->gambar);  
							}
							$this->M_dataadmin->query_manual("DELETE FROM berita WHERE username='".$this->session->userdata('id_user')."' and id_berita='".$cek[$i]."'"); 
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
				$this->M_dataadmin->query_manual("UPDATE berita SET aktif='Y' WHERE id_berita=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM berita WHERE username='".$this->session->userdata('id_user')."' and id_berita='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE berita SET aktif='Y' WHERE id_berita=".$kode."");
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
				$this->M_dataadmin->query_manual("UPDATE berita SET aktif='N' WHERE id_berita=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM berita WHERE username='".$this->session->userdata('id_user')."' and id_berita='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE berita SET aktif='N' WHERE id_berita=".$kode."");
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
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."berita'>";
	}
	
	  
}

