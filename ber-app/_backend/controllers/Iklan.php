<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iklan extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from iklan");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/iklan/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexiklan('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}
		
			//LOADING VIEW
			$data['vdata']='v_iklan';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Iklan";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_iklan';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Iklan";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editiklan($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_iklan';
			}
			else {
				$data['vdata']='access-denied'; 
			}
		}
		else {
			$data['vdata']='access-denied'; 
		} 
		$data['judulapp']="Edit Iklan";
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
			$tanggalmulai = substr($this->input->post('tanggal1'), 6,9).'-'.substr($this->input->post('tanggal1'), 3,2).'-'.substr($this->input->post('tanggal1'), 0,2);
			$tanggalakhir = substr($this->input->post('tanggal2'), 6,9).'-'.substr($this->input->post('tanggal2'), 3,2).'-'.substr($this->input->post('tanggal2'), 0,2);
			$pathi=$a.'/'.$b.'/'.$c;
			//$seo_judul=seo_link($this->input->post('judul'));
			
			$hariini=nama_hari($this->input->post('tanggal'));
			$jamsekarang = date("H:i:s");
			
			/* s: property gambar */
			$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../materi_iklan/'.$pathi.'/';
			/* e: property gambar */   
			 
			 
			if (!empty($lokasi_file)){ 
			if ($tipe_file == "image/jpeg"){ 
			RmkDir($upload_dir, $mode = 0777); 
			UploadFoto($filename,$upload_dir,1200,'imagefile'); 
			
			$this->M_dataadmin->query_manual("insert into iklan (nama_iklan,  
											id_mode,
											mobile,
											urutan_mobile,
											id_halamaniklan,
											id_posisiiklan,
											urutan,
											link,
											gambar,
											aktif,
											keterangan,
											tgl_posting,
											jam,
											tanggal_modif,
											tgl_mulai,
											tgl_akhir,
											username)
					values('".$this->input->post('judul')."', 
											'".$this->input->post('mode')."',
											'".$this->input->post('mobile')."',
											'".$this->input->post('urutan_mobile')."',
											'".$this->input->post('halaman')."',
											'".$this->input->post('posisi')."',
											'".$this->input->post('urutan')."',
											'".$this->input->post('link')."',
											'".$filename."',
											'".$this->input->post('aktif')."',
											'".$this->input->post('keterangan')."',
											'".$tanggal."',
											'".$jamsekarang."',
											'".$tanggal."',
											'".$tanggalmulai."',
											'".$tanggalakhir."',
											'".$this->session->userdata('id_user')."')"); 
			}
			else {
				echo "File Harus Berformat .JPG";
			}
			}
			else {
				$this->M_dataadmin->query_manual("insert into iklan (nama_iklan,  
											id_mode,
											mobile,
											urutan_mobile,
											id_halamaniklan,
											id_posisiiklan,
											urutan,
											link, 
											aktif,
											keterangan,
											tgl_posting,
											jam,
											tanggal_modif,
											tgl_mulai,
											tgl_akhir,
											username)
					values('".$this->input->post('judul')."', 
											'".$this->input->post('mode')."',
											'".$this->input->post('mobile')."',
											'".$this->input->post('urutan_mobile')."',
											'".$this->input->post('halaman')."',
											'".$this->input->post('posisi')."',
											'".$this->input->post('urutan')."',
											'".$this->input->post('link')."', 
											'".$this->input->post('aktif')."',
											'".$this->input->post('keterangan')."',
											'".$tanggal."',
											'".$jamsekarang."',
											'".$tanggal."',
											'".$tanggalmulai."',
											'".$tanggalakhir."',
											'".$this->session->userdata('id_user')."')");
			} 
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
			$tanggalmulai = substr($this->input->post('tanggal1'), 6,9).'-'.substr($this->input->post('tanggal1'), 3,2).'-'.substr($this->input->post('tanggal1'), 0,2);
			$tanggalakhir = substr($this->input->post('tanggal2'), 6,9).'-'.substr($this->input->post('tanggal2'), 3,2).'-'.substr($this->input->post('tanggal2'), 0,2);
			$pathi=$a.'/'.$b.'/'.$c;
			
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
			$upload_dir = '../materi_iklan/'.$pathi.'/';
			/* e: property gambar */ 
			
			 
			if (!empty($lokasi_file)){ 
			if ($tipe_file == "image/jpeg"){
			$query = $this->db->query('SELECT gambar, tanggal_modif FROM iklan WHERE id_iklan="'.$kode.'";');
			$row = $query->row();
			//$gambar=$row->gambar; 
			$pathdelete=str_replace("-","/",$row->tanggal_modif);
			$tglsekarang=date('Y-m-d'); 
			
			unlink("../materi_iklan/".$pathdelete."/".$row->gambar);
			unlink("../materi_iklan/".$pathdelete."/small_".$row->gambar); 
			
			/* s: property gambar */
			RmkDir($upload_dir, $mode = 0777); 
			UploadFoto($filename,$upload_dir,1000,'imagefile'); 
			/* e: property gambar */  
			
			$this->M_dataadmin->query_manual("UPDATE iklan SET nama_iklan = '".$this->input->post('judul')."',
						id_mode = '".$this->input->post('mode')."',
						mobile = '".$this->input->post('mobile')."',
						urutan_mobile = '".$this->input->post('urutan_mobile')."',
						id_halamaniklan = '".$this->input->post('halaman')."',
						id_posisiiklan = '".$this->input->post('posisi')."',
						urutan = '".$this->input->post('urutan')."',
						link = '".$this->input->post('link')."',
						gambar = '".$filename."',
						aktif = '".$this->input->post('aktif')."',
						keterangan = '".$this->input->post('keterangan')."',
						tanggal_modif     = '".$tglsekarang."',
						tgl_mulai = '".$tanggalmulai."',
						tgl_akhir = '".$tanggalakhir."'
				WHERE id_iklan   = '".$kode."'"); 
				
			}
			else { 
				echo "File Harus Berformat .JPG";
			}
			}
			else {
				$this->M_dataadmin->query_manual("UPDATE iklan SET nama_iklan = '".$this->input->post('judul')."',
						id_mode = '".$this->input->post('mode')."',
						mobile = '".$this->input->post('mobile')."',
						urutan_mobile = '".$this->input->post('urutan_mobile')."',
						id_halamaniklan = '".$this->input->post('halaman')."',
						id_posisiiklan = '".$this->input->post('posisi')."',
						urutan = '".$this->input->post('urutan')."',
						link = '".$this->input->post('link')."', 
						aktif = '".$this->input->post('aktif')."',
						keterangan = '".$this->input->post('keterangan')."', 
						tgl_mulai = '".$tanggalmulai."',
						tgl_akhir = '".$tanggalakhir."'
				WHERE id_iklan   = '".$kode."'"); 
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
			$query = $this->M_dataadmin->editiklan($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
			$kode=$this->uri->segment(3,0);
			$query = $this->db->query('SELECT gambar,tanggal_modif FROM iklan WHERE id_iklan='.$kode.';');
			$row = $query->row(); 
				
			if ($row->gambar!=''){
				$pathi=$row->tanggal_modif;
				$pathdelete=str_replace("-","/",$pathi);
				unlink("../materi_iklan/".$pathdelete."/".$row->gambar);
				unlink("../materi_iklan/".$pathdelete."/small_".$row->gambar);  
				$this->M_dataadmin->query_manual("DELETE FROM iklan WHERE id_iklan='".$kode."'"); 
			}
			else{
				$this->M_dataadmin->query_manual("DELETE FROM iklan WHERE id_iklan=".$kode.""); 
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
						$query = $this->db->query("SELECT gambar,tanggal_modif FROM iklan WHERE id_iklan='".$cek[$i]."'");
						$row = $query->row();  
						if ($row->gambar!=''){
							$pathi=$row->tanggal_modif;
							$pathdelete=str_replace("-","/",$pathi);
							unlink("../materi_iklan/".$pathdelete."/".$row->gambar);
							unlink("../materi_iklan/".$pathdelete."/small_".$row->gambar);  
						}
						$this->M_dataadmin->query_manual("DELETE FROM iklan WHERE id_iklan='".$cek[$i]."'");    
					}  
				}
				else {
					for($i=0;$i<$jumlah;$i++){
					//echo $jumlah." - $cek[$i] - ".$cek[$i]; 
						$query = $this->db->query("SELECT gambar,tanggal_modif FROM iklan WHERE username='".$this->session->userdata('id_user')."' and id_iklan='".$cek[$i]."'");
						$row = $query->row();  
						$jumlah = $query->num_rows();
						if ($jumlah>0) {
						if ($row->gambar!=''){
							$pathi=$row->tanggal_modif;
							$pathdelete=str_replace("-","/",$pathi);
							unlink("../materi_iklan/".$pathdelete."/".$row->gambar);
							unlink("../materi_iklan/".$pathdelete."/small_".$row->gambar);  
							}
							$this->M_dataadmin->query_manual("DELETE FROM iklan WHERE username='".$this->session->userdata('id_user')."' and id_iklan='".$cek[$i]."'"); 
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
				$this->M_dataadmin->query_manual("UPDATE iklan SET aktif='Y' WHERE id_iklan=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM iklan WHERE username='".$this->session->userdata('id_user')."' and id_iklan='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE iklan SET aktif='Y' WHERE id_iklan=".$kode."");
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
				$this->M_dataadmin->query_manual("UPDATE iklan SET aktif='N' WHERE id_iklan=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM iklan WHERE username='".$this->session->userdata('id_user')."' and id_iklan='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE iklan SET aktif='N' WHERE id_iklan=".$kode."");
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
	
	function mobile()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE iklan SET mobile='Y' WHERE id_iklan=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM iklan WHERE username='".$this->session->userdata('id_user')."' and id_iklan='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE iklan SET mobile='Y' WHERE id_iklan=".$kode."");
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
	
	function nonmobile()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE iklan SET mobile='N' WHERE id_iklan=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM iklan WHERE username='".$this->session->userdata('id_user')."' and id_iklan='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE iklan SET mobile='N' WHERE id_iklan=".$kode."");
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

	public function halamaniklan () {  
		$prop = $this->input->post('halaman');
		if ($prop==1) {
		?>
		<iframe name="iframe" width="90%" height="500" frameborder="0" scrolling="YES" src="<?php echo base_url()?>../materi_iklan/halaman-home.jpg" marginwidth="0" style="margin-left:15px;border:1px solid #ccc;"> 
		</iframe> 
		<?php
		} 
		elseif ($prop==2) {
		?>
		<iframe name="iframe" width="90%" height="500" frameborder="0" scrolling="YES" src="<?php echo base_url()?>../materi_iklan/halaman-kategori.jpg" marginwidth="0" style="margin-left:15px;border:1px solid #ccc;"> 
		</iframe> 
		<?php	
		}
		elseif ($prop==3) {
		?>
		<iframe name="iframe" width="90%" height="500" frameborder="0" scrolling="YES" src="<?php echo base_url()?>../materi_iklan/halaman-detail.jpg" marginwidth="0" style="margin-left:15px;border:1px solid #ccc;"> 
		</iframe> 
		<?php	
		}   
	}
	
	public function posisiiklan () {  
		$prop = $this->input->post('halaman');
		$dataa = $this->db->query("select * from posisiiklan where id_halamaniklan=".$prop." order by id_posisiiklan asc");
		foreach($dataa->result_array() as $raw) {
		?>
			<option  value="<?php echo $raw['id_posisiiklan'];?>"><?php echo $raw['nama_posisiiklan'];?></option>
		<?php
		} 
	}
	
	public function denied () {
		$data['vdata']='access-denied';  
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);
	}
	
	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."iklan'>";
	}
	
	  
}

