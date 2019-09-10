<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Telpon extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from telpon where  aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/telpon/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
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
        $data['artikel'] = $this->M_data->alltelpon($config['per_page'], $this->uri->segment(3));
		$data['deskripsi']="Telpon Penting | ".$this->M_data->titlesistem(1);
		$data['judulapp']="Semua Telpon Penting | ".$this->M_data->titlesistem(1);
		$data['judulan']="Semua Telpon Penting";
		$data['keyword']="telpon penting polres kolaka, ".$this->M_data->titlesistem(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";

		$data['judulappfooter']=$this->M_data->titlesistem(1);


		$data['kategori'] = $this->M_data->tampil_kategori()->result();

		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contenttelponall';
		$this->load->view("v_datakirikanan",$data);
}


}