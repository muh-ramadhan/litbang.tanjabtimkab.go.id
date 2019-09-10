<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class flashrss extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("m_data");
		$this->load->helper('tgl_indonesia');
		$this->load->helper('fungsi_seo');
}
	 
	//data kelurahan
	public function kelurahanrss ($id='')
	{
		$data['datakelurahan']=$this->m_data->idkelurahan($this->uri->segment(3,0));
$data['pegawaikelurahan']=$this->m_data->pegawaikelurahan($this->uri->segment(3,0));
 $data['pegawaikecamatanall']=$this->m_data->pegawaikecamatanall();
$data['semuaberitaall']=$this->m_data->semuaberitaall();

		$data['vkanan1']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentberita';
		$this->load->view("flashrss/v_flashrss",$data);
	}
	
 
	public function pegawaicamatrss ($id='')
	{
		
		$data['vkanan1']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentberita';
		$this->load->view("flashrss/v_flashrss",$data);
	}

public function galerirss ()
	{
		
		$data['vkanan1']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentberita';
		$this->load->view("flashrss/v_flashrss",$data);
	}
	 
	  
 
	
	 
}



