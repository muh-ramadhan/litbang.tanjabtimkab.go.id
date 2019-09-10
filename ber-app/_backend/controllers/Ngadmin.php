<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ngadmin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('captcha','date','text_helper'));
		//	$this->load->library(array('email'));
		$this->load->library(array('recaptcha'));
		$this->load->library('pagination');
		$this->load->model('M_dataadmin');
		$this->load->helper('rupiah');
		$this->load->helper('tgl_indonesia');
		$this->load->helper('fungsi_seo');
		$this->load->helper('fungsi_thumb');
		$this->load->helper('fungsi_mkdir');
		$this->load->helper('fungsi_backup');
		//session_start();
	}
	
	public function index()
	{ 
 
				$data['judulapp']="Administrator";
				$data['vnavigasi']='admin/navigasi';
				$data['vdata']='admin/d-dashboard';
				$this->load->view("admin/dashboard",$data); 	 
	}
	
	function login()
	{ 
		$session=isset($_SESSION['billyshop_jambi']) ? $_SESSION['billyshop_jambi']:'';
		if($session!=""){
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."ngadmin'>";
		}
		else{
			$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'font_path' => './system/fonts/impact.ttf',
			'img_width' => '200',
			'img_height' => 60,
			'expiration' => 90
			);
			$cap = create_captcha($vals);
		 
			$datamasuk = array(
				'captcha_time' => $cap['time'],
				'ip_address' => $this->input->ip_address(),
				'word' => $cap['word']
				);
			$expiration = time()-900;
			$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
			$query = $this->db->insert_string('captcha', $datamasuk);
			$this->db->query($query);
			$data['gbr_captcha'] = $cap['image'];
			
			$data['recaptcha_html'] = $this->recaptcha->render();
			$this->load->view('admin/login',$data);
		} 
	}
	
	function aksilogin()
	{
		$username =  $this->input->post('username');
		$pwd = $this->input->post('password');
		$hasil = $this->M_dataadmin->data_login_admin($username,$pwd);
				if (count($hasil->result_array())>0){
					$sql_hapus  = "delete FROM captcha";
					$query = $this->db->query($sql_hapus);
					foreach($hasil->result() as $items){
						$session_username=$items->username."|".$items->nama_lengkap."|".$items->id_session."|".$items->level;
					}
					$_SESSION['billyshop_jambi']=$session_username;
					echo "1";
				}
				else{
					?>
					<script type="text/javascript">
					alert("Username atau Password Yang Anda Masukkan Salah ..!!!");			
					</script>
					<?php
					//echo "<meta http-equiv='refresh' content='0; url=".base_url()."ngadmin/login'>";
				} 
	}
	
	
	function fm()
	{ 
		$session=isset($_SESSION['billyshop_jambi']) ? $_SESSION['billyshop_jambi']:'';
		if($session!=""){
			
			$data['judulapp']="File Manager";
			$data['vnavigasi']='admin/navigasi';
			$data['vdata']='admin/d-dashboard';
			$this->load->view('admin/d-fm',$data);
		}
		else{
			$data['recaptcha_html'] = $this->recaptcha->render();
			$this->load->view('admin/login',$data);
			
			
		} 
	}
	
	/************ S:IDENTITAS ************/
	function identitas()
	{
		$session=isset($_SESSION['billyshop_jambi']) ? $_SESSION['billyshop_jambi']:'';
		if($session!=""){ 
			$data['judulapp']="Identitas Website";
			$data['vnavigasi']='admin/navigasi';
			$data['vdata']='admin/v_identitas';
			$this->load->view('admin/dashboard',$data);
		}
		else{
			$data['recaptcha_html'] = $this->recaptcha->render();
			$this->load->view('admin/login',$data); 
		} 
	} 
	/************ S:IDENTITAS ************/
	
	/************ S:BERITA ************/
	function berita()
	{ 
		$session=isset($_SESSION['billyshop_jambi']) ? $_SESSION['billyshop_jambi']:'';
		if($session!=""){ 
			$data['judulapp']="Data Berita";
			$data['vnavigasi']='admin/navigasi';
			$data['vdata']='admin/v_berita';
			$this->load->view('admin/dashboard',$data);
		}
		else{
			$data['recaptcha_html'] = $this->recaptcha->render();
			$this->load->view('admin/login',$data);
			
			
		} 
	} 
	function beritatambah()
	{ 
		$session=isset($_SESSION['billyshop_jambi']) ? $_SESSION['billyshop_jambi']:'';
		if($session!=""){ 
			$data['judulapp']="Identitas Website";
			$data['vnavigasi']='admin/navigasi';
			$data['vdata']='admin/v_beritatambah';
			$this->load->view('admin/dashboard',$data);
		}
		else{
			$data['recaptcha_html'] = $this->recaptcha->render();
			$this->load->view('admin/login',$data); 
		} 
	}
	
	function beritaupdate()
	{ 
		$session=isset($_SESSION['billyshop_jambi']) ? $_SESSION['billyshop_jambi']:'';
		if($session!=""){ 
			$data['judulapp']="Identitas Website";
			$data['vnavigasi']='admin/navigasi';
			$data['vdata']='admin/v_beritaupdate';
			$this->load->view('admin/dashboard',$data);
		}
		else{
			$data['recaptcha_html'] = $this->recaptcha->render();
			$this->load->view('admin/login',$data); 
		} 
	}
	/************ S:BERITA ************/
	
	
	
	function logout()
	{
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."ngadmin/login'>";
		//echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
	}
}
