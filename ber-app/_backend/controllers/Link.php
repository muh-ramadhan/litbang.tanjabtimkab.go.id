<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

	function __construct(){ 
	parent::__construct();
		$this->load->helper(array('html','form','url','text',  'captcha','date','text_helper','permissionadmin')); 
		$this->load->library(array('recaptcha', 'form_validation'));
		$this->load->library('pagination'); 
		$this->load->model('M_dataadmin'); 
		$this->load->library('session'); 
		$this->load->helper('tgl_indonesia'); 
		$this->load->helper('combo');
		//$this->load->library("security"); 
		$this->load->helper('fungsi_seo');
		$this->load->helper('fungsi_thumb');
		$this->load->helper('fungsi_mkdir');
		$this->load->helper('fungsi_backup');
		is_logged_in();  
    }

   
	public function linkberita () {  
		 
		$prop = $this->input->post('prop'); 
		$string = $prop;
		$data = explode("-", $string);
		$prop1=$data[0];
		$prop2=$data[1];  
		if ($prop2==2) { 
		?> 
		<option value="0" selected>- Pilih Item Berita -</option> 
			<?php
			$dataa = $this->M_dataadmin->pilihberitakategori($prop1); 
			foreach($dataa->result_array() as $raw) {
			$photopath = str_replace('-', '/', $raw['tanggal_modif']);
			?> 
				<option  value="read/<?php echo $photopath;?>/<?php echo $raw['id_berita'];?>/<?php echo $raw['judul_seo'];?>"><?php echo $raw['judul'];?></option>
			<?php } ?>	 
		<?php } ?>		 
		<?php 
	}
	
	public function linkprodukhukum () {  
		$prop = $this->input->post('prop'); 
		$string = $prop;
		$data = explode("-", $string);
		$prop1=$data[0];
		$prop2=$data[1];  
		if ($prop2==2) { 
		?> 
		<option value="0" selected>- Pilih Item Produk Hukum -</option> 
			<?php
			$dataa = $this->M_dataadmin->pilihprodukhukumkategori($prop1); 
			foreach($dataa->result_array() as $raw) {
			$photopath = str_replace('-', '/', $raw['tanggal_modif']);
			?> 
				<option  value="peraturan/detail/<?php echo $raw['id_produkhukum'];?>/<?php echo seo_link($raw['judul']);?>"><?php echo $raw['judul'];?></option>
			<?php } ?>	 
		<?php } ?>		 
		<?php 
	}
	
	public function linkdokumen () {  
		$prop = $this->input->post('prop'); 
		$string = $prop;
		$data = explode("-", $string);
		$prop1=$data[0];
		$prop2=$data[1];  
		if ($prop2==2) { 
		?> 
		<option value="0" selected>- Pilih Item Dokumen -</option> 
			<?php
			$dataa = $this->M_dataadmin->pilihdokumenkategori($prop1); 
			foreach($dataa->result_array() as $raw) {
			$photopath = str_replace('-', '/', $raw['tanggal_modif']);
			?> 
				<option  value="dokumen/detail/<?php echo $raw['id_dokumen'];?>/<?php echo seo_link($raw['judul']);?>"><?php echo $raw['judul'];?></option>
			<?php } ?>	 
		<?php } ?>		 
		<?php 
	}
	
    
}
