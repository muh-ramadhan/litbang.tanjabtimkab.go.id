<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from menu");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/menu/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexmenu('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}
		
			//LOADING VIEW
			$data['vdata']='v_menu';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Menu Front-End";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_menu';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Menu Front-End";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editmenu($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_menu';
			}
			else {
				$data['vdata']='access-denied'; 
			}
		}
		else {
			$data['vdata']='access-denied'; 
		} 
		$data['judulapp']="Edit Menu Front-End";
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
						window.location=('".base_url()."menu/add')</script>";
					}
					elseif($size > $ukuran_max_file){          
						echo "<script>window.alert('Upload gagal! Ukuran File Anda $size bytes lebih dari $ukuran_max_file bytes, Terlalu Besar! Silahkan dikurangi');
						window.location=('".base_url()."menu/add')</script>";
					}
					else{
					RmkDir($upload_dir, $mode = 0777); 
					UploadLampiran($filename,$upload_dir,'','imagefile'); 
  
					$this->M_dataadmin->query_manual("insert into menu (judul,  
													metode_link,
													keterangan, 
													nama_file,
													link_file,
													aktif,
													tanggal_modif,
													username,
													tgl_posting)
							values('".$this->input->post('judul')."', 
													'".$this->input->post('metode')."',
													'".$this->input->post('keterangan')."',
													'".$filename."',
													'".$this->input->post('link_sub')."',
													'".$this->input->post('aktif')."',
													'".$tanggal."',
													'".$this->session->userdata('id_user')."',
													'".$tanggal."')");  
						}	
					} 
					elseif (empty($lokasi_file)){
						echo "<script>window.alert('Harus ada File untuk Diupload');
						window.location=('".base_url()."menu/add')</script>";
					} 
			}
			//IF KONDISI LAIN
			else {
				$this->M_dataadmin->query_manual("insert into menu (judul,  
													metode_link,
													keterangan,  
													link_file,
													aktif,
													tanggal_modif,
													username,
													tgl_posting)
							values('".$this->input->post('judul')."', 
													'".$this->input->post('metode')."',
													'".$this->input->post('keterangan')."', 
													'".$this->input->post('link_sub')."',
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
			$seo_judul=seo_link($this->input->post('nama_kategori'));   
			
			$this->M_dataadmin->query_manual("UPDATE kategori SET nama_kategori = '".$this->input->post('nama_kategori')."',
						kategori_seo  = '".$seo_judul."', 
						aktif = '".$this->input->post('aktif')."' 
				WHERE id_kategori   = '".$kode."'");  
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
			$kode=$this->uri->segment(3,0);
			$query = $this->M_dataadmin->editmenu($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") { 
				$this->M_dataadmin->query_manual("DELETE FROM menu WHERE id_menu=".$kode."");  
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
				if(empty($this->input->post('cek'))){
					//noneaction
				}
				else {
				if ($leveluser=="admin") {
					for($i=0;$i<$jumlah;$i++){ 	
						$query = $this->db->query("SELECT nama_file,tanggal_modif FROM menu WHERE id_menu='".$cek[$i]."'");
						$row = $query->row();  
						if ($row->nama_file!=''){ 
							$pathdelete=str_replace("-","/",$row->tanggal_modif);
							unlink("../file/".$pathdelete."/".$row->nama_file); 
						}
						$this->M_dataadmin->query_manual("DELETE FROM menu WHERE id_menu='".$cek[$i]."'");    
					}  
				}
				else {
					for($i=0;$i<$jumlah;$i++){
					//echo $jumlah." - $cek[$i] - ".$cek[$i]; 
						$query = $this->db->query("SELECT nama_file,tanggal_modif FROM menu WHERE username='".$this->session->userdata('id_user')."' and id_menu='".$cek[$i]."'");
						$row = $query->row();  
						$jumlah = $query->num_rows();
						if ($jumlah>0) {
						if ($row->nama_file!=''){ 
							$pathdelete=str_replace("-","/",$row->tanggal_modif);
							unlink("../file/".$pathdelete."/".$row->nama_file); 
							}
							$this->M_dataadmin->query_manual("DELETE FROM menu WHERE username='".$this->session->userdata('id_user')."' and id_menu='".$cek[$i]."'"); 
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
				$this->M_dataadmin->query_manual("UPDATE menu SET aktif='Y' WHERE id_menu=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM menu WHERE username='".$this->session->userdata('id_user')."' and id_menu='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE menu SET aktif='Y' WHERE id_menu=".$kode."");
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
				$this->M_dataadmin->query_manual("UPDATE menu SET aktif='N' WHERE id_menu=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM menu WHERE username='".$this->session->userdata('id_user')."' and id_menu='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE menu SET aktif='N' WHERE id_menu=".$kode."");
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
	 
	public function linkmenu () {  
		$nilai = $this->input->post('metode');
		if ($nilai==1) {
		?>
		<div class="form-group">
		<label>Pilih Posisi Menu</label> 
		<select class="form-control"  name="link" id="link">
			<option value="0" selected>- Pilih Kategori -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihkategori(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="<?php echo $raw['id_kategori'];?>"><?php echo $raw['nama_kategori'];?></option>
			<?php } ?>			
        </select>
		</div>
		<?php } 
		else if ($nilai==2) { ?>
		<select class="form-control"  name="kategoria" id="kategoria">
			<option value="0" selected>- Pilih Kategori -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihkategori(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="<?php echo $raw['id_kategori'];?>"><?php echo $raw['nama_kategori'];?></option>
			<?php } ?>			
        </select><br>
		
		 
		<div id="link"> 
		</div>	
		 
	 
		<script type="text/javascript"> 
		$("#kategoria").change(function(){
		var prop = $("#kategoria").val();
		var prop=prop+'-2';
		//var prop=prop+'/2';
		$.ajax({ 
		url: "<?php echo base_url()?>menu/linkberita", 
		type: 'POST', 
		data:  "prop="+prop, 
		cache: false,
		success: function(msg){
		$("#link").html(msg); 
		}
		});
		});  
		</script>	

		<?php } 
		else if ($nilai==3) { ?>
		<?php
		}
	}
	
	public function linkberita () {  
		 
		$prop = $this->input->post('prop');
		//$prop =  $this->input->get('prop');
		//$prop =$_POST['prop'];
		//$prop =$_GET['prop'];
		$string = $prop;
		$data = explode("-", $string);
		$prop1=$data[0];
		$prop2=$data[1];
		echo $prop;
		echo "<br>";
		echo $prop1;
		echo "<br>";
		echo $prop2;
		echo "<br>sdfsdfsf<br>";
		if ($prop2==2) {
			echo "jangkrik";
		
		} 
	}
	  
	
	public function denied () {
		$data['vdata']='access-denied';  
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);
	}
	
	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."menu'>";
	}
	
	  
}

