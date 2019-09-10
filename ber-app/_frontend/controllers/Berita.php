<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from berita where aktif = 'Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/berita/index/';
        $config['total_rows'] = $row;
        $config['per_page'] = 5;
        $config['uri_segment'] = 1;
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
        $data['artikel'] = $this->M_data->allberita($config['per_page'], $offset);
		$data['postingby']="Diskominfo Kab. Tanjung Jabung Timur";
		$data['judulapp']="Semua Berita ".$this->M_data->titlesistem(1);
		$data['judulappfooter']=$this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['deskripsi']=$this->M_data->deskripsi(1);
		$data['judulan']="Semua Berita";
		$data['kategori'] = $this->M_data->tampil_kategori()->result();


		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentberitaall';
		$this->load->view("v_datakirikanan",$data);
	//	$this->load->view("v_test_index",$data);

	}


	public function detail ()
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
        $config['per_page'] = 5;
        $config['uri_segment'] = 1;
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
		$data['judulapp']=$this->M_data->judulberita($this->uri->segment(3,0))." | ".$this->M_data->titlesistem(1);
		$data['judulappfooter']=$this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->judulberita($this->uri->segment(3,0)).", ".$this->M_data->keyword(1);
		$data['deskripsi']=character_limiter(strip_tags($this->M_data->deskripsiberita($this->uri->segment(3,0))), 500);
		//character_limiter($this->M_data->deskripsiberita($this->uri->segment(3,0)), 500);
		$data['detail_berita']=$this->M_data->idberita($this->uri->segment(3,0));
		$data['judulan']=$this->M_data->judulan($this->uri->segment(3,0));
		$data['kategori'] = $this->M_data->tampil_kategori()->result();


		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_beritadetail';
		$this->load->view("v_datakirikanan",$data);
	}

	public function pdf ($id='')
	{
		$this->load->library('PDF_MC_Table');
		$query = $this->db->query('SELECT * FROM berita WHERE id_berita="'.$id.'";');
		$row = $query->row();
		if ($query->num_rows() > 0) {
				$data['ada']=1;
				//$data['kategori']=$row->id_kategorilaporan;
				//$data['tahun']=$row->tahun;
				//$data['bulan']=$row->triwulan;
				$data['idberita']=$id;
			}
			else {
				$data['ada']=0;
		}

		$data['judulapp']=$this->M_data->judulberita($this->uri->segment(3,0))." | ".$this->M_data->titlesistem(1);
		$data['detail_berita']=$this->M_data->idberita($this->uri->segment(3,0));
		//$data['detail']=$this->M_data->idkependudukan($this->uri->segment(3,0));
		$this->load->view("v_pdf",$data);
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
        $config['per_page'] = 5;
        $config['uri_segment'] = 1;
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
        $data['artikel'] = $this->M_data->getberitakat($id, $config['per_page'], $offset);
		$data['judulapp']=$this->M_data->judul($id)." | ".$this->M_data->titlesistem(1) ;
		$data['judulappfooter']=$this->M_data->titlesistem(1);
		$data['deskripsi']=character_limiter(strip_tags($this->M_data->deskripsiberita($this->uri->segment(3,0))), 500);
		$data['keyword']=$this->M_data->judulberita($id).", ".$this->M_data->keyword(1);
		$data['judulan']=$this->M_data->judul($id);
		$data['kategori_berita']=$this->M_data->katberita($this->uri->segment(3,0));
		$data['kategori'] = $this->M_data->tampil_kategori()->result();

		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentberita';
		$this->load->view("v_datakirikanan",$data);
	//	$this->load->view("v_berita",$data);
	}


	public function cariberita() {
		$kata = trim($this->input->POST('kata'));
		$data['kata']=$kata;


		$data["cariberita"]=$this->M_data->cariberita($kata);
		$data['judulapp']="Pencarian Berita | ".$this->M_data->titlesistem(1) ;
		$data['deskripsi']=$this->M_data->deskripsi(1);
		$data['keyword']= $this->M_data->keyword(1);
		$data['postingby']="Staff Kec. Telanaipura - Pemeritah Kota Jambi";
		$data['judulan']="Semua Berita";


		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentcariberita';
		$this->load->view("v_datakirikanan",$data);
	}


}



