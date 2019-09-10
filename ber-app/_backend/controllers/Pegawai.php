<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

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
		$query = $this->db->query("select count(*) as jml from pegawai");
        foreach ($query->result() as $row) {
            $jumlah = $row->jml;
        }
        $config['base_url'] = base_url().'/pegawai/index/';
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
        $data['artikel'] = $this->M_dataadmin->indexpegawai('', $config['per_page'], $offset);
		if ($this->uri->segment(3)==null) {
			$page=0;
		}
		else {
			$page=$this->uri->segment(3);
		} 
			//LOADING VIEW
			$data['vdata']='v_pegawai';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Data Pegawai";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    } 

function add()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$data['vdata']='v_pegawai';
		}
		else {
			$data['vdata']='access-denied'; 
		}
		
		//$data['vdata']='v_identitas';
		$data['judulapp']="Tambah Pegawai";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
function edit()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			$query = $this->M_dataadmin->editpegawai($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
				$data['vdata']='v_pegawai';
			}
			else {
				$data['vdata']='access-denied'; 
			}
		}
		else {
			$data['vdata']='access-denied'; 
		} 
		$data['judulapp']="Edit Pegawai";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);	 
    }
	
function a_simpan()
    {
		$leveluser = trim($this->session->userdata('level')); 
		$cek = permissionadmin($this->uri->segment(1,0),$this->session->userdata('session_id')); 
		if ($leveluser=="admin" or $cek==1)
		{
			
		/** S:CEK DATA **/  
		/*
		$this->form_validation->set_rules('judul', 'lang:Judul Pegawai', 'required');
        $this->form_validation->set_rules('isi_pegawai', 'lang:Isi Pegawai', 'required'); 
		
		if($this->form_validation->run() == TRUE)
        { 
		
		}
		else {
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."pegawai/add'>";
		}
		*/	
		/** E:CEK DATA **/ 
		
			$a=substr($this->input->post('tanggal'), 6,9);
			$b=substr($this->input->post('tanggal'), 3,2);
			$c=substr($this->input->post('tanggal'), 0,2);
			$tanggal=$a.'-'.$b.'-'.$c;
			$pathi=$a.'/'.$b.'/'.$c;
			$seo_judul=seo_link($this->input->post('judul'));
			$hariini=nama_hari($this->input->post('tanggal'));
			$jamsekarang = date("H:i:s");
			
			/* s: property gambar */
			$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../foto_pegawai/'.$pathi.'/';
			
			if ($this->input->post('lahir_none')=="Y") {
				$no_lahir="Y";
				$tgl_lahir="0000-00-00";
			}
			else {
				$no_lahir="N";
				$tgl_lahir=$this->input->post('thn_lahir').'-'.$this->input->post('bln_lahir').'-'.$this->input->post('tgl_lahir'); 
			}
			
			if ($this->input->post('pangkat_none')=="Y") {
				$no_pangkat="Y";
				$tmtpangkat="0000-00-00";
			}
			else {
				$no_pangkat="N";
				$tmtpangkat=$this->input->post('tmttahunpangkat').'-'.$this->input->post('tmtbulanpangkat').'-'.$this->input->post('tmttanggalpangkat'); 
			} 
			if ($this->input->post('jabatan_none')=="Y") {
				$no_jabatan="Y";
				$tmtjabatan="0000-00-00";
			}
			else {
				$no_jabatan="N";
				$tmtjabatan=$this->input->post('tmttahunjabatan').'-'.$this->input->post('tmtbulanjabatan').'-'.$this->input->post('tmttanggaljabatan'); 
			} 
			if ($this->input->post('latihan_none')=="Y") {
				$no_latihan="Y";
				$bulanlatihan="00";
				$tahunlatihan="0000";
			}
			else {
				$no_latihan="N";
				$bulanlatihan=$this->input->post('bulanlatihan');
				$tahunlatihan=$this->input->post('tahunlatihan'); 
			} 
			/* e: property gambar */   
	 
			
			if (!empty($lokasi_file)){ 
			if ($tipe_file == "image/jpeg"){
			/* s: property gambar */
			RmkDir($upload_dir, $mode = 0777); 
			UploadFoto($filename,$upload_dir,400,'imagefile'); 
			/* e: property gambar */  
			$this->M_dataadmin->query_manual("insert into pegawai (nama_pegawai,
                                   nip,  
                                   tempat,
								   aktif,
								   tgl_lahir,
								   kelamin,
                                   alamat,
                                   id_pangkat,
								   tmtpangkat,
								   id_jabatan,
								   tmtjabatan,
								   masa_tahun,
								   masa_bulan,
								   namalatihan,
								   bulanlatihan,
								   tahunlatihan,
								   no_tgl_lahir,
								   no_tmtpangkat,
								   no_tmtjabatan,
								   no_latihan,
								   pendidikan,
								   tahun_lulus,
								   id_tingkat,
								   mutasi,
								   gambar,
								   keterangan,
								   tgl_modif,
								   tgl_upload)
							values('".$this->input->post('namapegawai')."', 
                                   '".$this->input->post('nip')."', 
                                   '".$this->input->post('tempatlahir')."', 
								   'Y',
								   '".$tgl_lahir."', 
								   '".$this->input->post('kelamin')."',
                                   '".$this->input->post('alamat')."',
                                   '".$this->input->post('pangkat')."',
								   '".$tmtpangkat."',
								   '".$this->input->post('jabatan')."',
								   '".$tmtjabatan."',
								   '".$this->input->post('masakerjatahun')."',
								   '".$this->input->post('masakerjabulan')."',
								   '".$this->input->post('namalatihan')."',
								   '".$bulanlatihan."',
								   '".$tahunlatihan."',
								   '".$no_lahir."',
								   '".$no_pangkat."',
								   '".$no_jabatan."',
								   '".$no_latihan."',
								   '".$this->input->post('pend')."',
								   '".$this->input->post('tahunlulus')."',
								   '".$this->input->post('tingkat')."',
								   '".$this->input->post('mutasi')."',
								   '".$filename."',
								   '".$this->input->post('keterangan')."',
								   '".$tanggal."',
								   '".$tanggal."')");  
			}
			else {
				echo "File Harus Berformat .JPG";
			}
			}
			else {
			$this->M_dataadmin->query_manual("insert into pegawai (nama_pegawai,
                                   nip,  
                                   tempat,
								   aktif,
								   tgl_lahir,
								   kelamin,
                                   alamat,
                                   id_pangkat,
								   tmtpangkat,
								   id_jabatan,
								   tmtjabatan,
								   masa_tahun,
								   masa_bulan,
								   namalatihan,
								   bulanlatihan,
								   tahunlatihan,
								   no_tgl_lahir,
								   no_tmtpangkat,
								   no_tmtjabatan,
								   no_latihan,
								   pendidikan,
								   tahun_lulus,
								   id_tingkat,
								   mutasi, 
								   keterangan,
								   tgl_modif,
								   tgl_upload)
							values('".$this->input->post('namapegawai')."', 
                                   '".$this->input->post('nip')."', 
                                   '".$this->input->post('tempatlahir')."', 
								   'Y',
								   '".$tgl_lahir."', 
								   '".$this->input->post('kelamin')."',
                                   '".$this->input->post('alamat')."',
                                   '".$this->input->post('pangkat')."',
								   '".$tmtpangkat."',
								   '".$this->input->post('jabatan')."',
								   '".$tmtjabatan."',
								   '".$this->input->post('masakerjatahun')."',
								   '".$this->input->post('masakerjabulan')."',
								   '".$this->input->post('namalatihan')."',
								   '".$bulanlatihan."',
								   '".$tahunlatihan."',
								   '".$no_lahir."',
								   '".$no_pangkat."',
								   '".$no_jabatan."',
								   '".$no_latihan."',
								   '".$this->input->post('pend')."',
								   '".$this->input->post('tahunlulus')."',
								   '".$this->input->post('tingkat')."',
								   '".$this->input->post('mutasi')."', 
								   '".$this->input->post('keterangan')."',
								   '".$tanggal."',
								   '".$tanggal."')");  
			
			} 
			$this->redirect();
			//echo "<meta http-equiv='refresh' content='0; url=".base_url()."pegawai'>"; 
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
			$tglsekarang=date('Y-m-d');
			/* s: property gambar */
			$lokasi_file    = $_FILES['imagefile']['tmp_name'];
			$tipe_file      = $_FILES['imagefile']['type'];
			$nama_file      = seo_image($_FILES['imagefile']['name']);
			$acak           = rand(1,99);
			$filename = $acak.$nama_file; 
			$upload_dir = '../foto_pegawai/'.$pathi.'/';
			/* e: property gambar */ 
			
	if ($this->input->post('lahir_none')=="Y") {
		$no_lahir="Y";
		$tgl_lahir="0000-00-00";
	}
	else {
		$no_lahir="N";
		$tgl_lahir=$this->input->post('thn_lahir').'-'.$this->input->post('bln_lahir').'-'.$this->input->post('tgl_lahir'); 
	}
	
	if ($this->input->post('pangkat_none')=="Y") {
		$no_pangkat="Y";
		$tmtpangkat="0000-00-00";
	}
	else {
		$no_pangkat="N";
		$tmtpangkat=$this->input->post('tmttahunpangkat').'-'.$this->input->post('tmtbulanpangkat').'-'.$this->input->post('tmttanggalpangkat'); 
	} 
	if ($this->input->post('jabatan_none')=="Y") {
		$no_jabatan="Y";
		$tmtjabatan="0000-00-00";
	}
	else {
		$no_jabatan="N";
		$tmtjabatan=$this->input->post('tmttahunjabatan').'-'.$this->input->post('tmtbulanjabatan').'-'.$this->input->post('tmttanggaljabatan'); 
	} 
	if ($this->input->post('latihan_none')=="Y") {
		$no_latihan="Y";
		$bulanlatihan="00";
		$tahunlatihan="0000";
	}
	else {
		$no_latihan="N";
		$bulanlatihan=$this->input->post('bulanlatihan');
		$tahunlatihan=$this->input->post('tahunlatihan'); 
	}
			 
			if (!empty($lokasi_file)){ 
			if ($tipe_file == "image/jpeg"){
			
			$query = $this->db->query('SELECT gambar, tgl_modif FROM pegawai WHERE id_pegawai="'.$kode.'";');
			$row = $query->row();
			if ($row->gambar!=''){
				$pathdelete=str_replace("-","/",$row->tgl_modif); 
				unlink("../foto_pegawai/".$pathdelete."/".$row->gambar);
				unlink("../foto_pegawai/".$pathdelete."/small_".$row->gambar); 
			}
			
			/* s: property gambar */
			RmkDir($upload_dir, $mode = 0777); 
			UploadFoto($filename,$upload_dir,400,'imagefile'); 
			/* e: property gambar */  
			
			$this->M_dataadmin->query_manual("UPDATE pegawai SET nama_pegawai       = '".$this->input->post('namapegawai')."',
                                   nip   = '".$this->input->post('nip')."', 
                                   tempat = '".$this->input->post('tempatlahir')."',
								   aktif = '".$this->input->post('aktif')."',
								   tgl_lahir = '".$tgl_lahir."', 
								   no_tgl_lahir	= '".$no_lahir."', 
								   kelamin = '".$this->input->post('kelamin')."',
                                   alamat	= '".$this->input->post('alamat')."',
                                   id_pangkat = '".$this->input->post('pangkat')."',
								   tmtpangkat = '".$tmtpangkat."', 
								   id_jabatan = '".$this->input->post('jabatan')."',
								   tmtjabatan = '".$tmtjabatan."', 
								   masa_tahun = '".$this->input->post('masakerjatahun')."',
								   masa_bulan = '".$this->input->post('masakerjabulan')."',
								   namalatihan = '".$this->input->post('namalatihan')."',
								   bulanlatihan = '".$bulanlatihan."', 
								   tahunlatihan = '".$tahunlatihan."', 
								   
								   no_tmtpangkat = '".$no_pangkat."', 
								   no_tmtjabatan = '".$no_jabatan."', 
								   no_latihan = '".$no_latihan."', 
								   pendidikan = '".$this->input->post('pend')."',
								   tahun_lulus = '".$this->input->post('tahunlulus')."',
								   id_tingkat = '".$this->input->post('tingkat')."',
								   mutasi = '".$this->input->post('mutasi')."',
								   aktif = '".$this->input->post('aktif')."',
								   keterangan = '".$this->input->post('keterangan')."',
								   tgl_modif = '".$tglsekarang."',
								   gambar      = '".$filename."' 
				WHERE id_pegawai   = '".$kode."'"); 
				
			}
			else {
				echo "<script>window.alert('File Harus Berformat .JPG!');
						window.location=('".base_url()."pegawai/edit/".$this->uri->segment(3,0)."')</script>"; 
			}
			}
			else {
				$this->M_dataadmin->query_manual("UPDATE pegawai SET nama_pegawai       = '".$this->input->post('namapegawai')."',
                                   nip   = '".$this->input->post('nip')."', 
                                   tempat = '".$this->input->post('tempatlahir')."',
								   aktif = '".$this->input->post('aktif')."',
								   tgl_lahir = '".$tgl_lahir."', 
								   no_tgl_lahir	= '".$no_lahir."', 
								   kelamin = '".$this->input->post('kelamin')."',
                                   alamat	= '".$this->input->post('alamat')."',
                                   id_pangkat = '".$this->input->post('pangkat')."',
								   tmtpangkat = '".$tmtpangkat."', 
								   id_jabatan = '".$this->input->post('jabatan')."',
								   tmtjabatan = '".$tmtjabatan."', 
								   masa_tahun = '".$this->input->post('masakerjatahun')."',
								   masa_bulan = '".$this->input->post('masakerjabulan')."',
								   namalatihan = '".$this->input->post('namalatihan')."',
								   bulanlatihan = '".$bulanlatihan."', 
								   tahunlatihan = '".$tahunlatihan."', 
								   
								   no_tmtpangkat = '".$no_pangkat."', 
								   no_tmtjabatan = '".$no_jabatan."', 
								   no_latihan = '".$no_latihan."', 
								   pendidikan = '".$this->input->post('pend')."',
								   tahun_lulus = '".$this->input->post('tahunlulus')."',
								   id_tingkat = '".$this->input->post('tingkat')."',
								   mutasi = '".$this->input->post('mutasi')."',
								   aktif = '".$this->input->post('aktif')."',
								   keterangan = '".$this->input->post('keterangan')."' 
				WHERE id_pegawai   = '".$kode."'"); 
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
			$query = $this->M_dataadmin->editpegawai($this->uri->segment(3,0)); 
			$row = $query->row();
			if ($this->session->userdata('id_user') == $row->username or $leveluser=="admin") {
			$kode=$this->uri->segment(3,0);
			$query = $this->db->query('SELECT gambar,tgl_modif FROM pegawai WHERE id_pegawai='.$kode.';');
			$row = $query->row(); 
				
			if ($row->gambar!=''){
				$pathi=$row->tgl_modif;
				$pathdelete=str_replace("-","/",$pathi);
				$this->M_dataadmin->query_manual("DELETE FROM pegawai WHERE id_pegawai='".$kode."'"); 
				unlink("../foto_pegawai/".$pathdelete."/".$row->gambar);
				unlink("../foto_pegawai/".$pathdelete."/small_".$row->gambar);  
			}
			else{
				$this->M_dataadmin->query_manual("DELETE FROM pegawai WHERE id_pegawai=".$kode.""); 
			}
			//REDIRECT AWAL
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
					//echo $jumlah." - $cek[$i] - ".$cek[$i]; 
						$query = $this->db->query("SELECT gambar,tgl_modif FROM pegawai WHERE id_pegawai='".$cek[$i]."'");
						$row = $query->row();  
						if ($row->gambar!=''){
							$pathi=$row->tgl_modif;
							$pathdelete=str_replace("-","/",$pathi);
							unlink("../foto_pegawai/".$pathdelete."/".$row->gambar);
							unlink("../foto_pegawai/".$pathdelete."/small_".$row->gambar);  
						}
						$this->M_dataadmin->query_manual("DELETE FROM pegawai WHERE id_pegawai='".$cek[$i]."'");    
					}  
				}
				else {
					for($i=0;$i<$jumlah;$i++){
					//echo $jumlah." - $cek[$i] - ".$cek[$i]; 
						$query = $this->db->query("SELECT gambar,tgl_modif FROM pegawai WHERE username='".$this->session->userdata('id_user')."' and id_pegawai='".$cek[$i]."'");
						$row = $query->row();  
						$jumlah = $query->num_rows();
						if ($jumlah>0) {
						if ($row->gambar!=''){
							$pathi=$row->tgl_modif;
							$pathdelete=str_replace("-","/",$pathi);
							unlink("../foto_pegawai/".$pathdelete."/".$row->gambar);
							unlink("../foto_pegawai/".$pathdelete."/small_".$row->gambar);  
							}
							$this->M_dataadmin->query_manual("DELETE FROM pegawai WHERE username='".$this->session->userdata('id_user')."' and id_pegawai='".$cek[$i]."'"); 
						}
					} 
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
				$this->M_dataadmin->query_manual("UPDATE pegawai SET aktif='Y' WHERE id_pegawai=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM pegawai WHERE username='".$this->session->userdata('id_user')."' and id_pegawai='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE pegawai SET aktif='Y' WHERE id_pegawai=".$kode."");
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
				$this->M_dataadmin->query_manual("UPDATE pegawai SET aktif='N' WHERE id_pegawai=".$kode."");  
				$this->redirect();
			}
			else {
				$query = $this->db->query("SELECT * FROM pegawai WHERE username='".$this->session->userdata('id_user')."' and id_pegawai='".$kode."'");
				$jumlah = $query->num_rows();
				if ($jumlah>0) {
					$this->M_dataadmin->query_manual("UPDATE pegawai SET aktif='N' WHERE id_pegawai=".$kode."");
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

	public function denied () {
		$data['vdata']='access-denied';  
		$data['judulapp']="Access Denied";
		$data['vnavigasi']='navigasi'; 
		$this->load->view('dashboard',$data);
	}
	
	public function redirect () {
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pegawai'>";
	}
	
	  
}

