<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dok extends CI_Controller {

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
		$data["katdokumen"]=$this->m_data->katdokumen();
		$data['keyword']=$this->m_data->keyword(1);  
		$data['postingby']="Admin KPU Provinsi Jambi"; 
		
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
		 
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		
		
		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentdokumen';
		$this->load->view("v_datakirikanan",$data);  

	}
	
	
	public function detail ()
	{
		$data['detail_berita']=$this->m_data->iddokumen($this->uri->segment(3,0));
		$data['menu'] = $this->m_data->getMenu2(2,""); 
		$data['judulan']=$this->m_data->juduldokumen($this->uri->segment(3,0));
		$data['judulapp']=$this->m_data->juduldokumen($this->uri->segment(3,0))." | ".$this->m_data->deskripsi(1);	
		$data['deskripsi']=$this->m_data->juduldokumen($this->uri->segment(3,0))." | ".$this->m_data->deskripsi(1);	
		$data['keyword']=$this->m_data->keyword(1);  
		$data['postingby']="Admin KPU Provinsi Jambi"; 
		
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
		 
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		
		
		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentdokumen';
		$this->load->view("v_datakirikanan",$data);  
	}
		
	public function kategori ($id='')
	{ 
		$query = $this->db->query("select count(*) as jml from dokumen where id_katdokumen = '".$id."' and aktif='Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/dok/kategori/'.$id.'/';
        $config['total_rows'] = $row;
        $config['per_page'] = 15;
        $config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['next_link']='Berikutnya &gt;';
		$config['prev_link']='&lt; Sebelumnya';
        $this->pagination->initialize($config); 
		$data['pagination']=$this->pagination->create_links();

		if($this->uri->segment(4) > 0)
			$offset = ($this->uri->segment(4) + 0)*$config['per_page'] - $config['per_page'];
		else
			$offset = $this->uri->segment(4);
        $data['artikel'] = $this->m_data->getdokumenkat($id, $config['per_page'], $offset);
		$data['deskripsi']="Peraturan/Produk Hukum: ".$this->m_data->judulkatdokumen($this->uri->segment(3,0))." | ".$this->m_data->deskripsi(1);	
		$data['judulan']=$this->m_data->judulkatdokumen($this->uri->segment(3,0));
		$data['judulapp']="Kategori Peraturan/Produk Hukum: ".$this->m_data->judulkatdokumen($this->uri->segment(3,0))." | ". $this->m_data->titlesistem(1);
		$data['keyword']=$this->m_data->keyword(1);  
		$data['postingby']="Admin KPU Provinsi Jambi"; 
		
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
		 
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		
		
		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentdokumen';
		$this->load->view("v_datakirikanan",$data);  
	}
	
	
}



