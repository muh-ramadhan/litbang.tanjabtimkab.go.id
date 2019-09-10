<?php
	date_default_timezone_set('Asia/Jakarta');
	define("TIME_ZONE","+07:00");
Class m_dataadmin extends CI_Model
{ 
 
	function __constuct()
	{
		parent::__constuct();  // Call the Model constructor 
		loader::database();    // Connect to current database setting.
	}
	
	public function identitas ()
		{
			$sql="SELECT * FROM identitas order by id_identitas limit 1";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
		
	public function titlesistem ( $id='' )
		{
			$query = $this->db->query('SELECT nama_website FROM identitas WHERE id_identitas='.$id.';');
			$row = $query->row(); //takes only one result row
			if ($query->num_rows() > 0) {
				$wartosc = $row->nama_website;
		}
			 
		return $wartosc; 
		}
		
	function data_login_admin($user,$pass)
	{
		$user_bersih=stripslashes(strip_tags(htmlspecialchars($user,ENT_QUOTES)));
		$pass_bersih=stripslashes(strip_tags(htmlspecialchars($pass,ENT_QUOTES)));
		$query=$this->db->query("select * from users where username='$user_bersih' and password=md5('$pass_bersih') and blokir='N'");
		return $query;
	} 
	
	function tampil_tabel_filter($tabel,$id,$limit,$offset)
	{
		$q = $this->db->query("SELECT * from $tabel order by $id ASC LIMIT $offset,$limit");
		return $q;
	}
	
	function tampil_tabel($tabel,$id)
	{
		$q = $this->db->query("SELECT * from $tabel order by $id ASC");
		return $q;
	}
	
	function tampil_tabel_edit($tabel,$contion,$id)
	{
		$q = $this->db->query("SELECT * from $tabel where order by $id ASC");
		return $q;
	}
	function custom_query($id)
	{
		$q = $this->db->query($id);
		return $q;
	}

	
	function query_manual($datainput)
	{
		$q = $this->db->query($datainput);
	} 
	
	/** S:iDENTITAS **/ 
	/** e:iDENTITAS **/
	
	/** S:BERITA **/ 
	public function indexberita ($catid, $perPage, $uri)
	{
		//$jangkrik=date('Y-m-d');
		//$jangkrik2=date('Y-m-d', strtotime('-7 day'));	
        $data = array();
        $this->db->select('*,berita.aktif as jangkrik');
        $this->db->from('berita');
		$this->db->join('kategori', 'kategori.id_kategori=berita.id_kategori', 'left');
		$this->db->join('users', 'users.username=berita.username', 'left');
		//$this->db->where("tanggal BETWEEN '$jangkrik2' AND '$jangkrik'");
		//$this->db->where('berita.aktif', 'Y');
        $this->db->order_by('id_berita', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	
	public function indexkategori ($catid, $perPage, $uri)
	{
		//$query = $this->db->query("select count(*) as jml from berita");
	
		$data = array();
        $this->db->select('*,kategori.aktif as jangkrik');
        $this->db->from('kategori'); 
		$this->db->join('users', 'users.username=kategori.username', 'left'); 
        $this->db->order_by('id_kategori', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	
	public function indextag ($catid, $perPage, $uri)
	{
		$data = array();
        $this->db->select('*,tag.aktif as jangkrik');
        $this->db->from('tag'); 
		$this->db->join('users', 'users.username=tag.username', 'left'); 
        $this->db->order_by('id_tag', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
	
	public function pilihartikel($id)
		{
			$sql="select * from artikel where aktif='Y' order by id_artikel asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
	
	public function pilihberitakategori($id)
		{
			$sql="select * from berita where id_kategori='".$id."' order by id_berita asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
	
	public function pilihprodukhukumkategori($id)
		{
			$sql="select * from produkhukum where id_katprodukhukum='".$id."' order by id_produkhukum asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
	
	public function pilihdokumenkategori($id)
		{
			$sql="select * from dokumen where id_katdokumen='".$id."' order by id_dokumen asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
	
	public function pilihtag ()
		{
			$sql="select * from tag order by nama_tag asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}	
		
	public function pilihdaerah ()
		{
			$sql="select * from daerah order by id_daerah asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}	
	
	public function editberita ($id)
	{
			$sql="SELECT * FROM berita WHERE id_berita='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	public function pilihkategori ()
		{
			$sql="select * from kategori order by nama_kategori asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}
		
	public function editkategori ($id)
	{
			$sql="SELECT * FROM kategori WHERE id_kategori='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	public function edittag ($id)
	{
			$sql="SELECT * FROM tag WHERE id_tag='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	/** E:BERITA **/ 
	
	
	/** S:ARTIKEL **/ 
	public function indexartikel ($catid, $perPage, $uri)
	{
		//$jangkrik=date('Y-m-d');
		//$jangkrik2=date('Y-m-d', strtotime('-7 day'));	
        $data = array();
        $this->db->select('*,artikel.aktif as jangkrik');
        $this->db->from('artikel');
		//$this->db->join('kategori', 'kategori.id_kategori=artikel.id_kategori', 'left');
		$this->db->join('users', 'users.username=artikel.username', 'left');
		//$this->db->where("tanggal BETWEEN '$jangkrik2' AND '$jangkrik'");
		//$this->db->where('artikel.aktif', 'Y');
        $this->db->order_by('id_artikel', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	 
	public function editartikel ($id)
	{
			$sql="SELECT * FROM artikel WHERE id_artikel='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	 
	/** E:ARTIKEL **/ 
	
	/** S:IKLAN **/
	public function indexiklan ($catid, $perPage, $uri)
	{ 	
		$data = array();
        $this->db->select('*,iklan.aktif as jangkrik');
        $this->db->from('iklan');
		$this->db->join('halamaniklan', 'halamaniklan.id_halamaniklan=iklan.id_halamaniklan', 'left');
		$this->db->join('posisiiklan', 'posisiiklan.id_posisiiklan=iklan.id_posisiiklan', 'left');
		$this->db->join('users', 'users.username=iklan.username', 'left'); 
        $this->db->order_by('id_iklan', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	
	public function pilihposisiiklan ()
	{
		$sql="select * from posisiiklan order by id_posisiiklan asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}

	public function pilihhalamaniklan ()
	{
		$sql="select * from halamaniklan order by id_halamaniklan asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}	
	
	public function editiklan ($id)
	{
			$sql="SELECT * FROM iklan WHERE id_iklan='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	/** E:IKLAN **/
	
	/** S: FILE DOWNLOAD **/ 
	public function indexdownload ($catid, $perPage, $uri)
	{ 	
		$data = array();
        $this->db->select('*');
        $this->db->from('download'); 
		$this->db->join('users', 'users.username=download.username', 'left'); 
        $this->db->order_by('id_download', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	
	public function editdownload ($id)
	{
			$sql="SELECT * FROM download WHERE id_download='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	/** E: FILE DOWNLOAD **/ 
	
	/** S: POLLING **/
	public function indexpolling ($catid, $perPage, $uri)
	{ 	
		$data = array();
        $this->db->select('*,polling.aktif as jangkrik');
        $this->db->from('polling'); 
		$this->db->join('users', 'users.username=polling.username', 'left'); 
        $this->db->order_by('id_polling', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	
	public function editpolling ($id)
	{
			$sql="SELECT * FROM polling WHERE id_polling='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	/** E: POLLING **/
	
	
	/** S: FOTOBERITA  **/
	public function indexfotoberita ($catid, $perPage, $uri)
	{ 	
		$data = array();
        $this->db->select('*');
        $this->db->from('fotoberita'); 
		$this->db->join('users', 'users.username=fotoberita.username', 'left'); 
        $this->db->order_by('id_fotoberita', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	
	public function editfotoberita ($id)
	{
			$sql="SELECT * FROM fotoberita WHERE id_fotoberita='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	public function pilihalbum ()
	{
			$sql="SELECT * FROM fotoberita where aktif='Y'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	public function selectgallery ($id)
	{
			$sql="SELECT * FROM gallery WHERE id_fotoberita='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	/** E: POLLING **/
	
	/** S:HALAMAN PROFIL **/ 
	
	public function indexhalamanprofil ($catid, $perPage, $uri)
	{ 	
        $data = array();
        $this->db->select('*,halamanprofil.aktif as jangkrik');
        $this->db->from('halamanprofil'); 
		$this->db->join('users', 'users.username=halamanprofil.username', 'left'); 
        $this->db->order_by('id_halamanprofil', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
	 
	public function edithalamanprofil ($id)
	{
			$sql="SELECT * FROM halamanprofil WHERE id_halamanprofil='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	public function pilihhalamanprofil ()
		{
			$sql="select * from halamanprofil order by id_halamanprofil asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}	
	 
	/** E:HALAMAN PROFIL **/ 
	
	/** S:MAIN MENU **/  
	public function indexmenu ($catid, $perPage, $uri)
	{ 	
        $data = array();
        $this->db->select('*,menu.aktif as jangkrik');
        $this->db->from('menu'); 
		$this->db->join('menu_position', 'menu_position.id_posisi=menu.id_position', 'left'); 
		$this->db->join('users', 'users.username=menu.username', 'left'); 
        $this->db->order_by('id_menu', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
	 
	public function editmenu ($id)
	{
			$sql="SELECT * FROM menu WHERE id_menu='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	public function pilihposisimenu ()
	{
		$sql="select * from menu_position order by id_posisi asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}	
	public function pilihlinkmenu ()
	{
		$sql="select * from link where aktif='Y' order by id_link asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}	 
	/** E:MAIN MENU **/ 
	
	/** S:SUBMENU **/  
	public function indexsubmenu ($catid, $perPage, $uri)
	{ 	
        $data = array();
        $this->db->select('*,submenu.css as jangkrikcss, submenu.aktif as jangkrik, submenu.urutan as urutjangkrik');
        $this->db->from('submenu'); 
		//$this->db->join('menu_position', 'menu_position.id_posisi=menu.id_position', 'left'); 
		$this->db->join('menu', 'menu.id_menu=submenu.id_menu', 'left'); 
		$this->db->join('users', 'users.username=submenu.username', 'left'); 
        $this->db->order_by('id_submenu', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
	 
	public function editsubmenu ($id)
	{
			$sql="SELECT * FROM submenu WHERE id_submenu='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}  
	
	public function pilihmenu ($id)
	{
			$sql="SELECT * FROM menu WHERE id_position='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}  
	
	public function pilihmenu2 ()
	{
			$sql="SELECT * FROM menu order by id_menu asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	/** E:SUBMENU **/ 
	
	/** S:SUBSUBMENU **/  
	public function indexsubsubmenu ($catid, $perPage, $uri)
	{ 	
        $data = array();
        $this->db->select('*,subsubmenu.css as jangkrikcss, subsubmenu.aktif as jangkrik, subsubmenu.urutan as urutjangkrik'); 
		//$this->db->join('menu_position', 'menu_position.id_posisi=menu.id_position', 'left'); 
		$this->db->join('menu', 'menu.id_menu=subsubmenu.id_menu', 'left'); 
		$this->db->join('submenu', 'submenu.id_submenu=subsubmenu.id_submenu', 'left'); 
		$this->db->join('users', 'users.username=subsubmenu.username', 'left'); 
		$this->db->from('subsubmenu'); 
        $this->db->order_by('id_subsubmenu', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
	
	public function pilihsubmenu ($id)
	{
			$sql="SELECT * FROM submenu WHERE id_menu='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	
	public function pilihsubmenu2 ()
	{
			$sql="SELECT * FROM submenu order by id_submenu asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	public function editsubsubmenu ($id)
	{
			$sql="SELECT * FROM subsubmenu WHERE id_subsubmenu='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}   
	/** E:SUBSUBMENU **/ 
	
	/** S:MODUL ADMINISTRATOR **/  
	public function indexmodul ($catid, $perPage, $uri)
	{
		$data = array();
        $this->db->select('*,modul.aktif as jangkrik');
        $this->db->from('modul'); 
		$this->db->join('users', 'users.username=modul.username', 'left'); 
        $this->db->order_by('id_modul', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	 
	public function pilihmodul ()
		{
			$sql="select * from modul order by id_modul asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
		}    
	public function editmodul ($id)
	{
			$sql="SELECT * FROM modul WHERE id_modul='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/** E:MODUL ADMIN **/ 
	
	/** S:MODUL USERS **/  
	public function indexusers ($catid, $perPage, $uri)
	{
		$data = array();
        $this->db->select('*');
        $this->db->from('users');  
        $this->db->order_by('username', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	   
	public function editusers ($id)
	{
			$sql="SELECT * FROM users WHERE id_session='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	public function pilihlevel ()
	{
			$sql="select * from level order by idlevel asc";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 

	public function hakakses ($id)
	{
			$sql="SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul 
	AND users_modul.id_session='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}	
	
	public function tambahakses ($id)
	{
			$sql="SELECT * FROM modul  where id_modul NOT in (select id_modul from users_modul where id_session='".$id."') and publish='Y'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	/** E:MODUL USERS **/ 
	
	/*-------------------- AWAL MODUL PEGAWAI CAMAT----------------*/
	public function indexpegawai ($catid, $perPage, $uri)
	{
		$data = array();
        $this->db->select('*,pegawai.aktif as jangkrik');
        $this->db->from('pegawai'); 
		$this->db->join('users', 'users.username=pegawai.username', 'left'); 
		$this->db->join('jabatanpegawai', 'jabatanpegawai.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->join('golongan', 'golongan.id_pangkat = pegawai.id_pangkat', 'left');
		//$this->db->where('aktif', 'Y');
        $this->db->order_by('jabatanpegawai.id_jabatan', 'asc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}
	
	public function pilihjabatanpegawai ()
	{
		$sql="select * from jabatanpegawai order by id_jabatan asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}
	public function pilihgolongan ()
	{
		$sql="select * from golongan order by id_pangkat asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}   
	public function pilihijazah ()
	{
		$sql="select * from ijazah order by id_ijazah asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}   
	public function editpegawai ($id)
	{
			$sql="SELECT * FROM pegawai WHERE id_pegawai='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}  
	
	/*-------------------- AKHIR MODUL PEGAWAI  ----------------*/
	
	
	/*-------------------- AWAL MODUL JABATANPEGAWAI  ----------------*/
	
	public function indexjabatanpegawai ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,jabatanpegawai.aktif as jangkrik');
        $this->db->from('jabatanpegawai'); 
		$this->db->join('users', 'users.username=jabatanpegawai.username', 'left'); 
        $this->db->order_by('id_jabatan', 'asc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
		
	public function editjabatanpegawai ($id)
	{
			$sql="SELECT * FROM jabatanpegawai WHERE id_jabatan='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	/*-------------------- AKHIR MODUL JABATANPEGAWAI  ----------------*/
	
	/*-------------------- AWAL MODUL IMAGESLLIDE  ----------------*/
	
	public function indeximageslide ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,imageslide.aktif as jangkrik');
        $this->db->from('imageslide'); 
		$this->db->join('users', 'users.username=imageslide.username', 'left'); 
        $this->db->order_by('id_imageslide', 'asc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
		
	public function editimageslide ($id)
	{
			$sql="SELECT * FROM imageslide WHERE id_imageslide='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	}
	
	/*-------------------- AKHIR MODUL IMAGESLLIDE  ----------------*/
	
	/*-------------------- AWAL MODUL JADWALKEGIATAN  ----------------*/ 
	public function indexkegiatan ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,kegiatan.aktif as jangkrik');
        $this->db->from('kegiatan'); 
		$this->db->join('users', 'users.username=kegiatan.username', 'left'); 
        $this->db->order_by('tgl_kegiatan', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
		
	public function editkegiatan ($id)
	{
			$sql="SELECT * FROM kegiatan WHERE id_kegiatan='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL JADWALKEGIATAN  ----------------*/
	
	/*-------------------- AWAL MODUL JADWALKEGIATAN  ----------------*/ 
	public function indexweblink ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,weblink.aktif as jangkrik');
        $this->db->from('weblink'); 
		$this->db->join('users', 'users.username=weblink.username', 'left'); 
        $this->db->order_by('id_weblink', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
		
	public function editweblink ($id)
	{
			$sql="SELECT * FROM weblink WHERE id_weblink='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL JADWALKEGIATAN  ----------------*/
	
	/*-------------------- AWAL MODUL JADWALKEGIATAN  ----------------*/ 
	public function indexpengaduan ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,pengaduan.aktif as jangkrik');
        $this->db->from('pengaduan');  
        $this->db->order_by('id_pengaduan', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
		
	public function editpengaduan ($id)
	{
			$sql="SELECT * FROM pengaduan WHERE id_pengaduan='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL JADWALKEGIATAN  ----------------*/
	
	/*-------------------- AWAL MODUL PENGUMUMAN  ----------------*/ 
	public function indexpengumuman ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,pengumuman.aktif as jangkrik,pengumuman.tanggal as jangkrik2');
        $this->db->from('pengumuman');
		$this->db->join('users', 'users.username=pengumuman.username', 'left'); 
        $this->db->order_by('id_pengumuman', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	} 
	
	public function pilihdownload ()
	{
		$sql="select * from download order by id_download asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}
	
	public function pilihpengumuman ()
	{
		$sql="SELECT * FROM pengumuman where aktif='Y'";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}  
	
	public function editpengumuman ($id)
	{
			$sql="SELECT * FROM pengumuman WHERE id_pengumuman='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL PENGUMUMAN  ----------------*/
	
	/*-------------------- AWAL MODUL TELPON  ----------------*/ 
	public function indextelpon ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,telpon.aktif as jangkrik');
        $this->db->from('telpon');
		$this->db->join('users', 'users.username=telpon.username', 'left'); 
        $this->db->order_by('id_telpon', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}  
	
	public function edittelpon ($id)
	{
			$sql="SELECT * FROM telpon WHERE id_telpon='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL TELPON  ----------------*/
	
	/*-------------------- AWAL MODUL VIDEO  ----------------*/ 
	public function indexvideo ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,video.aktif as jangkrik');
        $this->db->from('video');
		$this->db->join('users', 'users.username=video.username', 'left'); 
        $this->db->order_by('id_video', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}  
	
	public function editvideo ($id)
	{
			$sql="SELECT * FROM video WHERE id_video='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL VIDEO  ----------------*/
	
	/*-------------------- AWAL MODUL PRODUKHUKUM  ----------------*/ 
	public function indexkatprodukhukum ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,katprodukhukum.aktif as jangkrik');
        $this->db->from('katprodukhukum');
		$this->db->join('users', 'users.username=katprodukhukum.username', 'left'); 
        $this->db->order_by('id_katprodukhukum', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}  
	 
	
	public function editkatprodukhukum ($id)
	{
			$sql="SELECT * FROM katprodukhukum WHERE id_katprodukhukum='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL PRODUKHUKUM  ----------------*/
	
	/*-------------------- AWAL MODUL PRODUKHUKUM  ----------------*/ 
	public function indexprodukhukum ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,produkhukum.aktif as jangkrik');
        $this->db->from('produkhukum');
		$this->db->join('katprodukhukum', 'katprodukhukum.id_katprodukhukum=produkhukum.id_katprodukhukum', 'left');
		$this->db->join('users', 'users.username=produkhukum.username', 'left'); 
        $this->db->order_by('id_produkhukum', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}  
	
	public function pilihkatprodukhukum ()
	{
		$sql="select * from katprodukhukum order by id_katprodukhukum asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}  
	
	public function editprodukhukum ($id)
	{
			$sql="SELECT * FROM produkhukum WHERE id_produkhukum='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL PRODUKHUKUM  ----------------*/
	/*-------------------- AWAL MODUL PRODUKHUKUM  ----------------*/ 
	public function indexkatdokumen ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,katdokumen.aktif as jangkrik');
        $this->db->from('katdokumen');
		$this->db->join('users', 'users.username=katdokumen.username', 'left'); 
        $this->db->order_by('id_katdokumen', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}  
	 
	
	public function editkatdokumen ($id)
	{
			$sql="SELECT * FROM katdokumen WHERE id_katdokumen='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL PRODUKHUKUM  ----------------*/
	
	/*-------------------- AWAL MODUL PRODUKHUKUM  ----------------*/ 
	public function indexdokumen ($catid, $perPage, $uri)
	{ 
		$data = array();
        $this->db->select('*,dokumen.aktif as jangkrik');
        $this->db->from('dokumen');
		$this->db->join('katdokumen', 'katdokumen.id_katdokumen=dokumen.id_katdokumen', 'left');
		$this->db->join('users', 'users.username=dokumen.username', 'left'); 
        $this->db->order_by('id_dokumen', 'desc');
		$getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
	}  
	
	public function pilihkatdokumen ()
	{
		$sql="select * from katdokumen order by id_katdokumen asc";
		$hslquery=$this->db->query($sql);
		return $hslquery;
	}  
	
	public function editdokumen ($id)
	{
			$sql="SELECT * FROM dokumen WHERE id_dokumen='".$id."'";
			$hslquery=$this->db->query($sql);
			return $hslquery;
	} 
	/*-------------------- AKHIR MODUL PRODUKHUKUM  ----------------*/
}
 
?>
