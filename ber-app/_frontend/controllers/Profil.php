<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("M_data");
		$this->load->helper('tgl_indonesia');
		$this->load->helper('fungsi_seo');
	}


	public function detail ()
	{
		$data['detail_berita']=$this->M_data->idprofil($this->uri->segment(3,0));
		$data['menu'] = $this->M_data->getMenu2(2,"");
		//$data['judulan']=$this->M_data->judulprofil($this->uri->segment(3,0));
		$data['judulapp']=$this->M_data->judulprofil($this->uri->segment(3,0))." | ".$this->M_data->titlesistem(1);

		//$data['judulapp']=$this->M_data->judulberita($this->uri->segment(3,0))." | ".$this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->judulprofil($this->uri->segment(3,0)).", ".$this->M_data->keyword(1);
		$data['deskripsi']=character_limiter(strip_tags($this->M_data->deskripsiprofil($this->uri->segment(3,0))), 500);


		$data['kategori'] = $this->M_data->tampil_kategori()->result();
		$data['judulappfooter']=$this->M_data->titlesistem(1);

		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentprofil';
		$this->load->view("v_datakirikanan",$data);
	}

}



