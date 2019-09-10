<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("M_data");
		$this->load->helper('tgl_indonesia');
		$this->load->helper('fungsi_seo');
	}

	public function index()
	{
		$data['keyword']=$this->M_data->keyword(1);
		$data['judulapp']=$this->M_data->titlesistem(1);
		$data['deskripsi']=$this->M_data->deskripsi(1);
		$data['judulappfooter']=$this->M_data->titlesistem(1);


		$data['jumlah_kegiatan'] = $this->M_data->jumlahkegiatan();
		$data['jumlah_artikel'] = $this->M_data->jumlahartikel();
		$data['jumlah_berita'] = $this->M_data->jumlahbertia();
		$data['jumlah_pengumuman'] = $this->M_data->jumlahpengumuman();

		/* s:polling */
		$query = $this->db->query("select id_polling,pertanyaan from polling where aktif='Y' order by id_polling desc limit 1");
        foreach ($query->result() as $row) {
            $rowidpolling = $row->id_polling;
			$pertanyaan = $row->pertanyaan;
        }
		$query = $this->db->query("select id_pollingpilihan from pollingpilihan where aktif='Y' and id_polling='".$rowidpolling."' order by id_pollingpilihan asc limit 1");
        foreach ($query->result() as $row) {
            $rowidpollingpilihan = $row->id_pollingpilihan;
        }

		$id_polling = $this->input->POST('idpolling');
		$id_pilihan = $this->input->POST('pilihan');
		if ($id_pilihan=='')
		{
		$id_pilihan=$rowidpollingpilihan;
		}
		if ($id_polling=='')
		{
		$id_polling=$rowidpolling;
		}

		$query = $this->db->query("select rating from pollingpilihan where id_pollingpilihan='".$id_pilihan."' and id_polling='".$id_polling."'");
        foreach ($query->result() as $row) {
            $rowa = $row->rating;
        }
		$data["pollingpilihan"]=$this->M_data->pollingpilihan($id_polling);

		$query = $this->db->query("select sum(rating) as jumlahdata from pollingpilihan where  aktif = 'Y' and id_polling='".$id_polling."'");
        foreach ($query->result() as $row) {
            $jumlahdata = $row->jumlahdata;
        }
		 $data["jumlahdata"]=$jumlahdata;
		$data["pertanyaan"]=$pertanyaan;

		/* e:polling */



	//	$data['vkanan']='v_kanan';
	//	$data['vkiri']='v_kiri';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$this->load->view("v_home",$data);
	}

	function map()
    {
		//$nama = $this->input->post('nama',TRUE);
		$rows = $this->M_data->telpon(5);
		$json_array = array();
		foreach ($rows as $row)
		$json_array[]=$row->telpon;
		echo json_encode($json_array);
    }


}