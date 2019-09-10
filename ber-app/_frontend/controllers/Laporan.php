<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
		$data['deskripsi']="LAPORAN INFO PUBLIK - ".$this->M_data->titlesistem(1);
		$data['judulapp']="LAPORAN INFO PUBLIK | ".$this->M_data->titlesistem(1);
		$data['judulan']="LAPORAN INFO PUBLIK";
		$data["katlaporan"]=$this->M_data->katlaporan();
		$data['keyword']=$this->M_data->keyword(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";

		/** s:head **/
		$data['menu'] = $this->M_data->getMenu2(2,"");
		$data['menuside'] = $this->M_data->getMenu1(2,"");
		$data["slideimage"]=$this->M_data->slideimage(5);
		$data["menubottom"]=$this->M_data->ambilmenu(4);
		/** e:head **/

		$data["pollingan"]=$this->M_data->pollingan("");
		$data["pengumuman"]=$this->M_data->pengumuman(4);
		$data["weblink"]=$this->M_data->weblink(4);
		$data["agenda"]=$this->M_data->jadwalkegiatan(3);
		$data["beritaterbaru"]=$this->M_data->beritaterbaru(5);
		$data["fotokolom"]=$this->M_data->fotokolom(0,4);
		$data["terpopuler"]=$this->M_data->beritaterpopuler(10);
		$data["pengaduan"]=$this->M_data->pengaduan(5);
		$data["telppenting"]=$this->M_data->telppenting(10);

















		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentlaporan';
		$this->load->view("v_datakirikanan",$data);

	}


	public function detail ()
	{
		$data['detail_berita']=$this->M_data->idlaporan($this->uri->segment(3,0));
		$data['menu'] = $this->M_data->getMenu2(2,"");
		$data['judulan']=$this->M_data->judullaporan($this->uri->segment(3,0));
		$data['judulapp']=$this->M_data->judullaporan($this->uri->segment(3,0))." | ".$this->M_data->deskripsi(1);
		$data['deskripsi']=$this->M_data->judullaporan($this->uri->segment(3,0))." | ".$this->M_data->deskripsi(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";

		/** s:head **/
		$data['menu'] = $this->M_data->getMenu2(2,"");
		$data['menuside'] = $this->M_data->getMenu1(2,"");
		$data["slideimage"]=$this->M_data->slideimage(5);
		$data["menubottom"]=$this->M_data->ambilmenu(4);
		/** e:head **/

		$data["pollingan"]=$this->M_data->pollingan("");
		$data["pengumuman"]=$this->M_data->pengumuman(4);
		$data["weblink"]=$this->M_data->weblink(4);
		$data["agenda"]=$this->M_data->jadwalkegiatan(3);
		$data["beritaterbaru"]=$this->M_data->beritaterbaru(5);
		$data["fotokolom"]=$this->M_data->fotokolom(0,4);
		$data["terpopuler"]=$this->M_data->beritaterpopuler(10);
		$data["pengaduan"]=$this->M_data->pengaduan(5);
		$data["telppenting"]=$this->M_data->telppenting(10);

















		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentlaporan';
		$this->load->view("v_datakirikanan",$data);
	}

	public function kategori ($id='')
	{
		$query = $this->db->query("select count(*) as jml from laporan where  aktif='Y' and id_katlaporan = '".$id."'");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url().'/laporan/kategori/'.$id.'/';
        $config['total_rows'] = $row;
        $config['per_page'] = 15;
        $config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['next_link']='Berikutnya &gt;';
		$config['prev_link']='&lt; Sebelumnya';
        $this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();

		if($this->uri->segment(3) > 0)
			$offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
		else
			$offset = $this->uri->segment(3);
        $data['artikel'] = $this->M_data->getlaporankat($id,$config['per_page'], $offset);
		$data['deskripsi']="Laporan: ".$this->M_data->judulkatlaporan($this->uri->segment(3,0))." | ".$this->M_data->deskripsi(1);
		$data['judulan']=$this->M_data->judulkatlaporan($this->uri->segment(3,0));
		$data['judulapp']="Kategori Laporan: ".$this->M_data->judulkatlaporan($this->uri->segment(3,0))." | ". $this->M_data->titlesistem(1);
		$data['keyword']=$this->M_data->keyword(1);
		$data['postingby']="Admin Diskominfo Kab. Tanjung Jabung Timur";

		/** s:head **/
		$data['menu'] = $this->M_data->getMenu2(2,"");
		$data['menuside'] = $this->M_data->getMenu1(2,"");
		$data["slideimage"]=$this->M_data->slideimage(5);
		$data["menubottom"]=$this->M_data->ambilmenu(4);
		/** e:head **/

		$data["pollingan"]=$this->M_data->pollingan("");
		$data["pengumuman"]=$this->M_data->pengumuman(4);
		$data["weblink"]=$this->M_data->weblink(4);
		$data["agenda"]=$this->M_data->jadwalkegiatan(3);
		$data["beritaterbaru"]=$this->M_data->beritaterbaru(5);
		$data["fotokolom"]=$this->M_data->fotokolom(0,4);
		$data["terpopuler"]=$this->M_data->beritaterpopuler(10);
		$data["pengaduan"]=$this->M_data->pengaduan(5);
		$data["telppenting"]=$this->M_data->telppenting(10);

















		$data['vkanan']='v_kanan2';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentlaporan';
		$this->load->view("v_datakirikanan",$data);
	}


}



