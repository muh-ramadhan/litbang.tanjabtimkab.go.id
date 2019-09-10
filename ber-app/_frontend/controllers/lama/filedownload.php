<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class filedownload extends CI_Controller {

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
		$data['menu'] = $this->m_data->getMenu2(2,""); 
		$query = $this->db->query("select count(*) as jml from download where  publish = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/filedownload/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
		$config['next_link']='Berikutnya &gt;';
		$config['prev_link']='&lt; Sebelumnya';
		
        $this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
        $data['artikel'] = $this->m_data->alldownload($config['per_page'], $this->uri->segment(3));
		$data["fotokolom"]=$this->m_data->fotokolom();
		
		$data['judulapp']="File Download | Official Website Pemerintah Kabupaten Tanjung Jabung Timurh";
		//$data['judulan']="Semua pegawai";
		//$data['kategori_pegawai']=$this->m_data->katpegawai($this->uri->segment(3,0));
		//$data["utamaall"]=$this->m_data->utamaall(); 
		$data["potensidaerah"]=$this->m_data->potensidaerah();
		$data["pollingan"]=$this->m_data->pollingan("");
		 //
		 
		$data['vkanan1']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentdownload';
		$this->load->view("v_datakirikanan",$data);

	}
	
	
	
}