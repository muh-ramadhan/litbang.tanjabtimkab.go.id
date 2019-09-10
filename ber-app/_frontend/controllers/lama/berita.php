<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class berita extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from berita where aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/berita/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 10;
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
        $data['artikel'] = $this->m_data->allberita($config['per_page'], $offset);
		$data['postingby']="KPU Provinsi Jambi"; 
		$data['judulapp']="Semua Berita ".$this->m_data->titlesistem(1);		
		$data['keyword']=$this->m_data->keyword(1);
		$data['deskripsi']=$this->m_data->deskripsi(1);
		$data['judulan']="Semua Berita";
		
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
		$data['vdata']='v_contentberitaall';
		$this->load->view("v_datakirikanan",$data);

	}
	
	
	public function detail ()
	{
		$data['judulapp']=$this->m_data->judulberita($this->uri->segment(3,0))." | ".$this->m_data->titlesistem(1);		
		$data['keyword']=$this->m_data->judulberita($this->uri->segment(3,0)).", ".$this->m_data->keyword(1);
		$data['deskripsi']=character_limiter(strip_tags($this->m_data->deskripsiberita($this->uri->segment(3,0))), 500);
		//character_limiter($this->m_data->deskripsiberita($this->uri->segment(3,0)), 500);
		$data['detail_berita']=$this->m_data->idberita($this->uri->segment(3,0));
		  
		$data['judulan']=$this->m_data->judulan($this->uri->segment(3,0));
		
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
		$data['vdata']='v_contentberita';
		$this->load->view("v_datakirikanan",$data);
	}
	 
	public function kategori ($ids='')
	{
		$idkat = $this->db->query("SELECT id_kategori FROM kategori WHERE kategori_seo='".$ids."'");
		$row = $idkat->row(); //takes only one result row
		$id = $row->id_kategori;
			
		$query = $this->db->query("select count(*) as jml from berita where  id_kategori = '".$id."' and aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/kategori/'.$ids.'/';
        $config['total_rows'] = $row;
        $config['per_page'] = 12;
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
        $data['artikel'] = $this->m_data->getberitakat($id, $config['per_page'], $offset); 
		$data['judulapp']=$this->m_data->judul($id)." | ".$this->m_data->titlesistem(1) ;
		$data['deskripsi']=character_limiter(strip_tags($this->m_data->deskripsiberita($this->uri->segment(3,0))), 500);
		$data['keyword']=$this->m_data->judulberita($id).", ".$this->m_data->keyword(1);
		$data['judulan']=$this->m_data->judul($id);
		$data['kategori_berita']=$this->m_data->katberita($this->uri->segment(3,0));
		
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
		$data['vdata']='v_contentberita';
		$this->load->view("v_datakirikanan",$data);
	}
	
	
	public function cariberita() { 
		$kata = trim($this->input->POST('kata'));
		$data['kata']=$kata;

  
		$data["cariberita"]=$this->m_data->cariberita($kata);	 
		$data['judulapp']="Pencarian Berita | ".$this->m_data->titlesistem(1) ;
		$data['deskripsi']=$this->m_data->deskripsi(1);
		$data['keyword']= $this->m_data->keyword(1); 
		$data['postingby']="Staff Kec. Telanaipura - Pemeritah Kota Jambi";
		$data['judulan']="Semua Berita";
		
		/** s:head **/
		$data['menu'] = $this->m_data->getMenu2(2,""); 
		$data['menuside'] = $this->m_data->getMenu1(2,""); 
		$data["slideimage"]=$this->m_data->slideimage(5);
		/** e:head **/
		
		$data["pollingan"]=$this->m_data->pollingan("");
		$data["pengumuman"]=$this->m_data->pengumuman(4);
		$data["weblink"]=$this->m_data->weblink(4);
		$data["agenda"]=$this->m_data->jadwalkegiatan(3);
		$data["beritaterbaru"]=$this->m_data->beritaterbaru(10);
		$data["fotokolom"]=$this->m_data->fotokolom(0,4);
		$data["terpopuler"]=$this->m_data->beritaterpopuler(5);
		$data["pengaduan"]=$this->m_data->pengaduan(5);
		$data["telppenting"]=$this->m_data->telppenting(10); 
		 
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		
		
		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentcariberita';
		$this->load->view("v_datakirikanan",$data); 
	}
	
	 
}



