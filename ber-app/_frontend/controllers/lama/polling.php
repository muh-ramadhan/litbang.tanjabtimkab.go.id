<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class polling extends CI_Controller {

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
		
		$query = $this->db->query("select id_polling,pertanyaan from polling where publish='Y' order by id_polling desc limit 1");
        foreach ($query->result() as $row) {
            $rowidpolling = $row->id_polling;
			$pertanyaan = $row->pertanyaan;
        }
		$query = $this->db->query("select id_pollingpilihan from pollingpilihan where publish='Y' and id_polling='".$rowidpolling."' order by id_pollingpilihan asc limit 1");
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
		$data["pollingpilihan"]=$this->m_data->pollingpilihan($id_polling);
		
		$query = $this->db->query("select sum(rating) as jumlahdata from pollingpilihan where  publish = 'Y' and id_polling='".$id_polling."'");
        foreach ($query->result() as $row) {
            $jumlahdata = $row->jumlahdata;
        }
		  
        $data["jumlahdata"]=$jumlahdata;
		$data["pertanyaan"]=$pertanyaan; 
		
		$data['judulapp']="Online Survey | ".$this->m_data->titlesistem(1);
		$data['judulan']="Online Survey KPU Provinsi Jambi";
		$data['keyword']="Online Survey, ".$this->m_data->titlesistem(1);
		$data['deskripsi']="Online Survey | ".$this->m_data->titlesistem(1);
		$data['postingby']="Admin KPU Provinsi Jambi"; 
		
		/** s:head **/
		$data['menu'] = $this->m_data->getMenu2(2,""); 
		$data['menuside'] = $this->m_data->getMenu1(2,""); 
		$data["slideimage"]=$this->m_data->slideimage(5);
		$data["menubottom"]=$this->m_data->ambilmenu(4); 
		/** e:head **/
		
		$data["pollingan"]=$this->m_data->pollingan("");
		$data["pengumuman"]=$this->m_data->pengumuman(4);
		$data["weblink"]=$this->m_data->weblink(4);
		$data["agenda"]=$this->m_data->jadwalkegiatan(3);
		$data["beritaterbaru"]=$this->m_data->beritaterbaru(5);
		$data["fotokolom"]=$this->m_data->fotokolom(0,4);
		$data["terpopuler"]=$this->m_data->beritaterpopuler(5);
		$data["pengaduan"]=$this->m_data->pengaduan(5);
		$data["telppenting"]=$this->m_data->telppenting(10); 
		 
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		
		
		
		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentpolling';
		$this->load->view("v_datakirikanan",$data);  
	}
	
	
	
	public function vote() {
		$query = $this->db->query("select id_polling,pertanyaan from polling where publish='Y' order by id_polling desc limit 1");
        foreach ($query->result() as $row) {
            $rowidpolling = $row->id_polling;
			$pertanyaan = $row->pertanyaan;
        }
		$query = $this->db->query("select id_pollingpilihan from pollingpilihan where publish='Y' and id_polling='".$rowidpolling."' order by id_pollingpilihan asc limit 1");
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
		//$data["cariberita"]=$this->m_data->cariberita($kata);	
		$query = $this->db->query("select rating from pollingpilihan where id_pollingpilihan='".$id_pilihan."' and id_polling='".$id_polling."'");
        foreach ($query->result() as $row) {
            $rowa = $row->rating;
        }
		$result=$this->m_data->simpanpolling($id_polling,$id_pilihan, $rowa);
		
		$data["pollingpilihan"]=$this->m_data->pollingpilihan($id_polling);
		
		$query = $this->db->query("select sum(rating) as jumlahdata from pollingpilihan where  publish = 'Y' and id_polling='".$id_polling."'");
        foreach ($query->result() as $row) {
            $jumlahdata = $row->jumlahdata;
        }
		 
		
        $data["jumlahdata"]=$jumlahdata;
		$data["pertanyaan"]=$pertanyaan;  
		$data['judulan']="Online Survey KPU Provinsi Jambi";
		$data['judulapp']="Online Survey | ".$this->m_data->titlesistem(1);
		$data['keyword']="Online Survey | ".$this->m_data->titlesistem(1);
		$data['deskripsi']="Online Survey | ".$this->m_data->titlesistem(1); 
		$data['postingby']="Admin KPU Provinsi Jambi"; 
		
		/** s:head **/
		$data['menu'] = $this->m_data->getMenu2(2,""); 
		$data['menuside'] = $this->m_data->getMenu1(2,""); 
		$data["slideimage"]=$this->m_data->slideimage(5);
		$data["menubottom"]=$this->m_data->ambilmenu(4); 
		/** e:head **/
		
		$data["pollingan"]=$this->m_data->pollingan("");
		$data["pengumuman"]=$this->m_data->pengumuman(4);
		$data["weblink"]=$this->m_data->weblink(4);
		$data["agenda"]=$this->m_data->jadwalkegiatan(3);
		$data["beritaterbaru"]=$this->m_data->beritaterbaru(5);
		$data["fotokolom"]=$this->m_data->fotokolom(0,4);
		$data["terpopuler"]=$this->m_data->beritaterpopuler(5);
		$data["pengaduan"]=$this->m_data->pengaduan(5);
		$data["telppenting"]=$this->m_data->telppenting(10); 
		 
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
		
		
		
		$data['vkanan']='v_kanan1';
		$data['vheader']='v_header';
		$data['vfooter']='v_footer';
		$data['vdata']='v_contentpolling';
		$this->load->view("v_datakirikanan",$data);
	}
	
	
}



