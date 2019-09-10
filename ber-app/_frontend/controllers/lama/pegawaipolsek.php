<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pegawaipolsek extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from pegawailurah where  aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/pegawailurah/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 30;
        $config['uri_segment'] = 3;
		$config['next_link']='Berikutnya &gt;';
		$config['prev_link']='&lt; Sebelumnya';
		
        $this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
        //$data["artikel"] = $this->m_data->allpegawai2($config['per_page'], $this->uri->segment(3));
		$data["artikel"] = $this->m_data->allpegawai2($config['per_page'], $this->uri->segment(3));
		$data["slideimage"]=$this->m_data->imageslide();
		$data['judulapp']="Semua Pegawai | ".$this->m_data->titlesistem(1);
		$data['deskripsi']=$this->m_data->deskripsi(1);
		$data['menu'] = $this->m_data->getMenu2(2,""); 
		$data['keyword']=$this->m_data->keyword(1);
		
		$data['postingby']="Staff Kec. Telanaipura - Pemeritah Kota Jambi";
		$data["menukelurahan"]=$this->m_data->menukelurahan("");
		$data["menupelayanan"]=$this->m_data->menupelayanan("");
		$data["menudatabase"]=$this->m_data->menudatabase("");
		$data["terpopuler"]=$this->m_data->terpopuler();
		$data["pengaduan"]=$this->m_data->pengaduan(""); 
		//$data["pengumuman"]=$this->m_data->pengumuman(""); 
		
		$data['vkiri']='v_kiri2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentpegawai';
		$this->load->view("v_database",$data);

	}
	
	
	public function detail ()
	{
		$data['detail_pegawai']=$this->m_data->idpegawai2($this->uri->segment(3,0));
		$data['judulan']=$this->m_data->judulpegawai2($this->uri->segment(3,0));
		$data['judulapp']=$this->m_data->judulpegawai2($this->uri->segment(3,0))." | ".$this->m_data->titlesistem(1);
		$data['deskripsi']=$this->m_data->deskripsi(1);
		$data['menu'] = $this->m_data->getMenu2(2,""); 
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
		$data['vdata']='v_contentpegawai';
		$this->load->view("v_datakirikanan",$data); 
	}
	
}