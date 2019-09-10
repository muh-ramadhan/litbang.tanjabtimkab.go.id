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
		//$query = $this->db->query("SELECT count(select * FROM gallery GROUP BY id_album) as jml FROM gallery LEFT JOIN album  ON gallery.id_album=album.id_album  WHERE album.aktif='Y' ");
		
		//$query = $this->db->query("select count(*) as jml from album where aktif = 'Y' ");
		$query = $this->db->query("SELECT COUNT(*) as jml FROM ( SELECT * from gallery group by id_album) as temp;");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/galeri/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 3;
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
        $data['artikel'] = $this->m_data->allalbum($config['per_page'], $offset);
		
		
		$data["judulapp"]="Galeri Kegiatan - ".$this->m_data->titlesistem(1);
		$data['judulapp']="Galeri Kegiatan";	
		$data['keyword']="galeri kegiatan, ".$this->m_data->keyword(1); 
		$data['deskripsi']="Galeri Kegiatan - ".$this->m_data->titlesistem(1);
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
		$data['vdata']='v_galeri_album';
		$this->load->view("v_galerifoto",$data);
	}
		
	
	public function detailalbum()
	{
		//$data['baca']=$this->m_data->baca($this->uri->segment(3,0));
		$data["judulapp"]=$this->m_data->judulgaleri($this->uri->segment(3,0))." | ".$this->m_data->titlesistem(1);
		$data['keyword']="galeri kegiatan, ".$this->m_data->keyword(1);
		$data['deskripsi']="Galeri Kegiatan - ".$this->m_data->titlesistem(1); 
	    $data['judulan']=$this->m_data->judulgaleri($this->uri->segment(3,0));
		$data['keterangan']=$this->m_data->ketalbum($this->uri->segment(3,0));
		$data['detail_album']=$this->m_data->getidgaleri($this->uri->segment(3,0));
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
		$data['vdata']='v_galeri_detail';
		$this->load->view("v_galerifoto",$data);
	 
	}
	
	
	
}