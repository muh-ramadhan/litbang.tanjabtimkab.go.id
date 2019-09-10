<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submenu extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from submenu");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/submenu/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexsubmenu('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}
		
			//LOADING VIEW
			$data['vdata']='v_submenu';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Submenu Front-End";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_submenu';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Submenu Front-End";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editsubmenu($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$query = $this->db->query("SELECT * FROM menu where id_menu='".$row->id_menu."'");
				$row = $query->row(); 
				//$posisi=
				$data['posisi']=$row->id_position;	
				$data['vdata']='v_submenu';
			}
			else {
				$data['vdata']='access-denied'; 
			}
		}
		else {
			$data['vdata']='access-denied'; 
		} 
		$data['judulapp']="Edit Submenu Front-End";
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
			 
			
			$hariini=nama_hari($this->input->post('tanggal'));
			$jamsekarang = date("H:i:s");
			
			$this->M_dataadmin->query_manual("INSERT INTO submenu(id_menu, 
                                    nama_submenu,
									aktif,
									css,
									tgl_posting,
									username,
									keterangan,
                                    link_submenu)
                            VALUES('".$this->input->post('id_parent')."', 
                                   '".$this->input->post('nama_submenu')."',
								   '".$this->input->post('aktif')."',
								   '".$this->input->post('css')."',
								   '".$tanggal."',
								   '".$this->session->userdata('id_user')."',
								   '".$this->input->post('keterangan')."',
                                   '".$this->input->post('link')."')");  
			 
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
			
			$this->M_dataadmin->query_manual("UPDATE submenu SET  id_menu = '".$this->input->post('id_parent')."',
									keterangan = '".$this->input->post('keterangan')."',
                                   nama_submenu = '".$this->input->post('nama_submenu')."',
								   css = '".$this->input->post('css')."',
                                   link_submenu  = '".$this->input->post('link')."',
								   aktif = '".$this->input->post('aktif')."'
                             WHERE id_submenu   = '".$kode."'");  
				 
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
			$query = $this->M_dataadmin->editsubmenu($kode); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") { 
				$this->M_dataadmin->query_manual("DELETE FROM submenu WHERE id_submenu=".$kode."");  
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
						$this->M_dataadmin->query_manual("DELETE FROM submenu WHERE id_submenu='".$cek[$i]."'");    
					}  
				}
				else {
					for($i=0;$i<$jumlah;$i++){
						$this->M_dataadmin->query_manual("DELETE FROM submenu WHERE username='".$this->session->userdata('id_user')."' and id_submenu='".$cek[$i]."'");  
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
	
	function urutall()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{   
				$cek = $this->input->post('cek');  
				$jumlah = count($cek); 
				$urutan=$this->input->post('urutan'); 
				
				if(!empty($cek)){ 
				if ($leveluser=="admin") {
					for($i=0;$i<$jumlah;$i++){ 	
						$this->M_dataadmin->query_manual("UPDATE submenu SET urutan = '".$urutan[$i]."' WHERE id_submenu = '".$cek[$i]."'");   
						//"UPDATE submenu SET urutan = '".$urutan[$i]."' WHERE id_submenu = '".$cek[$i]."'"						
					}  
				}
				else {
					$this->redirect();
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
				$this->M_dataadmin->query_manual("UPDATE submenu SET aktif='Y' WHERE id_submenu=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM submenu WHERE username='".$this->session->userdata('id_user')."' and id_submenu='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE submenu SET aktif='Y' WHERE id_submenu=".$kode."");
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
				$this->M_dataadmin->query_manual("UPDATE submenu SET aktif='N' WHERE id_submenu=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM submenu WHERE username='".$this->session->userdata('id_user')."' and id_submenu='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE submenu SET aktif='N' WHERE id_submenu=".$kode."");
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
	
	function hapuslink()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{  
			$kode=$this->uri->segment(3,0);
			//$kode2=$this->uri->segment(4,0);
			$query = $this->M_dataadmin->editsubmenu($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {  
				$this->M_dataadmin->query_manual("UPDATE submenu SET link_submenu='' WHERE id_submenu=".$kode."");  
				//$this->M_dataadmin->query_manual("DELETE FROM pollingpilihan WHERE id_pollingpilihan='".$kode."'"); 
				//$this->redirect(); 
			}
			else {
				$this->denied();
			}  
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."submenu/edit/".$kode."'>";
			}
		else {
			$this->denied();
		}  
    }	
	 
	public function linksubmenu () {  
		$nilai = $this->input->post('metode');
		if ($nilai==1) {
		?>
		<div class="form-group">
		<label>Pilih Kategori</label> 
		<select class="form-control"  name="link" id="link">
			<option value="0" selected>- Pilih Kategori -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihkategori(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="kategori/<?php echo  $raw['kategori_seo'];?>"><?php echo $raw['nama_kategori'];?></option>
			<?php } ?>			
        </select>
		</div>
		<?php } 
		else if ($nilai==2) { ?>
		 <div class="form-group">
		<label>Pilih Kategori Berita</label> 
		<select class="form-control"  name="kategoria" id="kategoria">
			<option value="0" selected>- Pilih Kategori -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihkategori(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="<?php echo $raw['id_kategori'];?>"><?php echo $raw['nama_kategori'];?></option>
			<?php } ?>			
        </select>
		</div><br> 
		
		 <div class="form-group">
			<label>Pilih Item Berita</label> 
			<select class="form-control"  name="link" id="link">
				<option value="0" selected>- Pilih Item Berita -</option> 
			</select>
		</div>			
		
		<script type="text/javascript"> 
		$("#kategoria").change(function(){
		var prop = $("#kategoria").val();
		var prop=prop+'-2'; 
		$.ajax({ 
		url: "<?php echo base_url()?>link/linkberita", 
		type: 'POST', 
		data:  "prop="+prop, 
		cache: false,
		success: function(msg){
		$("#link").html(msg); 
		}
		});
		});  
		</script>	

		<?php 
		}
		else if ($nilai==3) { ?>
		<div class="form-group">
		<label>Pilih Kategori Produk Hukum</label> 
		<select class="form-control"  name="link" id="link">
			<option value="0" selected>- Pilih -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihkatprodukhukum(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="peraturan/kategori/<?php echo $raw['id_katprodukhukum'];?>/<?php echo seo_link($raw['nama_katprodukhukum']);?>"><?php echo $raw['nama_katprodukhukum'];?></option>
			<?php } ?>			
        </select>
		</div>
		<?php
		}
		else if ($nilai==4) { ?>
		 <div class="form-group">
		<label>Pilih Kategori Produk Hukum</label> 
		<select class="form-control"  name="kategoria" id="kategoria">
			<option value="0" selected>- Pilih -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihkatprodukhukum(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="<?php echo $raw['id_katprodukhukum'];?>"><?php echo $raw['nama_katprodukhukum'];?></option>
			<?php } ?>			
        </select>
		</div><br> 
		
		 <div class="form-group">
			<label>Pilih Item Produk Hukum</label> 
			<select class="form-control"  name="link" id="link">
				<option value="0" selected>- Pilih -</option> 
			</select>
		</div>			
		
		<script type="text/javascript"> 
		$("#kategoria").change(function(){
		var prop = $("#kategoria").val();
		var prop=prop+'-2'; 
		$.ajax({ 
		url: "<?php echo base_url()?>link/linkprodukhukum", 
		type: 'POST', 
		data:  "prop="+prop, 
		cache: false,
		success: function(msg){
		$("#link").html(msg); 
		}
		});
		});  
		</script>	

		<?php 
		}
		else if ($nilai==5) { ?>
		<div class="form-group">
		<label>Pilih Kategori Dokumen</label> 
		<select class="form-control"  name="link" id="link">
			<option value="0" selected>- Pilih -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihkatdokumen(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="dokumen/kategori/<?php echo $raw['id_katdokumen'];?>/<?php echo seo_link($raw['nama_katdokumen']);?>"><?php echo $raw['nama_katdokumen'];?></option>
			<?php } ?>			
        </select>
		</div>
		<?php
		}
		else if ($nilai==6) { ?>
		 <div class="form-group">
		<label>Pilih Kategori Dokumen</label> 
		<select class="form-control"  name="kategoria" id="kategoria">
			<option value="0" selected>- Pilih -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihkatdokumen(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="<?php echo $raw['id_katdokumen'];?>"><?php echo $raw['nama_katdokumen'];?></option>
			<?php } ?>			
        </select>
		</div><br> 
		
		 <div class="form-group">
			<label>Pilih Item Dokumen</label> 
			<select class="form-control"  name="link" id="link">
				<option value="0" selected>- Pilih -</option> 
			</select>
		</div>			
		
		<script type="text/javascript"> 
		$("#kategoria").change(function(){
		var prop = $("#kategoria").val();
		var prop=prop+'-2'; 
		$.ajax({ 
		url: "<?php echo base_url()?>link/linkdokumen", 
		type: 'POST', 
		data:  "prop="+prop, 
		cache: false,
		success: function(msg){
		$("#link").html(msg); 
		}
		});
		});  
		</script>	 
		<?php 
		}
		else if ($nilai==7) { ?>
		<div class="form-group">
		<label>Pilih Artikel</label> 
		<select class="form-control"  name="link" id="link">
			<option value="0" selected>- Pilih -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihartikel(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="artikel/detail/<?php echo $raw['id_artikel'];?>/<?php echo seo_link($raw['judul']);?>"><?php echo $raw['judul'];?></option>
			<?php } ?>			
        </select>
		</div>
		<?php
		}
		else if ($nilai==8) { ?>
		<div class="form-group">
		<label>Pilih Album Kegiatan</label> 
		<select class="form-control"  name="link" id="link">
			<option value="0" selected>- Pilih -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihalbum(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="galeri/detail/<?php echo $raw['id_fotoberita'];?>/<?php echo seo_link($raw['judul_fotoberita']);?>"><?php echo $raw['judul_fotoberita'];?></option>
			<?php } ?>			
        </select>
		</div>
		<?php
		}
		else if ($nilai==9) { ?>
		<div class="form-group">
		<label>Pilih Pengumuman</label> 
		<select class="form-control"  name="link" id="link">
			<option value="0" selected>- Pilih -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihpengumuman(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="pengumuman/<?php echo $raw['id_pengumuman'];?>/<?php echo seo_link($raw['judul']);?>"><?php echo $raw['judul'];?></option>
			<?php } ?>			
        </select>
		</div>
		<?php
		}
		else if ($nilai==10) { ?>
		<div class="form-group">
		<label>Pilih Halaman Profil</label> 
		<select class="form-control"  name="link" id="link">
			<option value="0" selected>- Pilih Halaman Profil -</option>
			<?php
				$dataa = $this->M_dataadmin->pilihhalamanprofil(); 
				foreach($dataa->result_array() as $raw) {
				?> 
					<option  value="profil/detail/<?php echo $raw['id_halamanprofil'];?>/<?php echo $raw['judul_seo'];?>"><?php echo $raw['judul'];?></option>
			<?php } ?>			
        </select>
		</div>
		<?php
		}
		else { ?>
		<div class="form-group">
		<label>Custom Link</label>  
								<input  class="form-control" type="text" name="link" value="">
		</div>
		<?php
		}
	}
	 
	
	public function pilihmenu () {  
		 
		$posisi = $this->input->post('posisi'); 
		
		?> 
		<option value="0" selected>- Pilih Menu Utama -</option> 
			<?php
			$dataa = $this->M_dataadmin->pilihmenu($posisi); 
			foreach($dataa->result_array() as $raw) { 
			?> 
				<option  value="<?php echo $raw['id_menu'];?>"><?php echo $raw['nama_menu'];?></option>
			<?php } ?>	 
		<?php 
	}	
	
	public function denied () {
		$data['vdata']='access-denied';  
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);
	}
	
	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."submenu'>";
	}
	
	  
}

