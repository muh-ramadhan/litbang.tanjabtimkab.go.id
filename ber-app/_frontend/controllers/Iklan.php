<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iklan extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->library('pagination');
		$this->load->model("M_data");
	}
 
	public function show()
	{
		$query = $this->db->query("SELECT * FROM iklan WHERE aktif='Y' and id_halamaniklan=3 and id_posisiiklan=21 and urutan = ".$_REQUEST['id']);
		
		if (($query->num_rows())>0) {	
		
        foreach ($query->result() as $row) {
		
		$photopath = str_replace('-', '/', $row->tanggal_modif);
		if ($row->link!=null) {
			$contiklan="<a href='".$row->link."' target='_blank'> <img src='".base_url()."materi_iklan/".$photopath."/".$row->gambar."'  class='banner' style='margin-bottom:15px;'> </a>";
		} else {
			$contiklan="<img src='".base_url()."materi_iklan/".$photopath."/".$row->gambar."'  class='banner' style='margin-bottom:15px;'>";
		}
		}
		
		}
		/*
		else {
		 
			$contiklan = "<a href='http://bermultimedia.com' target='_blank'> <img src='http://bermultimedia.com/_link/iklan-2.jpg' width='300'> </a>";
		 	
		}
		*/
		echo $contiklan; 
		
        
		 
		
	}
	  
	 
}


