<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class komisioner extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("m_data");
		$this->load->helper('tgl_indonesia');
		$this->load->helper('fungsi_seo');

}
	public function index ()
	{
		
		$data["komisioner"]=$this->m_data->allkomisioner(); 
		$data['judulapp']="Komisioner | ".$this->m_data->titlesistem(1);	
		
		$data['postingby']="KPU Provinsi Jambi";  	
		$data['keyword']=$this->m_data->keyword(1);
		$data['deskripsi']=$this->m_data->deskripsi(1);
		$data['judulan']="Komisioner KPU Provinsi Jambi";
		
		/** s:head **/
		$data['menu'] = $this->m_data->getMenu2(2,""); 
		$data['menuside'] = $this->m_data->getMenu1(2,""); 
		$data["slideimage"]=$this->m_data->slideimage(5);
		/** e:head **/
		
		$data["pollingan"]=$this->m_data->pollingan("");
		$data["pengumuman"]=$this->m_data->pengumuman(4);
		$data["weblink"]=$this->m_data->weblink(4);
		$data["agenda"]=$this->m_data->jadwalkegiatan(3);
		$data["beritaterbaru"]=$this->m_data->beritaterbaru(5);
		$data["fotokolom"]=$this->m_data->fotokolom(0,4);
		$data["terpopuler"]=$this->m_data->beritaterpopuler(5);
		$data["pengaduan"]=$this->m_data->pengaduan(5);
		$data["telppenting"]=$this->m_data->telppenting(10);  
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		
		
		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentkomisioner';
		$this->load->view("v_datakirikanan",$data);

	}
	
	
	public function detail ()
	{
		$data['judulapp']=$this->m_data->judulkomisioner($this->uri->segment(3,0))." | ".$this->m_data->titlesistem(1);		
		$data['keyword']=$this->m_data->judulkomisioner($this->uri->segment(3,0)).", ".$this->m_data->keyword(1);
		$data['deskripsi']=character_limiter(strip_tags($this->m_data->deskripsiberita($this->uri->segment(3,0))), 500);
		$data['detail_komisioner']=$this->m_data->idkomisioner($this->uri->segment(3,0));
		 $data['postingby']="KPU Provinsi Jambi";  	
		$data['judulan']=$this->m_data->judulkomisioner($this->uri->segment(3,0));
		
		/** s:head **/
		$data['menu'] = $this->m_data->getMenu2(2,""); 
		$data['menuside'] = $this->m_data->getMenu1(2,""); 
		$data["slideimage"]=$this->m_data->slideimage(5);
		$data["menubottom"]=$this->m_data->ambilmenu(4); 
		/** e:head **/
		
		$data["pollingan"]=$this->m_data->pollingan("");
		$data["pengumuman"]=$this->m_data->pengumuman(4);
		$data["weblink"]=$this->m_data->weblink(4);
		$data["agenda"]=$this->m_data->jadwalkegiatan(3);
		$data["beritaterbaru"]=$this->m_data->beritaterbaru(5);
		$data["fotokolom"]=$this->m_data->fotokolom(0,4);
		$data["terpopuler"]=$this->m_data->beritaterpopuler(5);
		$data["pengaduan"]=$this->m_data->pengaduan(5);
		$data["telppenting"]=$this->m_data->telppenting(10); 
		 
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		
		
		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentkomisioner';
		$this->load->view("v_datakirikanan",$data);
	}
	
}



