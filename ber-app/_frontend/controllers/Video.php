<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("M_data");
		$this->load->helper('tgl_indonesia');
		$this->load->helper('fungsi_seo'); 
	}
	public function index ()
	{ 
		$query = $this->db->query("select count(*) as jml from video where  aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/video/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;
		$config['next_link']='Berikutnya &gt;';
		$config['prev_link']='&lt; Sebelumnya';
		
        $this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
        $data['artikel'] = $this->M_data->allvideo($config['per_page'], $this->uri->segment(3));
		
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur"; 
		$data['judulapp']="Video ".$this->M_data->titlesistem(1);		
		$data['keyword']=$this->M_data->keyword(1);
		$data['deskripsi']=$this->M_data->deskripsi(1);
		$data['judulan']="Video";
		  
		
		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentvideo';
		$this->load->view("v_datakirikanan",$data);

	}
	
	 
}