<?php
date_default_timezone_set('Asia/Jakarta');
define("TIME_ZONE","+07:00");
class M_data extends CI_model
{

	function __construct ()
	{

		parent::__construct();
		$this->load->database();
		$this->load->helper('fungsi_desa');
	}
	/*-------------------- MENU TOP UMUM ----------------------- */

	public function getMenu2($parent,$hasil){

		$w = $this->db->query("SELECT * from menu where id_position='".$parent."' and aktif='Y' order by urutan");
		$no=1;
		foreach($w->result() as $h)
		{
			$lin1=substr($h->link, 0, 3);
			if ($lin1!="htt") {
				$link1=base_url().$h->link;
			}
			else {
				$link1=$h->link;
			}
			if ($no==1) { $icon="home"; }
			else if ($no==2) { $icon="services"; }
			else if ($no==3) { $icon="news"; }
			else if ($no==4) { $icon="about"; }
			else if ($no==5) { $icon="services"; }
			else if ($no==6) { $icon="issues"; }
			else if ($no==7) { $icon="regulasi"; }
			else if ($no==8) { $icon="program"; }
			else if ($no==9) { $icon="pengumuman"; }
			else if ($no==10) { $icon="galeri"; }
			else if ($no==11) { $icon="informasi"; }
			$wa= $this->db->query("SELECT * from submenu where id_menu='".$h->id_menu."'  and aktif='Y' order by urutan");
			if ($wa->num_rows()>0) {
				$hasil.="<div class='group-layout-column col-lg-2 first'> <a href='".$link1."' class='".$icon." dropdown'> <div class='inner'>".$h->nama_menu."</div> </a> 	<ul class='menu dropdown-menu' role='menu'> ";
			}
			else {
				$hasil.="<div class='group-layout-column col-lg-2 first'> <a href='".$link1."' class='".$icon."  dropdown'> <div class='inner'>".$h->nama_menu."</div> </a> </div>";
			}
			foreach($wa->result() as $ha)
			{
				$lin2=substr($ha->link_submenu, 0, 3);
				if ($lin2!="htt") {
					$link2=base_url().$ha->link_submenu;
				}
				else {
					$link2=$ha->link_submenu;
				}
				$hasil.= "<li><a href=".$link2."> ".$ha->nama_submenu."</a></li>";
			}
			if(($wa->num_rows)>0)
			{
				$hasil.= "</ul></div>";
			}
			$hasil = $this->getMenu2($h->id_menu,$hasil);
			$no++;
		}

		return $hasil;
	}

	public function getMenu1($parent,$hasil){

		$w = $this->db->query("SELECT * from menu where id_position='".$parent."' and aktif='Y' order by urutan");
		$no=1;
		foreach($w->result() as $h)
		{
			$lin1=substr($h->link, 0, 3);
			if ($lin1!="htt") {
				$link1=base_url().$h->link;
			}
			else {
				$link1=$h->link;
			}
			if ($no==1) { $icon="home"; $jangkrik="first";}
			else if ($no==2) { $icon="services"; $jangkrik="";}
			else if ($no==3) { $icon="news"; $jangkrik="";}
			else if ($no==4) { $icon="about"; $jangkrik="";}
			else if ($no==5) { $icon="services"; $jangkrik="";}
			else if ($no==6) { $icon="issues"; $jangkrik="";}
			else if ($no==7) { $icon="regulasi"; $jangkrik="";}
			else if ($no==8) { $icon="program";$jangkrik=""; }
			else if ($no==9) { $icon="pengumuman"; $jangkrik="";}
			else if ($no==10) { $icon="galeri"; $jangkrik="";}
			else if ($no==11) { $icon="informasi"; $jangkrik="";}
			$wa= $this->db->query("SELECT * from submenu where id_menu='".$h->id_menu."'  and aktif='Y' order by urutan");
			if ($wa->num_rows()>0) {
				$hasil.="<div class='group-layout-column col-lg-2 ".$jangkrik."' > <a href='".$link1."' class='".$icon." dropdown' > <div class='inner'>".$h->nama_menu."</div> </a> 	<ul class='menu dropdown-menu' role='menu'> ";
			}
			else {
				$hasil.="<div class='group-layout-column col-lg-2 ".$jangkrik."' > <a href='".$link1."' class='".$icon." dropdown' > <div class='inner'>".$h->nama_menu."</div> </a>  </div> ";
			}
			foreach($wa->result() as $ha)
			{
				$lin2=substr($ha->link_submenu, 0, 3);
				if ($lin2!="htt") {
					$link2=base_url().$ha->link_submenu;
				}
				else {
					$link2=$ha->link_submenu;
				}
				$hasil.= "<li><a href=".$link2."> ".$ha->nama_submenu."</a></li>";
			}
			if(($wa->num_rows)>0)
			{
				$hasil.= "</ul></div>";
			}
			$hasil = $this->getMenu2($h->id_menu,$hasil);
			$no++;
		}

		return $hasil;
	}


