<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polling extends CI_Controller {

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

		$data['judulapp']="Online Survey | ".$this->M_data->titlesistem(1);
		$data['judulan']="Online Survey Diskominfo Kab. Tanjung Jabung Timur";
		$data['keyword']="Online Survey, ".$this->M_data->titlesistem(1);
		$data['deskripsi']="Online Survey | ".$this->M_data->titlesistem(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";

		$data['judulappfooter']=$this->M_data->titlesistem(1);

		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentpolling';
		$this->load->view("v_datakirikanan",$data);
	}

	public function vote() {
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
		//$data["cariberita"]=$this->M_data->cariberita($kata);
		$query = $this->db->query("select rating from pollingpilihan where id_pollingpilihan='".$id_pilihan."' and id_polling='".$id_polling."'");
		foreach ($query->result() as $row) {
			$rowa = $row->rating;
		}
		$result=$this->M_data->simpanpolling($id_polling,$id_pilihan, $rowa);

		$data["pollingpilihan"]=$this->M_data->pollingpilihan($id_polling);

		$query = $this->db->query("select sum(rating) as jumlahdata from pollingpilihan where  aktif = 'Y' and id_polling='".$id_polling."'");
		foreach ($query->result() as $row) {
			$jumlahdata = $row->jumlahdata;
		}


		$data["jumlahdata"]=$jumlahdata;
		$data["pertanyaan"]=$pertanyaan;
		$data['judulan']="Online Survey Diskominfo Kab. Tanjung Jabung Timur";
		$data['judulapp']="Online Survey | ".$this->M_data->titlesistem(1);
		$data['keyword']="Online Survey | ".$this->M_data->titlesistem(1);
		$data['deskripsi']="Online Survey | ".$this->M_data->titlesistem(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";
		$data['judulappfooter']=$this->M_data->titlesistem(1);


		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentpolling';
		$this->load->view("v_datakirikanan",$data);
	}

	public function ambilpolling()
	{
		$data = $this->M_data->ambil_semua_polling();

        //         //data to json

		$responce->cols[] = array(
			"id" => "",
			"label" => "Topping",
			"pattern" => "",
			"type" => "string"
		);
		$responce->cols[] = array(
			"id" => "",
			"label" => "Total",
			"pattern" => "",
			"type" => "number"
		);
		foreach($data as $cd)
		{
			$responce->rows[]["c"] = array(
				array(
					"v" => "$cd->pilihan",
					"f" => null
				) ,
				array(
					"v" => (int)$cd->rating,
					"f" => null
				)
			);
		}

		echo json_encode($responce);
	}



}



