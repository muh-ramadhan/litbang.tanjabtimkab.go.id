<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polling extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from polling");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/polling/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexpolling('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}
		
			//LOADING VIEW
			$data['vdata']='v_polling';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Kategori Berita";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_polling';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Kategori Berita";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editpolling($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_polling';
			}
			else {
				$data['vdata']='access-denied'; 
			}
		}
		else {
			$data['vdata']='access-denied'; 
		} 
		$data['judulapp']="Edit Kategori Berita";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
	
function a_simpan()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$inputdata=$this->input->post('inputdt');
			$idpolling=$this->input->post('id');
			$nilai=1;
			$tglsekarang=date('Y-m-d');
			$jamsekarang = date("H:i:s");
			
			$this->M_dataadmin->query_manual("INSERT INTO polling(id_polling,
								pertanyaan,
								aktif,
								tgl_posting,
								username,
								jam
								) 
                            VALUES('".$idpolling."',
								'".$this->input->post('pertanyaan')."',
								'".$this->input->post('aktif')."',
								'".$tglsekarang."',
								'".$this->session->userdata('id_user')."',
								'".$jamsekarang."')");   
			
			for($i=1;$i<=$inputdata;$i++){   
				$pilihan=$this->input->post('pilihan'.$i);
				$this->M_dataadmin->query_manual("INSERT INTO pollingpilihan (id_polling,
									pilihan,
									rating,
									aktif) 
                            VALUES('".$idpolling."',
									'".$pilihan."',
								   '".$nilai."',
								   'Y')");
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
			
			$this->M_dataadmin->query_manual("UPDATE polling SET pertanyaan = '".$this->input->post('pertanyaan')."', 
						aktif = '".$this->input->post('aktif')."' 
				WHERE id_polling   = '".$kode."'");  
			
			$edit = $this->M_dataadmin->custom_query("SELECT * from pollingpilihan WHERE id_polling ='".$kode."'");
			$no=1;
			foreach($edit->result_array() as $row) {
			$pilihan=$this->input->post('pilihan'.$no);
			$rating=$this->input->post('rating'.$no); 
			$this->M_dataadmin->query_manual("UPDATE pollingpilihan SET pilihan ='".$pilihan."',
									rating = '".$rating."'					   
                             WHERE id_pollingpilihan = '".$row['id_pollingpilihan']."'");
				$no++;
			}	
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
				$this->M_dataadmin->query_manual("UPDATE polling SET aktif='Y' WHERE id_polling=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM polling WHERE username='".$this->session->userdata('id_user')."' and id_polling='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE polling SET aktif='Y' WHERE id_polling=".$kode."");
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
				$this->M_dataadmin->query_manual("UPDATE polling SET aktif='N' WHERE id_polling=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM polling WHERE username='".$this->session->userdata('id_user')."' and id_polling='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE polling SET aktif='N' WHERE id_polling=".$kode."");
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
	
	// S: AKTIF NON AKTIF KAN PILIHAN -------------------------------
	function aktifpilihan()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
		$kode2=$this->uri->segment(4,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE pollingpilihan SET aktif='Y' WHERE id_pollingpilihan=".$kode."");  
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."polling/edit/".$kode2."'>";
			}
			else {
				$query = $this->db->query("SELECT * FROM pollingpilihan left join polling on pollingpilihan.id_polling=polling.id_polling WHERE polling.username='".$this->session->userdata('id_user')."' and pollingpilihan.id_polling='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE pollingpilihan SET aktif='Y' WHERE id_pollingpilihan=".$kode."");
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."polling/edit/".$kode2."'>"; //$this->redirect();
				}
				else {
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."polling/edit/".$kode2."'>"; //$this->denied();
				}
			} 
		}
		else {
			$this->denied();	 
		} 
    }	
	
	function nonaktifpilihan()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
		$kode2=$this->uri->segment(4,0);
			if ($leveluser=="admin") { 
				$this->M_dataadmin->query_manual("UPDATE pollingpilihan SET aktif='N' WHERE id_pollingpilihan=".$kode."");  
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."polling/edit/".$kode2."'>";
			}
			else {
				$query = $this->db->query("SELECT * FROM pollingpilihan left join polling on pollingpilihan.id_polling=polling.id_polling WHERE polling.username='".$this->session->userdata('id_user')."' and pollingpilihan.id_polling='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE pollingpilihan SET aktif='N' WHERE id_pollingpilihan=".$kode."");
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."polling/edit/".$kode2."'>"; //$this->redirect();
				}
				else {
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."polling/edit/".$kode2."'>"; //$this->denied();
					//echo "<meta http-equiv='refresh' content='0; url=".base_url()."download/edit/".$kode."'>";
				}
			} 
		}
		else {
			$this->denied();	 
		} 
    }
	//////////E: AKTIF NON AKTIFKAN PILIHAN -------------------------------
	
	public function pilihanpolling () {  
		$prop = $this->input->post('inputdt');
		?>
		<table>	
		<?php
		for($li=1;$li<=$prop;$li++){ ?>
		<tr>
			<td width="80">Pilihan <? echo $li; ?></td>
			<td width="5">:</td><td>   <input style="margin-bottom:8px;" value="" type="text" class="form-control" name="pilihan<? echo $li; ?>" size="80"></td>
		</tr>
		<?php 
		} 
		?>
		</table>
		<?php
	}
	
	function delete()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{  
			$kode=$this->uri->segment(3,0);
			$query = $this->M_dataadmin->editpolling($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") { 
				$this->M_dataadmin->query_manual("DELETE FROM polling WHERE id_polling='".$kode."'"); 
				$this->M_dataadmin->query_manual("DELETE FROM pollingpilihan WHERE id_polling='".$kode."'"); 
				$this->redirect();
			}
			else {
				$this->denied();
			} 
			 
			$this->redirect(); 
			}
		else {
			$this->denied();
		}  
    }

	function hapuspilihan()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{  
			$kode=$this->uri->segment(3,0);
			$kode2=$this->uri->segment(4,0);
			$query = $this->M_dataadmin->editpolling($this->uri->segment(4,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {  
				$this->M_dataadmin->query_manual("DELETE FROM pollingpilihan WHERE id_pollingpilihan='".$kode."'"); 
				//$this->redirect();
				
			}
			else {
				$this->denied();
			} 
			 
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."polling/edit/".$kode2."'>";
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
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."polling'>";
	} 
}

