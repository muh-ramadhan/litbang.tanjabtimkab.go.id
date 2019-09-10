<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from artikel where aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/artikel/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 5;
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
        $data['artikel'] = $this->M_data->allartikel($config['per_page'], $offset);
		$data['postingby']="Diskominfo Kab. Tanjung Jabung Timur";
		$data['judulapp']="Semua Artikel ".$this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['deskripsi']=$this->M_data->deskripsi(1);
		$data['judulan']="Semua Artikel";


		$data['kategori'] = $this->M_data->tampil_kategori()->result();
		$data['judulappfooter']=$this->M_data->titlesistem(1);


		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentartikelall';
		$this->load->view("v_datakirikanan",$data);
	}


	public function detail ()
	{
		$data['judulapp']=$this->M_data->judulartikel($this->uri->segment(3,0))." | ".$this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->judulartikel($this->uri->segment(3,0)).", ".$this->M_data->keyword(1);
		$data['deskripsi']=character_limiter(strip_tags($this->M_data->deskripsiartikel($this->uri->segment(3,0))), 500);
		//character_limiter($this->M_data->deskripsiartikel($this->uri->segment(3,0)), 500);
		$data['detail_artikel']=$this->M_data->idartikel($this->uri->segment(3,0));
		$data['judulan']=$this->M_data->judulan($this->uri->segment(3,0));

		$data['kategori'] = $this->M_data->tampil_kategori()->result();
		$data['judulappfooter']=$this->M_data->titlesistem(1);

		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentartikel';
		$this->load->view("v_datakirikanan",$data);
	}

	public function pdf ($id='')
	{
		$this->load->library('PDF_MC_Table');
		$query = $this->db->query('SELECT * FROM artikel WHERE id_artikel="'.$id.'";');
		$row = $query->row();
		if ($query->num_rows() > 0) {
				$data['ada']=1;
				//$data['kategori']=$row->id_kategorilaporan;
				//$data['tahun']=$row->tahun;
				//$data['bulan']=$row->triwulan;
				$data['idartikel']=$id;
			}
			else {
				$data['ada']=0;
		}

		$data['judulapp']=$this->M_data->judulartikel($this->uri->segment(3,0))." | ".$this->M_data->titlesistem(1);
		$data['detail_artikel']=$this->M_data->idartikel($this->uri->segment(3,0));
		//$data['detail']=$this->M_data->idkependudukan($this->uri->segment(3,0));
		$this->load->view("v_pdf",$data);
	}



}



