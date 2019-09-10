<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produkhukum extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from produkhukum");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/produkhukum/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexprodukhukum('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		} 
			//LOADING VIEW
			$data['vdata']='v_produkhukum';
		}
		else {
			$data['vdata']='access-denied'; 
		}

		$data['judulapp']="Data Peraturan / Produk Hukum";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_produkhukum';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Peraturan / Produk Hukum";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editprodukhukum($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_produkhukum';
			}
			else {
				$data['vdata']='access-denied'; 
			}
		}
		else {
			$data['vdata']='access-denied'; 
		} 
		$data['judulapp']="Edit Peraturan / Produk Hukum";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
	
function a_simpan()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{	
			$a=substr($this->input->post('tanggal'), 6,9);
			$b=substr($this->input->post('tanggal'), 3,2);
			$c=substr($this->input->post('tanggal'), 0,2);
			$tanggal=$a.'-'.$b.'-'.$c;
			$pathi=$a.'/'.$b.'/'.$c; 
			
			$hariini=nama_hari($this->input->post('tanggal'));
			$jamsekarang = date("H:i:s");
			 
			
			$kondisi=$this->input->post('metode');
			
			if ($kondisi=='1'){
			$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../file/'.$pathi.'/'; 
			
			$size= $_FILES['imagefile']['size'];  
			$ukuran_max_file=4000000; // Dalam bytes = 4 MB 
			
				if (!empty($lokasi_file)){ 
					$file_extension = strtolower(substr(strrchr($nama_file,"."),1));
					switch($file_extension){
						case "pdf": $ctype="application/pdf"; break;
						case "exe": $ctype="application/octet-stream"; break;
						case "zip": $ctype="application/zip"; break;
						case "rar": $ctype="application/rar"; break;
						case "doc": $ctype="application/msword"; break;
						case "xls": $ctype="application/vnd.ms-excel"; break;
						case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
						case "gif": $ctype="image/gif"; break;
						case "png": $ctype="image/png"; break;
						case "jpeg":
						case "jpg": $ctype="image/jpg"; break;
						default: $ctype="application/proses";
					}
					
					
					if ($file_extension=='php' || $file_extension=='exe' || $file_extension=='dll' || $file_extension=='ico'){
						echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP / .*EXE');
						window.location=('".base_url()."produkhukum/add')</script>";
					}
					elseif($size > $ukuran_max_file){          
						echo "<script>window.alert('Upload gagal! Ukuran File Anda $size bytes lebih dari $ukuran_max_file bytes, Terlalu Besar! Silahkan dikurangi');
						window.location=('".base_url()."produkhukum/add')</script>";
					}
					else{
					RmkDir($upload_dir, $mode = 0777); 
					UploadLampiran($filename,$upload_dir,'','imagefile'); 
  
					$this->M_dataadmin->query_manual("insert into produkhukum (judul,  
													metode_link,
													keterangan, 
													nama_file,
													link_file,
													tahun,
													id_katprodukhukum,
													aktif,
													tanggal_modif,
													username,
													tgl_upload)
							values('".$this->input->post('judul')."', 
													'".$this->input->post('metode')."',
													'".$this->input->post('keterangan')."',
													'".$filename."',
													'".$this->input->post('link_sub')."',
													'".$this->input->post('tahun')."',
													'".$this->input->post('kategori')."',
													'".$this->input->post('aktif')."',
													'".$tanggal."',
													'".$this->session->userdata('id_user')."',
													'".$tanggal."')");  
						}	
					} 
					elseif (empty($lokasi_file)){
						echo "<script>window.alert('Harus ada File untuk Diupload');
						window.location=('".base_url()."produkhukum/add')</script>";
					} 
			}
			//IF KONDISI LAIN
			else {
				$this->M_dataadmin->query_manual("insert into produkhukum (judul,  
													metode_link,
													keterangan,  
													link_file,
													tahun,
													id_katprodukhukum,
													aktif,
													tanggal_modif,
													username,
													tgl_upload)
							values('".$this->input->post('judul')."', 
													'".$this->input->post('metode')."',
													'".$this->input->post('keterangan')."', 
													'".$this->input->post('link_sub')."',
													'".$this->input->post('tahun')."',
													'".$this->input->post('kategori')."',
													'".$this->input->post('aktif')."',
													'".$tanggal."',
													'".$this->session->userdata('id_user')."',
													'".$tanggal."')"); 
			} 
			//REDIRECT 
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
			$kode=$this->input->post('id');
			$a=substr($this->input->post('tanggal'), 6,9);
			$b=substr($this->input->post('tanggal'), 3,2);
			$c=substr($this->input->post('tanggal'), 0,2);
			$tanggal=$a.'-'.$b.'-'.$c;  
			$pathi=$a.'/'.$b.'/'.$c;
			
			$pathi = date('Y/m/d');
			$jamsekarang = date("H:i:s"); 
			$tglsekarang=date('Y-m-d'); 
			
			$kondisi=$this->input->post('metode');
			
			if ($kondisi=='1'){
				$query = $this->M_dataadmin->editprodukhukum($kode); 
				$row = $query->row();
				if ($row->nama_file!='') {
			$this->M_dataadmin->query_manual("UPDATE produkhukum SET judul = '".$this->input->post('judul')."',
						metode_link = '".$this->input->post('metode')."',
						keterangan = '".$this->input->post('keterangan')."', 
						tahun = '".$this->input->post('tahun')."', 
						id_katprodukhukum= '".$this->input->post('kategori')."', 
						link_file = '".$this->input->post('link_sub')."',
						aktif = '".$this->input->post('aktif')."',
						tanggal_modif = '".$tglsekarang."'
				WHERE id_produkhukum   = '".$kode."'");  
				}
				else {
					$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../file/'.$pathi.'/'; 
			
			$size= $_FILES['imagefile']['size'];  
			$ukuran_max_file=4000000; // Dalam bytes = 4 MB 
			
				if (!empty($lokasi_file)){
					$file_extension = strtolower(substr(strrchr($nama_file,"."),1));
					switch($file_extension){
						case "pdf": $ctype="application/pdf"; break;
						case "exe": $ctype="application/octet-stream"; break;
						case "zip": $ctype="application/zip"; break;
						case "rar": $ctype="application/rar"; break;
						case "doc": $ctype="application/msword"; break;
						case "xls": $ctype="application/vnd.ms-excel"; break;
						case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
						case "gif": $ctype="image/gif"; break;
						case "png": $ctype="image/png"; break;
						case "jpeg":
						case "jpg": $ctype="image/jpg"; break;
						default: $ctype="application/proses";
					}
					
					
					if ($file_extension=='php' || $file_extension=='exe' || $file_extension=='dll' || $file_extension=='ico'){
						echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP / .*EXE');
						window.location=('".base_url()."produkhukum/edit/".$kode."')</script>";
					}
					elseif($size > $ukuran_max_file){          
						echo "<script>window.alert('Upload gagal! Ukuran File Anda $size bytes lebih dari $ukuran_max_file bytes, Terlalu Besar! Silahkan dikurangi');
						window.location=('".base_url()."produkhukum/edit/".$kode."')</script>";
					}
					else{ 
					$query = $this->db->query('SELECT nama_file, tanggal_modif FROM produkhukum WHERE id_produkhukum="'.$kode.'";');
					$row = $query->row();
					if ($row->nama_file!=''){
						$pathdelete=str_replace("-","/",$row->tanggal_modif); 
						unlink("../file/".$pathdelete."/".$row->nama_file); 
					}
					
					RmkDir($upload_dir, $mode = 0777); 
					UploadLampiran($filename,$upload_dir,'','imagefile'); 
					
					$this->M_dataadmin->query_manual("UPDATE produkhukum SET judul = '".$this->input->post('judul')."',
						metode_link = '".$this->input->post('metode')."',
						keterangan = '".$this->input->post('keterangan')."', 
						tahun = '".$this->input->post('tahun')."', 
						id_katprodukhukum= '".$this->input->post('kategori')."', 
						nama_file = '".$filename."',
						link_file = '".$this->input->post('link_sub')."',
						aktif = '".$this->input->post('aktif')."',
						tanggal_modif = '".$tglsekarang."'
				WHERE id_produkhukum   = '".$kode."'");  
						}	
					}
					 
					elseif (empty($lokasi_file)){
						echo "<script>window.alert('Harus ada File untuk Diupload');
						window.location=('".base_url()."produkhukum/edit/".$kode."')</script>";
					} 
					  
				}
			
			
			
			}
			//IF KONDISI LAIN
			else {
				$this->M_dataadmin->query_manual("UPDATE produkhukum SET judul = '".$this->input->post('judul')."',
						metode_link = '".$this->input->post('metode')."',
						keterangan = '".$this->input->post('keterangan')."', 
						tahun = '".$this->input->post('tahun')."', 
						id_katprodukhukum= '".$this->input->post('kategori')."', 
						link_file = '".$this->input->post('link_sub')."',
						aktif = '".$this->input->post('aktif')."',
						tanggal_modif = '".$tglsekarang."'
				WHERE id_produkhukum   = '".$kode."'");  
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
			$query = $this->M_dataadmin->editprodukhukum($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
			$kode = $this->uri->segment(3,0);
			$query = $this->db->query('SELECT nama_file,tanggal_modif FROM produkhukum WHERE id_produkhukum='.$kode.';');
			$row = $query->row();  
			if ($row->nama_file!=''){ 
				$pathdelete=str_replace("-","/",$row->tanggal_modif);
				unlink("../file/".$pathdelete."/".$row->nama_file); 
				$this->M_dataadmin->query_manual("DELETE FROM produkhukum WHERE id_produkhukum='".$kode."'"); 
			}
			else{
				$this->M_dataadmin->query_manual("DELETE FROM produkhukum WHERE id_produkhukum=".$kode.""); 
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
						$query = $this->db->query("SELECT nama_file,tanggal_modif FROM produkhukum WHERE id_produkhukum='".$cek[$i]."'");
						$row = $query->row();  
						if ($row->nama_file!=''){ 
							$pathdelete=str_replace("-","/",$row->tanggal_modif);
							unlink("../file/".$pathdelete."/".$row->nama_file); 
						}
						$this->M_dataadmin->query_manual("DELETE FROM produkhukum WHERE id_produkhukum='".$cek[$i]."'");    
					}  
				}
				else {
					for($i=0;$i<$jumlah;$i++){
					//echo $jumlah." - $cek[$i] - ".$cek[$i]; 
						$query = $this->db->query("SELECT nama_file,tanggal_modif FROM produkhukum WHERE username='".$this->session->userdata('id_user')."' and id_produkhukum='".$cek[$i]."'");
						$row = $query->row();  
						$jumlah = $query->num_rows();
						if ($jumlah>0) {
						if ($row->nama_file!=''){ 
							$pathdelete=str_replace("-","/",$row->tanggal_modif);
							unlink("../file/".$pathdelete."/".$row->nama_file); 
							}
							$this->M_dataadmin->query_manual("DELETE FROM produkhukum WHERE username='".$this->session->userdata('id_user')."' and id_produkhukum='".$cek[$i]."'"); 
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
	
	function hapuslink()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE produkhukum SET link_file='' WHERE id_produkhukum=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM produkhukum WHERE username='".$this->session->userdata('id_user')."' and id_produkhukum='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE produkhukum SET link_file='' WHERE id_produkhukum=".$kode."");
					//$this->redirect();
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."produkhukum/edit/".$kode."'>";
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

	function hapusfile()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") {
				$query = $this->db->query("SELECT nama_file,tanggal_modif FROM produkhukum WHERE username='".$this->session->userdata('id_user')."' and id_produkhukum='".$kode."'");
				$row = $query->row(); 
				$pathdelete=str_replace("-","/",$row->tanggal_modif);
				unlink("../file/".$pathdelete."/".$row->nama_file); 
				$this->M_dataadmin->query_manual("UPDATE produkhukum SET nama_file='' WHERE id_produkhukum=".$kode."");  
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."produkhukum/edit/".$kode."'>";
			}
			else {
				$query = $this->db->query("SELECT nama_file,tanggal_modif FROM produkhukum WHERE username='".$this->session->userdata('id_user')."' and id_produkhukum='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$query = $this->db->query("SELECT nama_file,tanggal_modif FROM produkhukum WHERE username='".$this->session->userdata('id_user')."' and id_produkhukum='".$kode."'");
					$row = $query->row(); 
					$pathdelete=str_replace("-","/",$row->tanggal_modif);
					unlink("../file/".$pathdelete."/".$row->nama_file); 
					$this->M_dataadmin->query_manual("UPDATE produkhukum SET nama_file='' WHERE id_produkhukum=".$kode."");
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."produkhukum/edit/".$kode."'>";
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
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE produkhukum SET aktif='Y' WHERE id_produkhukum=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM produkhukum WHERE username='".$this->session->userdata('id_user')."' and id_produkhukum='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE produkhukum SET aktif='Y' WHERE id_produkhukum=".$kode."");
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
				$this->M_dataadmin->query_manual("UPDATE produkhukum SET aktif='N' WHERE id_produkhukum=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM produkhukum WHERE username='".$this->session->userdata('id_user')."' and id_produkhukum='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE produkhukum SET aktif='N' WHERE id_produkhukum=".$kode."");
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
	 
	public function inputfile () { 
	?>
		<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
			<div class="form-group">
			<label>Upload File</label>  <input type="file" name="imagefile"> 
			</div>
		</div>
	<?php
	}
	
	public function custom () {  
	?>
		<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
			<div class="form-group">
			<label>Link Download</label> 
			<input  class="form-control" type="text" name="link_sub" value="">
			</div>
		</div>
	<?php	 
	}
	
	public function denied () {
		$data['vdata']='access-denied';  
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);
	}
	
	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."produkhukum'>";
	}
	
	  
}

