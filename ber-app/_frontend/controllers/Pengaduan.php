<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("M_data");
		$this->load->library('form_validation');
		$this->load->helper('tgl_indonesia');
		$this->load->helper('fungsi_seo');
		$this->load->helper('fungsi_sizeunit');
		$this->load->library('recaptcha');
	}

	public function index ()
	{
		$data['judulapp']="Pengaduan Masyarakat | ".$this->M_data->titlesistem(1);
		$data['judulan']="Pengaduan Masyarakat";
		$data['judulapp']="Pengaduan Masyarakat ".$this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['deskripsi']=$this->M_data->deskripsi(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";
		$data['judulappfooter']=$this->M_data->titlesistem(1);
		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentpengaduan';
		$this->load->view("v_datakirikanan",$data);

	}



	public function simpan()
	{
		$data['judulapp']="Pengaduan Masyarakat | ".$this->M_data->titlesistem(1);
		$data['judulan']="Pengaduan Masyarakat";
		//$cap = $this->buat_captcha();
		//$data['cap_img'] = $cap['image'];
		//$this->session->set_userdata('kode_captcha', $cap['word']);
		$data['judulapp']="Pengaduan Masyarakat ".$this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['deskripsi']=$this->M_data->deskripsi(1);

		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";


		$data['judulappfooter']=$this->M_data->titlesistem(1);

		$this->form_validation->set_rules('nama', 'lang:Nama', 'required');
		$this->form_validation->set_rules('alamat', 'lang:Alamat', 'required');
		$this->form_validation->set_rules('judulpengaduan', 'lang:Nama yang Diadukan', 'required');
		$this->form_validation->set_rules('email', 'lang:Email', 'required');

		$this->form_validation->set_rules('lembaga', 'lang:Lembaga', 'required');
		$this->form_validation->set_rules('pesan', 'lang:Pesan', 'required');
		$this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_recaptcha');

		//$this->form_validation->set_error_delimiters('<div style="border: 1px solid: #999999; background-color: #ffff99;">', '</div>');


		$captcha = (string) $this->input->post("g-recaptcha-response", true);
		/*
		//Captcha check
		if(!$this->recaptcha->validate($captcha))
		{
			//Validation has failed

		   //Get errors and handle errors as you please
		   $errors = $this->recaptcha->errors;
		}
		//Else Captcha OK, continue
		else {

		}

		*/

		if ($this->form_validation->run() === FALSE)
		{
			$data['vkanan']='v_kanan2';
			$data['vheader']='v_header';
			$data['vfooter']='v_footer';
			$data['vdata']='v_contentpengaduan';
			$this->load->view("v_datakirikanan",$data);
		}
		else  {
		/*
		if(!$this->recaptcha->validate($captcha))
		{
			//Validation has failed

		   //Get errors and handle errors as you please
		   $errors = $this->recaptcha->errors;
		}
		//Else Captcha OK, continue
		else {

		}
		*/
		$ipaddress=trim(@$_POST["ipaddress"]);
        $name=trim(@$_POST["nama"]);
        $name=str_replace("/(<\/?)(p)([^>]*>)", "",$name);
        $name=htmlspecialchars($name,ENT_QUOTES);
        $email=trim(@$_POST["email"]);
        $email=str_replace("/(<\/?)(p)([^>]*>)", "",$email);
        $email=htmlspecialchars($email,ENT_QUOTES);
		$judulpengaduan=trim(@$_POST["judulpengaduan"]);
        $judulpengaduan=str_replace("/(<\/?)(p)([^>]*>)", "",$judulpengaduan);
        $judulpengaduan=htmlspecialchars($judulpengaduan,ENT_QUOTES);
        $alamat=trim(@$_POST["alamat"]);
        $alamat=str_replace("/(<\/?)(p)([^>]*>)", "",$alamat);
        $alamat=htmlspecialchars($alamat,ENT_QUOTES);
        $lembaga=trim(@$_POST["lembaga"]);
        $lembaga=str_replace("/(<\/?)(p)([^>]*>)", "",$lembaga);
        $lembaga=htmlspecialchars($lembaga,ENT_QUOTES);
        $message=trim(@$_POST["pesan"]);
        $message=str_replace("/(<\/?)(p)([^>]*>)", "",$message);
        $message=htmlspecialchars($message,ENT_QUOTES);

        $result=$this->M_data->simpanpengaduan($ipaddress,
											$name,
											$email,
                                            $judulpengaduan,
                                            $alamat,
											$lembaga,
                                            $message);

        if($result=='0'){
            $data["msg"]="Data tidak bisa disimpan";
        }else{
            $data["msg"]="Data sukses disimpan";
        }
        $data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentpengaduansukses';
		$this->load->view("v_datakirikanan",$data);

		//$data['vdata']='v_contentpengaduansukses';
		//$this->load->view("v_datakirikanan",$data);
		}
	}
	/*
	public function cek_captcha($input)
	{
		if($input === $this->session->userdata('kode_captcha')){
			return TRUE;
		} else {
			$this->form_validation->set_message('cek_captcha', '%s yang anda input salah!');
			return FALSE;
		}
	}
	*/
	public function data ()
	{
		$query = $this->db->query("select count(*) as jml from pengaduan where  aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/pengaduan/data/';
        $config['total_rows'] = $row;
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['next_link']='Berikutnya &gt;';
		$config['prev_link']='&lt; Sebelumnya';
        $this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
		if($this->uri->segment(3) > 0)
			$offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
		else
			$offset = $this->uri->segment(3);
        $data['artikel'] = $this->M_data->allpengaduan($config['per_page'], $offset);


		$data['judulapp']="Pengaduan Masyarakat | ".$this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['deskripsi']=$this->M_data->deskripsi(1);
		$data['judulan']="Pengaduan Masyarakat";
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";


		$data['judulappfooter']=$this->M_data->titlesistem(1);


		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentpengaduanall';
		$this->load->view("v_datakirikanan",$data);

	}
}
