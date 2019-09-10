<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('captcha','date','text_helper'));
		$this->load->library(array('recaptcha'));
		$this->load->helper('security');
		$this->load->model('M_dataadmin');
    }

/*
function index()
    {

	$session=isset($_SESSION['id_user']) ? $_SESSION['id_user']:'';
	if($session!=""){
				$data['judulapp']="Administrator";
				$data['vnavigasi']='navigasi';
				$data['vdata']='d-dashboard';
				$this->load->view("dashboard",$data);

		}
		else{
			$data['recaptcha_html'] = $this->recaptcha->render();
			$this->load->view('login',$data);
		}


    }
*/


function index()
    {
	$session=isset($_SESSION['id_user']) ? $_SESSION['id_user']:'';
	if($session!=""){
		$data['judulapp']="Administrator";
		$data['vnavigasi']='navigasi';
		$data['vdata']='d-dashboard';
		$this->load->view("dashboard",$data);
	}
	else {

		$data['keyword']="Administrator";
		$data['judulapp']="Administrator";
		$data['deskripsi']="Administrator";

		$this->form_validation->set_rules('username', 'lang:Username', 'required|trim|callback_get_response_username');
		$this->form_validation->set_rules('password', 'lang:Password', 'required|trim|callback_get_response_username');

		//$this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_get_response_captcha');


		if($this->form_validation->run() == TRUE)
        {
			$username = trim($this->input->post('username'));
			$password = trim($this->input->post('password'));

			$akses = $this->db->query("select * from users where username='$username' and password=md5('$password') and blokir='N'");

			if($akses->num_rows() == 1)
			{
				foreach($akses->result_array() as $data)
				{
					$_SESSION['id_user'] = $data['username'];
					$_SESSION['nama'] = $data['nama_lengkap'];
					$_SESSION['level'] = $data['level'];
					$_SESSION['session_id'] = $data['id_session'];
					$_SESSION['filemanager'] = true;

					$this->session->set_userdata($_SESSION);
					redirect('dashboard', 'refresh');
				}
			}
			else
			{
			//$this->form_validation->set_message('logina', 'Invalid username or password');
			$data['error'] = "Invalid Username / Password";
			$data['recaptcha_html'] = $this->recaptcha->render();
			$this->load->view("login",$data);
			}
		}
		else
		{
			$data['error'] = "";
			$data['recaptcha_html'] = $this->recaptcha->render();
			$this->load->view("login",$data);
		}
	}

    }


	/** VALIDASI CAPTCHA **/
	public function get_response_username($string)
    {
        if ( preg_match('/\s/',$string) ){
			$this->form_validation->set_message('get_response_username', 'Karakter %s Tidak Diizinkan');
			return false;
		} else {
			  return true;
		}

		/*
        //jika verifikasi benar
        if ($response['success']) {
            //kembalikan nilai true
            return true;
        //jika verifikasi salah
        } else {
            //set pesan error untuk validasi recaptcha
            $this->form_validation->set_message('get_response_captcha', '%s harus diisi');
            //mengembalikan nilai false
            return false;
        }
		*/
    }

	/*
function aksilogin()
  {

  	$username = trim($this->input->post('username'));
  	$password =  trim($this->input->post('password'));

	$akses = $this->db->query("select * from users where username='$username' and password=md5('$password') and blokir='N'");

    if($akses->num_rows() == 1)
	{

	foreach($akses->result_array() as $data)
	{
	$_SESSION['kcfinder']=true;
	//$_SESSION['KCFINDER']['disabled'] = false;
	//$_SESSION['KCFINDER']['uploadURL'] = base_url()."/gambar/../tinymcpuk/gambar";
	//$_SESSION['KCFINDER']['uploadDir'] = base_url()."../tinymcpuk/gambar";

	$session['id_user'] = $data['username'];
	$session['nama'] = $data['nama_lengkap'];
	$session['level'] = $data['level'];
	$session['session_id'] = $data['id_session'];
	$session['filemanager'] = true;
	//$session['id_jabatan'] = $data['id_jabatan'];
	//$session['id_dept'] = $data['id_dept'];

	$this->session->set_userdata($session);
    //redirect('home');
	echo "1";
	}

	}
	else
	{
	$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> username / Password salah.
			    </div>");
	redirect('login');
	}
  }
*/

}
