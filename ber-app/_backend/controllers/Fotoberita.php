<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fotoberita extends CI_Controller {

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

function index()
    {

		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
		$query = $this->db->query("select count(*) as jml from fotoberita");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/fotoberita/index/';
        $config['total_rows'] = $jumlah;
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
		if($this->uri->segment(3) > 0)
			$offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
		else
			$offset = $this->uri->segment(3);
        $data['artikel'] = $this->M_dataadmin->indexfotoberita('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}
			//LOADING VIEW
			$data['vdata']='v_fotoberita';
		}
		else {
			$data['vdata']='access-denied';
		}

		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Foto Berita";
		$data['vnavigasi']='navigasi';
		$this->load->view('dashboard',$data);
    }

function add()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_fotoberita';
		}
		else {
			$data['vdata']='access-denied';
		}

		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Foto Berita";
		$data['vnavigasi']='navigasi';
		$this->load->view('dashboard',$data);
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editfotoberita($this->uri->segment(3,0));
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_fotoberita';
			}
			else {
				$data['vdata']='access-denied';
			}
		}
		else {
			$data['vdata']='access-denied';
		}
		$data['judulapp']="Edit Foto Berita";
		$data['vnavigasi']='navigasi';
		$this->load->view('dashboard',$data);
    }

function a_simpan()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
			$a=substr($this->input->post('tanggal'), 6,9);
			$b=substr($this->input->post('tanggal'), 3,2);
			$c=substr($this->input->post('tanggal'), 0,2);
			$tanggal=$a.'-'.$b.'-'.$c;
			$pathi=$a.'/'.$b.'/'.$c;
			$hariini=nama_hari($this->input->post('tanggal'));
			$jamsekarang = date("H:i:s");
			$inputdata=$this->input->post('inputdt');
			$id=$this->input->post('id');
			//$pathi = date('Y/m/d');
			if ($inputdata>1){
					$this->M_dataadmin->query_manual("insert into fotoberita (judul_fotoberita,
											id_fotoberita,
											keterangan,
											dibaca,
											tanggal,
											tgl_posting,
											aktif,
											jam,
											hari,
											username)
					values('".$this->input->post('judul')."',
											'".$id."',
											'".$this->input->post('keterangan')."',
											'1',
											'".$tanggal."',
											'".$tanggal."',
											'".$this->input->post('aktif')."',
											'".$jamsekarang."',
											'".$hariini."',
											'".$this->session->userdata('id_user')."')");

			for($i=1;$i<=$inputdata;$i++){
				$lokasi_file    = $_FILES['imagefile'.$i]['tmp_name'];
				$tipe_file      = $_FILES['imagefile'.$i]['type'];
				$nama_file      = $_FILES['imagefile'.$i]['name'];
				$acak           = rand(1,99);
				$filename = $acak.'-'.$nama_file;

				$upload_dir = '../foto_galeri/'.$pathi.'/';

				$keterangan=$this->input->post('keterangan'.$i);

				if (!empty($lokasi_file)){
				if ($tipe_file == "image/jpeg"){
					RmkDir($upload_dir, $mode = 0777);
					UploadFoto($filename,$upload_dir,1200,'imagefile'.$i);

					$this->M_dataadmin->query_manual("INSERT INTO gallery (id_fotoberita,
									username,
                                    keterangan,
                                    gbr_gallery,
									tanggal,
									tanggal_modif)
                            VALUES( '".$id."',
									'".$this->session->userdata('id_user')."',
									'".$keterangan."',
									'".$filename."',
									'".$tanggal."',
									'".$tanggal."')");

				}
				else {
					echo "File Harus Berformat .JPG";
				}
				}
			}

			}
			else {
				$this->M_dataadmin->query_manual("insert into fotoberita (judul_fotoberita,
											keterangan,
											id_fotoberita,
											dibaca,
											tanggal,
											tgl_posting,
											aktif,
											jam,
											hari,
											username)
					values('".$this->input->post('judul')."',
											'".$this->input->post('keterangan')."',
											'".$id."',
											'1',
											'".$tanggal."',
											'".$tanggal."',
											'".$this->input->post('aktif')."',
											'".$jamsekarang."',
											'".$hariini."',
											'".$this->session->userdata('id_user')."')");
			}
			$this->redirect();
		}
		else {
			$this->denied();
		}
    }

	function a_edit()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
			$kode=$this->input->post('id');
			$a=substr($this->input->post('tanggal'), 6,9);
			$b=substr($this->input->post('tanggal'), 3,2);
			$c=substr($this->input->post('tanggal'), 0,2);
			$tanggal=$a.'-'.$b.'-'.$c;

			$pathi = date('Y/m/d');

			$seo_judul=seo_link($this->input->post('judul'));
			$hariini=nama_hari($this->input->post('tanggal'));
			$jamsekarang = date("H:i:s");

			$inputdata=$this->input->post('inputdt');

			if ($inputdata>1){
				$this->M_dataadmin->query_manual("UPDATE fotoberita SET judul_fotoberita = '".$this->input->post('judul')."',
						keterangan = '".$this->input->post('keterangan')."',
						aktif = '".$this->input->post('aktif')."',
						tanggal = '".$tanggal."'
				WHERE id_fotoberita   = '".$kode."'");

			for($i=1;$i<=$inputdata;$i++){
				$lokasi_file    = $_FILES['imagefile'.$i]['tmp_name'];
				$tipe_file      = $_FILES['imagefile'.$i]['type'];
				$nama_file      = $_FILES['imagefile'.$i]['name'];
				$acak           = rand(1,99);
				$filename = $acak.'-'.$nama_file;

				$upload_dir = '../foto_galeri/'.$pathi.'/';

				$keterangan=$this->input->post('keterangan'.$i);

				if (!empty($lokasi_file)){
				if ($tipe_file == "image/jpeg"){
					RmkDir($upload_dir, $mode = 0777);
					UploadFoto($filename,$upload_dir,1200,'imagefile'.$i);

					$this->M_dataadmin->query_manual("INSERT INTO gallery (id_fotoberita,
									username,
                                    keterangan,
                                    gbr_gallery,
									tanggal,
									tanggal_modif)
                            VALUES( '".$kode."',
									'".$this->session->userdata('id_user')."',
									'".$keterangan."',
									'".$filename."',
									'".$tanggal."',
									'".$pathi."')");

				}
				else {
					echo "File Harus Berformat .JPG";
				}
				}
			}
			}
			else {
				$this->M_dataadmin->query_manual("UPDATE fotoberita SET judul_fotoberita = '".$this->input->post('judul')."',
						keterangan = '".$this->input->post('keterangan')."',
						aktif = '".$this->input->post('aktif')."',
						tanggal = '".$tanggal."'
				WHERE id_fotoberita   = '".$kode."'");
			}
			$this->redirect();
		}
		else {
			$this->denied();
		}
    }

	function delete()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
			$kode=$this->uri->segment(3,0);
			$query = $this->M_dataadmin->editfotoberita($this->uri->segment(3,0));
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {

						$query = $this->db->query("SELECT gbr_gallery,tanggal_modif FROM gallery WHERE id_fotoberita='".$kode."'");
						//$row = $query->row();
						$jumlaha = $query->num_rows();
						if ($jumlaha>0) {
							foreach($query->result_array() as $rr)
							{
								if ($rr['gbr_gallery']!=''){
									$pathi=$rr['tanggal_modif'];
									$pathdelete=str_replace("-","/",$pathi);
									unlink("../foto_galeri/".$pathdelete."/".$rr['gbr_gallery']);
									unlink("../foto_galeri/".$pathdelete."/small_".$rr['gbr_gallery']);
								}
							}
						}
						$this->M_dataadmin->query_manual("DELETE FROM fotoberita WHERE id_fotoberita='".$kode."'");
						$this->M_dataadmin->query_manual("DELETE FROM gallery WHERE id_fotoberita='".$kode."'");

			$this->redirect();

			}
			else {
				$this->denied();
			}

		}
		else {
			$this->denied();
		}
    }

	function deleteall()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
				$cek = $this->input->post('cek');
				$jumlah = count($cek);
				if(!empty($cek)){
				if ($leveluser=="admin") {
					for($i=0;$i<$jumlah;$i++){
						$query = $this->db->query("SELECT gbr_gallery,tanggal_modif FROM gallery WHERE id_fotoberita='".$cek[$i]."'");
						//$row = $query->row();
						$jumlaha = $query->num_rows();
						if ($jumlaha>0) {
							foreach($query->result_array() as $rr)
							{
								if ($rr['gbr_gallery']!=''){
									$pathi=$rr['tanggal_modif'];
									$pathdelete=str_replace("-","/",$pathi);
									unlink("../foto_galeri/".$pathdelete."/".$rr['gbr_gallery']);
									unlink("../foto_galeri/".$pathdelete."/small_".$rr['gbr_gallery']);
								}
							}
						}
						$this->M_dataadmin->query_manual("DELETE FROM fotoberita WHERE id_fotoberita='".$cek[$i]."'");
						$this->M_dataadmin->query_manual("DELETE FROM gallery WHERE id_fotoberita='".$cek[$i]."'");
					}
				}
				else {
					for($i=0;$i<$jumlah;$i++){
					$datahapus = $this->db->query("SELECT * FROM fotoberita WHERE username='".$this->session->userdata('id_user')."' and id_fotoberita='".$cek[$i]."'");
					$jml= $datahapus->num_rows();
					if ($jml>0) {
						$query = $this->db->query("SELECT gbr_gallery,tanggal_modif FROM gallery WHERE id_fotoberita='".$cek[$i]."'");
						//$row = $query->row();
						$jumlaha = $query->num_rows();
						if ($jumlaha>0) {
							foreach($query->result_array() as $rr)
							{
								if ($rr['gbr_gallery']!=''){
									$pathi=$rr['tanggal_modif'];
									$pathdelete=str_replace("-","/",$pathi);
									unlink("../foto_galeri/".$pathdelete."/".$rr['gbr_gallery']);
									unlink("../foto_galeri/".$pathdelete."/small_".$rr['gbr_gallery']);
								}
							}
						}
						$this->M_dataadmin->query_manual("DELETE FROM fotoberita WHERE id_fotoberita='".$cek[$i]."'");
						$this->M_dataadmin->query_manual("DELETE FROM gallery WHERE id_fotoberita='".$cek[$i]."'");
					}
					}
					//$this->M_dataadmin->query_manual("DELETE FROM fotoberita WHERE username='".$this->session->userdata('id_user')."' and id_fotoberita='".$cek[$i]."'");
				}
				}
				//REDIRECT AWAL
				$this->redirect();
		}
		else {
			$this->denied();
		}
    }

	function aktif()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") {
				$this->M_dataadmin->query_manual("UPDATE fotoberita SET aktif='Y' WHERE id_fotoberita=".$kode."");
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM fotoberita WHERE username='".$this->session->userdata('id_user')."' and id_fotoberita='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE fotoberita SET aktif='Y' WHERE id_fotoberita=".$kode."");
					$this->redirect();
				}
				else {
					$this->denied();
				}
			}
		}
		else {
			$this->denied();
		}
    }

	function nonaktif()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
			if ($leveluser=="admin") {
				$this->M_dataadmin->query_manual("UPDATE fotoberita SET aktif='N' WHERE id_fotoberita=".$kode."");
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM fotoberita WHERE username='".$this->session->userdata('id_user')."' and id_fotoberita='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE fotoberita SET aktif='N' WHERE id_fotoberita=".$kode."");
					$this->redirect();
				}
				else {
					$this->denied();
				}
			}
		}
		else {
			$this->denied();
		}
    }

		// S: AKTIF NON AKTIF KAN PILIHAN -------------------------------
	function aktifgallery()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
		$kode2=$this->uri->segment(4,0);
			if ($leveluser=="admin") {
				$this->M_dataadmin->query_manual("UPDATE gallery SET aktif='Y' WHERE id_gallery=".$kode."");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita/edit/".$kode2."'>";
			}
			else {
				$query = $this->db->query("SELECT * FROM gallery WHERE username='".$this->session->userdata('id_user')."' and id_fotoberita='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE gallery SET aktif='Y' WHERE id_gallery=".$kode."");
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita/edit/".$kode2."'>"; //$this->redirect();
				}
				else {
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita/edit/".$kode2."'>"; //$this->denied();
				}
			}
		}
		else {
			$this->denied();
		}
    }

	function nonaktifgallery()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
		$kode2=$this->uri->segment(4,0);
			if ($leveluser=="admin") {
				$this->M_dataadmin->query_manual("UPDATE gallery SET aktif='N' WHERE id_gallery=".$kode."");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita/edit/".$kode2."'>";
			}
			else {
				$query = $this->db->query("SELECT * FROM gallery WHERE username='".$this->session->userdata('id_user')."' and id_gallery='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE gallery SET aktif='N' WHERE id_gallery=".$kode."");
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita/edit/".$kode2."'>"; //$this->redirect();
				}
				else {
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita/edit/".$kode2."'>"; //$this->denied();
					//echo "<meta http-equiv='refresh' content='0; url=".base_url()."download/edit/".$kode."'>";
				}
			}
		}
		else {
			$this->denied();
		}
    }

	function hapusgallery()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
		$kode=$this->uri->segment(3,0);
		$kode2=$this->uri->segment(4,0);
			if ($leveluser=="admin") {
				//$this->M_dataadmin->query_manual("UPDATE gallery SET aktif='N' WHERE id_gallery=".$kode."");
				$query = $this->db->query("SELECT gbr_gallery,tanggal_modif FROM gallery WHERE id_gallery='".$kode."'");
				$row = $query->row();
				if ($row->gbr_gallery!=''){
					$pathi=$row->tanggal_modif;
					$pathdelete=str_replace("-","/",$pathi);
					unlink("../foto_galeri/".$pathdelete."/".$row->gbr_gallery);
					unlink("../foto_galeri/".$pathdelete."/small_".$row->gbr_gallery);
				}
				$this->M_dataadmin->query_manual("DELETE FROM gallery WHERE id_gallery='".$kode."'");

				echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita/edit/".$kode2."'>";
			}
			else {
				//$query = $this->db->query("SELECT * FROM gallery WHERE username='".$this->session->userdata('id_user')."' and id_gallery='".$kode."'");
				$query = $this->db->query("SELECT gbr_gallery,tanggal_modif FROM gallery WHERE username='".$this->session->userdata('id_user')."' and id_gallery='".$kode."'");
				$jumlah = $query->num_rows();
				$row = $query->row();

				if ($jumlah>0) {
					//$this->M_dataadmin->query_manual("UPDATE gallery SET aktif='N' WHERE id_gallery=".$kode."");
					if ($row->gbr_gallery!=''){
					$pathi=$row->tanggal_modif;
					$pathdelete=str_replace("-","/",$pathi);
					unlink("../foto_galeri/".$pathdelete."/".$row->gbr_gallery);
					unlink("../foto_galeri/".$pathdelete."/small_".$row->gbr_gallery);
				}
				$this->M_dataadmin->query_manual("DELETE FROM gallery WHERE id_gallery='".$kode."'");
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita/edit/".$kode2."'>";
				}
				else {
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita/edit/".$kode2."'>"; //$this->denied();
				}
			}
		}
		else {
			$this->denied();
		}
    }

	//////////E: AKTIF NON AKTIFKAN PILIHAN -------------------------------

	public function inputfoto () {
		$prop = $this->input->post('inputdt');
		?>
		<table width="100%">
		<?php
		for($li=1;$li<=$prop;$li++){ ?>
		<tr>
			<td width="80">Pilih Foto <? echo $li; ?></td>
			<td width="5">: </td><td>   <input type="file" name="imagefile<? echo $li; ?>"> </td>
		</tr>
		<tr>
			<td width="140">Keterangan Foto <? echo $li; ?></td>
			<td width="5">: </td><td> <div class="form-group" style="margin:10px 0;"><input value="" class="form-control" type="text" name="keterangan<? echo $li; ?>"></div></td>
		</tr>
		<?php
		}
		?>
		</table>
		<?php
	}

	public function denied () {
		$data['vdata']='access-denied';
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi';
		$this->load->view('dashboard',$data);
	}

	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."fotoberita'>";
	}


}

