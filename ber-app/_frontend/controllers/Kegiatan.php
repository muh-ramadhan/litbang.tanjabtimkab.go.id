<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

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
		$data['menu'] = $this->M_data->getMenu2(2,"");
		$query = $this->db->query("select count(*) as jml from kegiatan where  aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/kegiatan/index/';
		//$config['base_url'] = base_url().'/dpo/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();

		if($this->uri->segment(3) > 0)
			$offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
		else
			$offset = $this->uri->segment(3);
        $data['artikel'] = $this->M_data->allkegiatan($config['per_page'], $offset);

		$data['judulapp']= "Agenda Kegiatan | ".$this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['deskripsi']=$this->M_data->deskripsi(1);
		$data['judulan']="Agenda Kegiatan";

		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";

		$data['judulappfooter']=$this->M_data->titlesistem(1);

		$data['vkanan']='v_kanan3';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentkegiatan';
		$this->load->view("v_datakirikanan",$data);

	}


	public function detail ()
	{
		$data['detail_kegiatan']=$this->M_data->idkegiatan($this->uri->segment(3,0));
		$data['menu'] = $this->M_data->getMenu2(2,"");
		$data['judulan']=$this->M_data->judulkegiatan($this->uri->segment(3,0));
		$data['judulapp']=$this->M_data->judulkegiatan($this->uri->segment(3,0))." | ".$this->M_data->titlesistem(1);
		$data['keyword']="agenda masyarakat, ".$this->M_data->keyword(1);
		$data['deskripsi']="agenda masyarakat ".$this->M_data->deskripsi(1);

		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";


		$data['judulappfooter']=$this->M_data->titlesistem(1);


		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentkegiatan';
		$this->load->view("v_datakirikanan",$data);
	}

}