	/*-------------------- AKHIR MENU TOP UMUM ------------------*/

	/*---------------------------- AWAL MODEL HOME ----------------------------*/


	public function titlesistem ( $id='' )
	{
		$query = $this->db->query('SELECT nama_website FROM identitas WHERE id_identitas='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->nama_website;
			}
			return $wartosc;
		}

		public function identitasfooter ()
		{
			$sql="SELECT * FROM identitas order by id_identitas limit 1";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function keyword ( $id='' )
		{
			$query = $this->db->query('SELECT meta_keyword FROM identitas WHERE id_identitas='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->meta_keyword;
			}

			return $wartosc;
		}

		public function deskripsi ( $id='' )
		{
			$query = $this->db->query('SELECT meta_deskripsi FROM identitas WHERE id_identitas='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->meta_deskripsi;
			}

			return $wartosc;
		}

		public function ambiliklan ($halaman,$posisi)
		{
			$sql="select * from iklan where id_posisiiklan='".$posisi."' and id_halamaniklan='".$halaman."' and  aktif='Y'  order by urutan asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
	/*
		public function ambilmenu ($posisi)
		{
			$sql="select * from menu where id_position='".$posisi."'  and  aktif='Y'  order by urutan asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function ambilsubmenu ($posisi,$idmenu)
		{
		// id_position='".$posisi."' and
			$sql="select * from submenu where id_menu='".$idmenu."' and  aktif='Y'  order by urutan asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function ambilsubsubmenu ($posisi,$idmenu,$idsubmenu)
		{
			$sql="select * from submenu where id_position='".$posisi."' and  aktif='Y' and id_menu='".$idmenu."' and  id_submenu='".$idsubmenu."' order by urutan asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
*/
		public function ambilmenu ($posisi)
		{
			$sql="select * from menu where id_position='".$posisi."'  and  aktif='Y'  order by urutan asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function ambilsubmenu ($posisi,$idmenu)
		{
		// id_position='".$posisi."' and
			$sql="select * from submenu where id_menu='".$idmenu."' and  aktif='Y'  order by urutan asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function ambilsubsubmenu ($posisi,$idmenu,$idsubmenu)
		{
			$sql="select * from submenu where id_position='".$posisi."' and  aktif='Y' and id_menu='".$idmenu."' and  id_submenu='".$idsubmenu."' order by urutan asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function ambilprodukhukum ($limit)
		{
			$sql="select * from produkhukum P left join katprodukhukum K on P.id_katprodukhukum=K.id_katprodukhukum order by id_produkhukum desc limit ".$limit."";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function ambildokumen ($limit)
		{
			$sql="select * from dokumen where aktif='Y' order by id_dokumen desc limit ".$limit."";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function beritautama ($limit)
		{
			$sql="select * from berita where headline='Y' and aktif='Y' order by id_berita desc limit $limit";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function beritaterpopuler ($limit)
		{
			$sql="select * from berita where aktif='Y'  order by dibaca desc limit $limit";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function beritaterbaru ($limit)
		{
			$sql="select * from berita  left join kategori on berita.id_kategori=kategori.id_kategori  where  berita.aktif='Y' order by id_berita desc limit $limit";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function beritaterbaru2 ($awal,$jumlah)
		{
			$sql="select * from berita  left join kategori on berita.id_kategori=kategori.id_kategori  where  berita.aktif='Y' order by id_berita desc limit ".$awal.",".$jumlah." ";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function artikelterbaru ($limit)
		{
			//left join kategori on artikel.id_kategori=kategoriartikel.id_kategoriartikel
			$sql="select * from artikel   where  artikel.aktif='Y' order by id_artikel desc limit $limit";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function artikelterbaru2 ($awal,$jumlah)
		{
			$sql="select * from artikel   where  artikel.aktif='Y' order by id_artikel desc limit ".$awal.",".$jumlah." ";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function beritarandom ()
		{
			$sql="select * from berita where aktif='Y' order by id_berita desc limit 10";
			$hslquer=$this->db->query($sql);
			return $hslquer;
		}

		public function pengaduan ($limit)
		{
			$sql="select * from pengaduan where aktif='Y' order by id_pengaduan desc limit $limit";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function telpon ($limit)
		{
			$sql="select * from telpon where aktif='Y' order by urutan desc limit $limit";
			$hslquer=$this->db->query($sql);
			return $hslquer;
		}

		public function pegawaidepan() {
			$data = array();
			$this->db->select('*');
			$this->db->from('pegawai');
			$this->db->order_by('jabatanpegawai.id_jabatan', 'asc');
			$this->db->where('pegawai.aktif', 'Y');
			$this->db->where('pegawai.id_jabatan <>', '1');
			$this->db->join('jabatanpegawai', 'jabatanpegawai.id_jabatan = pegawai.id_jabatan', 'left');
			$this->db->join('golongan', 'golongan.id_pangkat = pegawai.id_pangkat', 'left');
			$this->db->limit(18
			);
			$getData = $this->db->get();

			return $getData->result_array();

		}

		//iklan layanan
		/*
		public function iklanlayanan ()
		{
			$sql="select * from banner where aktif='Y' order by id_banner desc limit 1";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
		*/

		public function imageslide ($limit)
		{
			$sql="select * from imageslide where aktif='Y' order by urutan asc limit ".$limit."";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		function getfotoberitakat($catid, $perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('fotoberita');
        //$this->db->where("id_kategori", $catid);
			$this->db->order_by('id_fotoberita', 'desc');
			$this->db->where('aktif', 'Y');
			$this->db->limit(10);
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}

		public function foto ()
		{
			$sql="select * from fotoberita where aktif='Y' order by id_fotoberita desc limit 10";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function video ($mulai,$limit)
		{
			$sql="select * from video where aktif='Y' order by id_video desc limit ".$mulai.",".$limit."";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}


		/*------------------- AKHIR MODEL HOME -----------------------------------*/
		/*------------------------- MODUL GALERI ----------------------*/
		function allfotoberita($perPage, $uri) {
			$data = array();
			$this->db->select('*,gallery.tanggal_modif as jangkrik, COUNT(gallery.id_gallery) as jumlah');
			$this->db->from('gallery');
			$this->db->where("fotoberita.aktif", 'Y');
        //$this->db->order_by('fotoberita.id_fotoberita', 'desc');
			$this->db->join('fotoberita', 'fotoberita.id_fotoberita = gallery.id_fotoberita', 'left');
        //$this->db->where('fotoberita.aktif', 'Y');
			$this->db->order_by('fotoberita.tanggal', 'desc');
			$this->db->group_by('fotoberita.id_fotoberita');

		//$this->db->join('users', 'users.username = berita.username', 'left');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}

		public function fotoberita ()
		{
			$sql="SELECT *,gallery.tanggal_modif as jangkrik, COUNT(gallery.id_gallery) as jumlah  FROM gallery LEFT JOIN fotoberita
			ON gallery.id_fotoberita=fotoberita.id_fotoberita  WHERE fotoberita.aktif='Y' GROUP BY fotoberita.id_fotoberita desc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function getidgaleri ( $id='' )
		{
			$hsl = array();
			$sql="select *,gallery.keterangan as judulfoto from gallery
			inner join fotoberita on fotoberita.id_fotoberita = gallery.id_fotoberita
			where fotoberita.id_fotoberita='$id' order by id_gallery desc";
			$hslquery=$this->db->query("$sql");

			return $hslquery;
		}

		public function tanggalalbum ( $id='' )
		{
			$query = $this->db->query('SELECT tanggal FROM fotoberita WHERE id_fotoberita='.$id.';');
		$row = $query->row(); //takes only one result row
		if ($query->num_rows() > 0) {
			$wartosc = $row->tanggal;
		}
		else {
			$wartosc='! Maaf Data Tidak Ditemukan';
		}
		return $wartosc;
	}

	public function judulgaleri ( $id='' )
	{
		$query = $this->db->query('SELECT judul_fotoberita FROM fotoberita WHERE id_fotoberita='.$id.';');
		$row = $query->row(); //takes only one result row
		if ($query->num_rows() > 0) {
			$wartosc = $row->judul_fotoberita;
		}
		else {
			$wartosc='! Maaf Data Tidak Ditemukan';
		}
		return $wartosc;
	}

	public function ketfotoberita ( $id='' )
	{
		$query = $this->db->query('SELECT keterangan FROM fotoberita WHERE id_fotoberita='.$id.';');
		$row = $query->row(); //takes only one result row
		if ($query->num_rows() > 0) {
			$wartosc = $row->keterangan;
		}
		else {
			$wartosc='! Maaf Data Tidak Ditemukan';
		}
		return $wartosc;
	}

		//substring(tanggal,1,4)='0$a'
	public function tahungaleri()
	{
		$sql="SELECT DISTINCT substring(tanggal,1,4),substring(tanggal,1,4) as tanggal from fotoberita  order by tanggal asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}


	/*------------------------- AKHIR MODUL GALERI ---------------------*/

	/*------------------------- KOLOM-KOLOM ---------------------*/
		//pengumuman
	public function pengumuman ($limit)
	{
		$sql="select * from pengumuman where aktif='Y' order by id_pengumuman desc limit $limit";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}

	public function weblink ($limit)
	{
		$sql="select * from weblink where aktif='Y' order by id_weblink asc limit $limit";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}


		//jadwal kegiatan
	public function jadwalkegiatan($limit)
	{
		$sql="select * from kegiatan where aktif='Y' order by tgl_kegiatan desc limit $limit";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}

	public function fotokolom ($awal,$jumlah)
	{

		$sql="select *, COUNT(gallery.id_gallery) as jumlah from gallery left join fotoberita on gallery.id_fotoberita=fotoberita.id_fotoberita group by gallery.id_fotoberita  order by fotoberita.tanggal   desc limit ".$awal.",".$jumlah." ";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}

		//polling rekursif\
	public function ambil_semua_polling()
	{
		return $this->db->get('pollingpilihan')->result();
	}

	public function pollingan($hasil)
	{
		$w = $this->db->query("SELECT * from polling where aktif='Y' order by id_polling desc limit 1");
		if(($w->num_rows())>0)
		{

			$hasil .= " ";

		}
		foreach($w->result() as $h)
		{
			$hasil .= "<form method='POST' action='".base_url()."polling/vote'> <input type='hidden' name='idpolling' value='".$h->id_polling."'><div class='polling-1'>".$h->pertanyaan." </div><div class='pilihanpoll'>";
			$wa= $this->db->query("SELECT * from pollingpilihan where aktif='Y' and id_polling='".$h->id_polling."'");
			foreach($wa->result() as $ha)
			{
				$hasil .= "<span class='news-text'><input type='radio' name='pilihan' value='".$ha->id_pollingpilihan."'>".$ha->pilihan."</span><br>";
			}
			$hasil .= " ";
			//$hasil = $this->getMenu2($h->id_menu,$hasil);
		}
		if(($w->num_rows)>0)
		{
			$hasil .= "<br>
			<button class='btn btn-green' type='submit'>Submit</button> </form>
			<a href='".base_url()."polling/' class='btn btn-green' >Lihat Hasil</a>
			</div>";
			//type="submit"
			//$hasil.= "<li><a href=".base_url().$h->link."> ".$h->nama_menu."</a><ul>";
		}
		return $hasil;
	}



	/* AKHIR KOLOM KANAN HOME*/


	/*---------------------------- UNTUK BERITA ----------------------------*/
	public function judulan ( $id='' )
	{
		$query = $this->db->query('SELECT berita.id_berita,kategori.nama_kategori FROM berita,kategori
			WHERE berita.aktif="Y" and kategori.id_kategori=berita.id_kategori
			AND id_berita = '.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->nama_kategori;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}

		public function judulberita ( $id='' )
		{
			$query = $this->db->query('SELECT judul FROM berita WHERE aktif="Y" and id_berita='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->judul;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}

		public function deskripsiberita ( $id='' )
		{
			$query = $this->db->query('SELECT isi_berita FROM berita WHERE aktif="Y" and id_berita='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->isi_berita;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}

		public function deskripsiprofil ( $id='' )
		{
			$query = $this->db->query('SELECT isi_halaman FROM halamanprofil WHERE id_halamanprofil='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->isi_halaman;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}

		public function idberita ($id='' )
		{
			//$sql="select * from berita where id_berita=".$id."";
			//$hslquery=$this->db->query($sql);
			//return $hslquery;
			$hsl = array();
			$sql="select * from berita left join kategori on kategori.id_kategori=berita.id_kategori where berita.aktif='Y' and id_berita='".$id."'";
			$hslquery=$this->db->query("$sql");
			if($hslquery->num_rows() > 0){
				//$hsl=$hslquery->result();
				return $hslquery;

			}
			//$hslquery->free_result();
			return $hslquery;
		}



		public function judul ( $id='' )
		{
			$query = $this->db->query('SELECT nama_kategori FROM kategori WHERE id_kategori='.$id.';');
			$row = $query->row(); //takes only one result row
			$wartosc = $row->nama_kategori;
			return $wartosc;
		}

		public function tampil_kategori(){
			return $this->db->get('kategori');
		}

		public function katberita ($id='' )
		{
			//$data=array();
			$sqlstr="select * from berita where berita.aktif='Y' and id_kategori=".$id." order by id_berita desc";
			$hslquer=$this->db->query($sqlstr);
			return $hslquer;

		}

		public function getberitakat($catid, $perPage, $uri) {
			$data = array();
			$this->db->select('*,berita.tanggal as tanggal,berita.jam as jam');
			$this->db->from('berita');
			$this->db->where("id_kategori", $catid);
			$this->db->order_by('id_berita', 'desc');
			$this->db->join('users', 'users.username = berita.username', 'left');
			$this->db->where('aktif', 'Y');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}


		public function semuaberitaall()
		{
			$sql="select * from berita where aktif='Y' order by id_berita desc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		function allberita($perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('berita');
        //$this->db->where("id_kategori", $catid);
			$this->db->order_by('id_berita', 'desc');
			$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'left');
			$this->db->where('berita.aktif', 'Y');

		//$this->db->join('users', 'users.username = berita.username', 'left');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}

		function cariberita($kata) {
			$kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);
			$pisah_kata = explode(" ",$kata);
			$jml_katakan = (integer)count($pisah_kata);
			$jml_kata = $jml_katakan-1;

			$hsl = array();
			$sql="SELECT * FROM berita left join kategori on kategori.id_kategori=berita.id_kategori WHERE " ;
			for ($i=0; $i<=$jml_kata; $i++){
				$sql .= "isi_berita LIKE '%$pisah_kata[$i]%' or judul LIKE '%$pisah_kata[$i]%'";
				if ($i < $jml_kata ){
					$sql .= " OR "; } }
					$sql .= " and berita.aktif='Y' ORDER BY id_berita desc";
					$hslquery=$this->db->query("$sql");
					if($hslquery->num_rows() > 0){
						$hsl=$hslquery->result();
					}
					$hslquery->free_result();
					return $hsl;
				}




				/*--------------------- AWAL PENGUMUMAN ---------------------*/
				function allpengumuman($perPage, $uri) {
					$data = array();
					$this->db->select('*');
					$this->db->from('pengumuman');
        //$this->db->where("id_kategori", $catid);
					$this->db->order_by('id_pengumuman', 'desc');
					$this->db->where('aktif', 'Y');
					$this->db->join('users', 'users.username = pengumuman.username', 'left');
					$getData = $this->db->get('', $perPage, $uri);
					if ($getData->num_rows() > 0)
						return $getData->result_array();
					else
						return null;
				}

				public function judulpengumuman ( $id='' )
				{
					$query = $this->db->query('SELECT judul FROM pengumuman WHERE id_pengumuman='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->judul;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}

		public function idpengumuman ($id='' )
		{
			//$sql="select * from pengumuman where id_pengumuman=".$id."";
			//$hslquery=$this->db->query($sql);
			//return $hslquery;
			$hsl = array();
			$sql="select * from pengumuman left join users on pengumuman.username=users.username where id_pengumuman='".$id."'";
			$hslquery=$this->db->query("$sql");
			if($hslquery->num_rows() > 0){
				$hsl=$hslquery->result();
			}
			$hslquery->free_result();
			return $hsl;
		}
		/*--------------------- AKHIR PENGUMUMAN ---------------------*/



		/*-------------------- AWAL MODUL PEGAWAI CAMAT----------------*/

		function allpegawai($perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('pegawai');
        //$this->db->where("id_kategori", $catid);
			$this->db->order_by('jabatanpegawai.id_jabatan', 'asc');
			$this->db->where('pegawai.aktif', 'Y');
			$this->db->join('jabatanpegawai', 'jabatanpegawai.id_jabatan = pegawai.id_jabatan', 'left');
			$this->db->join('golongan', 'golongan.id_pangkat = pegawai.id_pangkat', 'left');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}

		public function idpegawai ($id='' )
		{
			//$sql="select * from berita where id_berita=".$id."";
			//$hslquery=$this->db->query($sql);
			//return $hslquery;
			$hsl = array();
			$sql="select *,pegawai.gambar as gambarboy  from pegawai left join jabatanpegawai on jabatanpegawai.id_jabatan=pegawai.id_jabatan left join golongan on golongan.id_pangkat = pegawai.id_pangkat where id_pegawai='".$id."' and pegawai.aktif='Y'";
			$hslquery=$this->db->query("$sql");
			if($hslquery->num_rows() > 0){
				$hsl=$hslquery->result();
			}
			$hslquery->free_result();
			return $hsl;
		}
		public function judulpegawai ( $id='' )
		{
			$query = $this->db->query('SELECT nama_pegawai FROM pegawai WHERE id_pegawai='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->nama_pegawai;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}
		/*-------------------- AKHIR MODUL PEGAWAI  ----------------*/


		/*-------------------- AKHIR MODUL PROFIL HALAMAN  ----------------*/

		public function idprofil ($id='' )
		{
			$hsl = array();
			$sql="select * from halamanprofil where id_halamanprofil='".$id."'";
			$hslquery=$this->db->query("$sql");
			if($hslquery->num_rows() > 0){
				$hsl=$hslquery->result();
			}
			$hslquery->free_result();
			return $hsl;
		}

		public function judulprofil ( $id='' )
		{
			$query = $this->db->query('SELECT * from halamanprofil where id_halamanprofil = '.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->judul;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}

		/*-------------------- AKHIR MODUL PROFIL HALAMAN ----------------*/



		/*---------------------------- RSS FEED ----------------------------*/
		function getPosts($limit = NULL)
		{
			return $this->db->get('berita', $limit);
		}
		/* AKHIR RSS FEED*/
		/*--------------------- AWAL SIMPAN PENGADUAN   -------------------*/

		function simpanpengaduan($ipaddress,$name,$email,$judulpengaduan,$alamat,$lembaga,$message){
			$tanggal=date('y-m-d');
			$now= date('H:i:s');

			$data = array(
				"ip"=>$ipaddress,
				"nama"=>$name,
				"email"=>$email,
				"judulpengaduan"=>$judulpengaduan,
				"alamat"=>$alamat,
				"lembaga"=>$lembaga,
				"aktif"=>'N',
				"pesan"=>$message,
				"jam"=>$now,
				"tanggal"=>$tanggal);
			$this->db->insert('pengaduan', $data);
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}

		function allpengaduan($perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('pengaduan');
			$this->db->order_by('id_pengaduan', 'desc');
			$this->db->where('aktif', 'Y');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}
		/*--------------------- AKHIR SIMPAN PENGADUAN   -------------------*/


		/*--------------------- AWAL POLLING   -------------------*/

		function simpanpolling($id_polling,$id_pilihan,$row){
			// $tanggal=date('y-m-d');
				//$now= date('H:i:s');

			$data = array(
				"rating"=>$row+1);
			$this->db->where("id_pollingpilihan", $id_pilihan);
			$this->db->where("id_polling", $id_polling);
			$this->db->update('pollingpilihan', $data);
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}

		public function pollingpilihan ($id_polling)
		{
			$sql="select * from pollingpilihan where aktif='Y' and id_polling='".$id_polling."' order by id_pollingpilihan desc ";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
		/*--------------------- AKHIR POLLING   -------------------*/

		/*-------------------- AWAL MODUL JADWAL KEGIATAN  ----------------*/
		function allkegiatan($perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('kegiatan');
        //$this->db->where("id_kategori", $catid);
			$this->db->order_by('tgl_kegiatan', 'desc');
			$this->db->where('aktif', 'Y');
		//$this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		//$this->db->join('golongan', 'golongan.id_pangkat = pegawai.id_pangkat', 'left');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}

		public function idkegiatan ($id='' )
		{


			$hsl = array();
			$sql="select * from kegiatan  where aktif='Y' and id_kegiatan='".$id."'";
			$hslquery=$this->db->query("$sql");
			if($hslquery->num_rows() > 0){
				$hsl=$hslquery->result();
			}
			$hslquery->free_result();
			return $hsl;
		}
		public function judulkegiatan ( $id='' )
		{
			$query = $this->db->query('SELECT namakegiatan FROM kegiatan WHERE id_kegiatan='.$id.';');
			$row = $query->row(); //takes only one result row
			$wartosc = $row->namakegiatan;
			return $wartosc;
		}
		/*-------------------- AKHIR MODUL JADWAL KEGIATAN ----------------*/

		/*-------------------- AWAL MODUL VIDEO -----------------*/
		function allvideo($perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('video');
			$this->db->order_by('id_video', 'asc');
			$this->db->where('aktif', 'Y');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}

		/*-------------------- AKHIR MODUL VIDEO ----------------*/

		/*-------------------- S:WEBLINKS -----------------*/
		function allweblink($perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('weblink');
			//$this->db->where("id_kategori", $catid);
			$this->db->order_by('id_weblink', 'asc');
			$this->db->where('aktif', 'Y');
			//$this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan', 'left');
			//$this->db->join('golongan', 'golongan.id_pangkat = pegawai.id_pangkat', 'left');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}
		/*-------------------- E:WEBLINK ----------------*/

		/*-------------------- S:DOWNLOAD -----------------*/
		function alldownload($perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('download');
			$this->db->order_by('id_download', 'asc');
			$this->db->where('aktif', 'Y');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}
		/*-------------------- E:DOWNLOAD ----------------*/


		/*--------------------- AWAL MODULE DOKUMEN -------------------*/
		public function katdokumen()
		{
			$sql="select * from katdokumen order by id_katdokumen";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}


		public function getdokumenkat($catid, $perPage, $uri) {
			$data = array();
			$this->db->select('*,dokumen.keterangan as jangkrik');
			$this->db->from('dokumen');
			$this->db->where("dokumen.id_katdokumen", $catid);
			$this->db->order_by('dokumen.id_dokumen', 'desc');
			$this->db->join('katdokumen', 'katdokumen.id_katdokumen = dokumen.id_katdokumen', 'left');
			$this->db->where('dokumen.aktif', 'Y');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}



		public function juduldokumen ( $id='' )
		{
			$query = $this->db->query('SELECT judul FROM dokumen WHERE id_dokumen='.$id.';');
			$row = $query->row(); //takes only one result row
			$wartosc = $row->judul;
			return $wartosc;
		}
		public function judulkatdokumen ( $id='' )
		{
			$query = $this->db->query('SELECT nama_katdokumen FROM katdokumen WHERE id_katdokumen='.$id.';');
			$row = $query->row(); //takes only one result row
			$wartosc = $row->nama_katdokumen;
			return $wartosc;
		}
		public function iddokumen ($id='' )
		{
			$hsl = array();
			$sql="select *,dokumen.keterangan as jangkrik from dokumen left join katdokumen on katdokumen.id_katdokumen=dokumen.id_katdokumen where dokumen.aktif='Y' and id_dokumen='".$id."'";
			$hslquery=$this->db->query("$sql");
			if($hslquery->num_rows() > 0){
				$hsl=$hslquery->result();
			}
			$hslquery->free_result();
			return $hsl;
		}
		/*--------------------- AWAL MODULE DOKUMEN -------------------*/


		/*-------------------- AWAL MODUL TELPON PENTING -----------------*/


		function alltelpon($perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('telpon');
        //$this->db->where("id_kategori", $catid);
			$this->db->order_by('id_telpon', 'asc');
			$this->db->where('aktif', 'Y');
		//$this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		//$this->db->join('golongan', 'golongan.id_pangkat = pegawai.id_pangkat', 'left');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}
		/*-------------------- AKHIR MODUL TELPON PENTING ----------------*/

		/*--------------------- AWAL PRODUK HUKUM -------------------*/
		//kategori dokumen
		public function katprodukhukum()
		{
			$sql="select * from katprodukhukum order by id_katprodukhukum asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function getprodukhukumkat($catid, $perPage, $uri) {
			$data = array();
			$this->db->select('*,produkhukum.keterangan as jangkrik');
			$this->db->from('produkhukum');
			$this->db->where("produkhukum.id_katprodukhukum", $catid);
			$this->db->order_by('produkhukum.id_produkhukum', 'desc');
			$this->db->join('katprodukhukum', 'katprodukhukum.id_katprodukhukum = produkhukum.id_katprodukhukum', 'left');
			$this->db->where('produkhukum.aktif', 'Y');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}

		public function tahunprodukhukum($id='')
		{
			$sql="SELECT DISTINCT tahun from produkhukum where id_katprodukhukum='".$id."' order by tahun desc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}

		public function katprodhukum ( $id='' )
		{
			$query = $this->db->query('SELECT nama_katprodukhukum FROM katprodukhukum WHERE id_katprodukhukum='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->nama_katprodukhukum;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}
		public function judulkatprodukhukum ( $id='' )
		{
			$query = $this->db->query('SELECT nama_katprodukhukum FROM katprodukhukum WHERE id_katprodukhukum='.$id.';');
			$row = $query->row(); //takes only one result row
			$wartosc = $row->nama_katprodukhukum;
			return $wartosc;
		}

		public function judulprodukhukum ( $id='' )
		{
			$query = $this->db->query('SELECT judul FROM produkhukum WHERE id_produkhukum='.$id.';');
			$row = $query->row(); //takes only one result row
			$wartosc = $row->judul;
			return $wartosc;
		}

		public function idprodukhukum ($id='' )
		{
			$hsl = array();
			$sql="select *,produkhukum.keterangan as jangkrik from produkhukum left join katprodukhukum on katprodukhukum.id_katprodukhukum=produkhukum.id_katprodukhukum where id_produkhukum='".$id."'";
			$hslquery=$this->db->query("$sql");
			if($hslquery->num_rows() > 0){
				$hsl=$hslquery->result();
			}
			$hslquery->free_result();
			return $hsl;
		}
		/*-------------------- AKHIR PRODUK HUKUM ----------------*/

		/*-------------------- AWAL JUMLAH DATA ----------------*/

		public function jumlahkegiatan()
		{
			$query = $this->db->get('kegiatan');
			if($query->num_rows()>0)
			{
				return $query->num_rows();
			}
			else
			{
				return 0;
			}
		}

		public function jumlahartikel()
		{
			$query = $this->db->get('artikel');
			if($query->num_rows()>0)
			{
				return $query->num_rows();
			}
			else
			{
				return 0;
			}
		}

		public function jumlahbertia()
		{
			$query = $this->db->get('berita');
			if($query->num_rows()>0)
			{
				return $query->num_rows();
			}
			else
			{
				return 0;
			}
		}


		public function jumlahpengumuman()
		{
			$query = $this->db->get('pengumuman');
			if($query->num_rows()>0)
			{
				return $query->num_rows();
			}
			else
			{
				return 0;
			}
		}
		/*-------------------- AKHIR JUMLAH DATA ----------------*/


		/*---------------------------- s:artikel ----------------------------*/

		public function judulartikel ( $id='' )
		{
			$query = $this->db->query('SELECT judul FROM artikel WHERE aktif="Y" and id_artikel='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->judul;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}

		public function deskripsiartikel ( $id='' )
		{
			$query = $this->db->query('SELECT isi_artikel FROM artikel WHERE aktif="Y" and id_artikel='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->isi_artikel;
			}
			else {
				$wartosc='! Maaf Data Tidak Ditemukan';
			}
			return $wartosc;
		}


		public function idartikel ($id='' )
		{
			$hsl = array();
			$sql="select * from artikel where artikel.aktif='Y' and id_artikel='".$id."'";
			$hslquery=$this->db->query("$sql");
			if($hslquery->num_rows() > 0){
				return $hslquery;
			}
			return $hslquery;
		}

		function allartikel($perPage, $uri) {
			$data = array();
			$this->db->select('*');
			$this->db->from('artikel');
			$this->db->order_by('id_artikel', 'desc');
			$this->db->where('artikel.aktif', 'Y');
			$getData = $this->db->get('', $perPage, $uri);
			if ($getData->num_rows() > 0)
				return $getData->result_array();
			else
				return null;
		}
		/*---------------------------- s:artikel ----------------------------*/

	}