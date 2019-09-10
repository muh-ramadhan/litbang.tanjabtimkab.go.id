<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from kegiatan");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/kegiatan/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexkegiatan('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		}

			//LOADING VIEW
			$data['vdata']='v_kegiatan';
		}
		else {
			$data['vdata']='access-denied';
		}

		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Jadwal Kegiatan";
		$data['vnavigasi']='navigasi';
		$this->load->view('dashboard',$data);
    }

function add()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_kegiatan';
		}
		else {
			$data['vdata']='access-denied';
		}

		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Jadwal Kegiatan";
		$data['vnavigasi']='navigasi';
		$this->load->view('dashboard',$data);
    }

function edit()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editkegiatan($this->uri->segment(3,0));
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_kegiatan';
			}
			else {
				$data['vdata']='access-denied';
			}
		}
		else {
			$data['vdata']='access-denied';
		}
		$data['judulapp']="Edit Jadwal Kegiatan";
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
			$tglsekarang=date('Y-m-d');

			$seo_judul=seo_link($this->input->post('nama_kegiatan'));
			$this->M_dataadmin->query_manual("insert into kegiatan (namakegiatan,
											tgl_kegiatan,
											waktu,
											tempat,
											perihal,
											tgl_upload,
											jadwalkegiatan,
											username,
											aktif)
								values('".$this->input->post('judul')."',
											'".$tanggal."',
											'".$this->input->post('waktu')."',
											'".$this->input->post('tempat')."',
											'".$this->input->post('perihal')."',
											'".$tglsekarang."',
											'".$this->input->post('keterangan')."',
											'".$this->session->userdata('id_user')."',
											'".$this->input->post('aktif')."')");

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
			$seo_judul=seo_link($this->input->post('nama_kegiatan'));
			$a=substr($this->input->post('tanggal'), 6,9);
			$b=substr($this->input->post('tanggal'), 3,2);
			$c=substr($this->input->post('tanggal'), 0,2);
			$tanggal=$a.'-'.$b.'-'.$c;

			$this->M_dataadmin->query_manual("UPDATE kegiatan SET namakegiatan = '".$this->input->post('judul')."',
						tgl_kegiatan  = '".$tanggal."',
						waktu = '".$this->input->post('waktu')."',
						tempat = '".$this->input->post('tempat')."',
						perihal = '".$this->input->post('perihal')."',
						jadwalkegiatan = '".$this->input->post('keterangan')."',
						aktif = '".$this->input->post('aktif')."'
				WHERE id_kegiatan   = '".$kode."'");
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
				$this->M_dataadmin->query_manual("UPDATE kegiatan SET aktif='Y' WHERE id_kegiatan=".$kode."");
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM kegiatan WHERE username='".$this->session->userdata('id_user')."' and id_kegiatan='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE kegiatan SET aktif='Y' WHERE id_kegiatan=".$kode."");
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
				$this->M_dataadmin->query_manual("UPDATE kegiatan SET aktif='N' WHERE id_kegiatan=".$kode."");
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM kegiatan WHERE username='".$this->session->userdata('id_user')."' and id_kegiatan='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE kegiatan SET aktif='N' WHERE id_kegiatan=".$kode."");
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

	function delete()
    {
		$leveluser = trim($this->session->userdata('level'));
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id'));
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editkegiatan($this->uri->segment(3,0));
			$row = $query->row();
			$kode=$this->uri->segment(3,0);
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$this->M_dataadmin->query_manual("DELETE FROM kegiatan WHERE id_kegiatan='".$kode."'");
				$this->redirect();
			}
			else {
				$this->denied();
			}

			$this->redirect();
			}
		else {
			$this->denied();
		}
    }

	public function denied () {
		$data['vdata']='access-denied';
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi';
		$this->load->view('dashboard',$data);
	}

	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."kegiatan'>";
	}
}

