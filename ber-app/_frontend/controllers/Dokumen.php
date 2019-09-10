<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("M_data");
		$this->load->helper('tgl_indonesia');
		$this->load->helper('fungsi_seo');
		$this->load->helper('fungsi_sizeunit');



	}
	public function index ()
	{
		$data['deskripsi']="Dokumen - ".$this->M_data->titlesistem(1);
		$data['judulapp']="Dokumen | ".$this->M_data->titlesistem(1);
		$data['judulan']="Dokumen ";
		$data["katdokumen"]=$this->M_data->katdokumen();
		$data['keyword']=$this->M_data->keyword(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";

		$data['judulappfooter']=$this->M_data->titlesistem(1);


		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_dok_index';
		$this->load->view("v_datakirikanan",$data);

	}


	public function detail ()
	{
		$data['detail_berita']=$this->M_data->iddokumen($this->uri->segment(3,0));
		$data['menu'] = $this->M_data->getMenu2(2,"");
		$data['judulan']=$this->M_data->juduldokumen($this->uri->segment(3,0));
		$data['judulapp']=$this->M_data->juduldokumen($this->uri->segment(3,0))." | ".$this->M_data->deskripsi(1);
		$data['deskripsi']=$this->M_data->juduldokumen($this->uri->segment(3,0))." | ".$this->M_data->deskripsi(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";

		$data['judulappfooter']=$this->M_data->titlesistem(1);

		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_dok_detail';
		$this->load->view("v_datakirikanan",$data);
	}

	public function kategori ($id='')
	{
		$query = $this->db->query("select count(*) as jml from dokumen where id_katdokumen = '".$id."' and aktif='Y'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/dokumen/kategori/'.$id.'/';
        $config['total_rows'] = $row;
        $config['per_page'] = 15;
        $config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['next_link']='Berikutnya &gt;';
		$config['prev_link']='&lt; Sebelumnya';
        $this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();

		if($this->uri->segment(4) > 0)
			$offset = ($this->uri->segment(4) + 0)*$config['per_page'] - $config['per_page'];
		else
			$offset = $this->uri->segment(4);
        $data['artikel'] = $this->M_data->getdokumenkat($id, $config['per_page'], $offset);
		$data['deskripsi']="Dokumen: ".$this->M_data->judulkatdokumen($this->uri->segment(3,0))." | ".$this->M_data->deskripsi(1);
		$data['judulan']=$this->M_data->judulkatdokumen($this->uri->segment(3,0));
		$data['judulapp']="Kategori Dokumen: ".$this->M_data->judulkatdokumen($this->uri->segment(3,0))." | ". $this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";

		$data['judulappfooter']=$this->M_data->titlesistem(1);

		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_dok_kategori';
		$this->load->view("v_datakirikanan",$data);
	}


}



