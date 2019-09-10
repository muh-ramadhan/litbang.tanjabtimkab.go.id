<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class telpon extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from telp_penting where  aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/telpon/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
		$config['next_link']='Berikutnya &gt;';
		$config['prev_link']='&lt; Sebelumnya';
		
        $this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
        $data['artikel'] = $this->m_data->alltelpon($config['per_page'], $this->uri->segment(3)); 
		$data['deskripsi']="Telpon Penting | ".$this->m_data->titlesistem(1); 
		$data['judulapp']="Semua Telpon Penting | ".$this->m_data->titlesistem(1);
		$data['judulan']="Semua Telpon Penting";
		$data['keyword']="telpon penting kpu kab. sarolangun, ".$this->m_data->titlesistem(1);
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
		 
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		
		
		
		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contenttelponall';
		$this->load->view("v_datakirikanan",$data);

	}
	
	
}