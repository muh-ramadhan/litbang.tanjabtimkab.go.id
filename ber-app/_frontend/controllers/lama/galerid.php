<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class galeri extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("m_data");
				$this->load->helper('tgl_indonesia');
				$this->load->helper('fungsi_seo');
	}

	public function index()
	{
		$data["judulapp"]="Galeri Foto - Official Website Biro Kesejahteraan Masyarakat dan Rakyat Provinsi Jambi";
		 $data['menu'] = $this->m_data->getMenu2(2,""); 
		$data["album"]=$this->m_data->album();
		$data["tahun"]=$this->m_data->tahungaleri();
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		//$data['vdata']='v_contentpegawaiall';
		$data['vdata']='v_galeri_album';
		$this->load->view("v_datagaleri",$data);
		
	}
		
	
	public function detailalbum()
	{
	 

		//$data['komentar']=$this->m_data->jumlahkomentar($this->uri->segment(3,0));
		//$data['semuakomentar']=$this->m_data->semuakomentar($this->uri->segment(3,0));
	 
		$data['baca']=$this->m_data->baca($this->uri->segment(3,0));
		
		
	   $data['judulapp']=$this->m_data->judulgaleri($this->uri->segment(3,0))." Official Website Biro Kesejahteraan Masyarakat dan Rakyat Provinsi Jambi";
	    $data['judulan']=$this->m_data->judulgaleri($this->uri->segment(3,0));
		$data['detail_album']=$this->m_data->getidgaleri($this->uri->segment(3,0));
	 
		//$data["album"]=$this->m_data->album();
		//$data["tahun"]=$this->m_data->tahungaleri();
		//$data["judulapp"]="Galeri Foto - Official Website Pemerintah Kabupaten Tanjung Jabung Timur";
		 $data['menu'] = $this->m_data->getMenu2(2,""); 
		$data["album"]=$this->m_data->album();
		$data["tahun"]=$this->m_data->tahungaleri();
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		//$data['vdata']='v_contentpegawaiall';
		$data['vdata']='v_galeri_detail';
		$this->load->view("v_datagaleri",$data);
		//$this->load->view("v_galerifoto",$data);
	 
	}
	
	
	
}