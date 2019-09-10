<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peraturan extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("m_data");
		$this->load->helper('tgl_indonesia');
		$this->load->helper('fungsi_seo');
		$this->load->helper('fungsi_sizeunit');

		

	}
	public function index ()
	{
		$data['deskripsi']="Peraturan/Produk Hukum KPU Provinsi Jambi - ".$this->m_data->titlesistem(1);	
		$data['judulapp']="Peraturan/Produk Hukum KPU Provinsi Jambi | ".$this->m_data->titlesistem(1);
		$data['judulan']="Peraturan/Produk Hukum KPU Provinsi Jambi"; 
		$data['keyword']=$this->m_data->keyword(1);  
		$data['postingby']="Admin KPU Provinsi Jambi"; 
		
		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentperaturan';
		$this->load->view("v_datakirikanan",$data);  

	}
	
	
	public function detail ()
	{
		$data['detail_berita']=$this->m_data->idprodukhukum($this->uri->segment(3,0));
		$data['menu'] = $this->m_data->getMenu2(2,""); 
		$data['judulan']=$this->m_data->judulprodukhukum($this->uri->segment(3,0));
		$data['judulapp']=$this->m_data->judulprodukhukum($this->uri->segment(3,0))." | ".$this->m_data->titlesistem(1);	
		$data['deskripsi']=$this->m_data->deskripsi(1);
		$data['keyword']=$this->m_data->keyword(1);  
		$data['postingby']="Admin KPU Provinsi Jambi"; 
		 
		 
		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentperaturan';
		$this->load->view("v_datakirikanan",$data);  
	}
		
	public function kategori ($id='')
	{ 
		$data["tahun"]=$this->m_data->tahunprodukhukum($id);
		$data["katprodhukum"]=$this->m_data->katprodhukum($id); 
		$data["idkategori"]=$id;
		$data['keyword']= $this->m_data->keyword(1);
		$data['deskripsi']=$this->m_data->deskripsi(1);
		$data['judulapp']="Kategori Peraturan/Produk Hukum: ".$this->m_data->judulkatprodukhukum($this->uri->segment(3,0))." | ".$this->m_data->titlesistem(1);	
		$data['judulan']=$this->m_data->judulkatprodukhukum($this->uri->segment(3,0)); 
		$data['postingby']="Admin KPU Provinsi Jambi"; 
		 
		 
		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentperaturan';
		$this->load->view("v_datakirikanan",$data);  
	}
	
	
}



