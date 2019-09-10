<!-- AWAL SEBUAH CERITA -->
<!doctype html>
<html lang="en">

<!-- DIMULAI DARI HEAD -->
<head>
  <!-- MULAI META TAGS -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- SELESAI META TAGS -->
  <!-- MULAI JUDUL WEB DAN ICO -->
  <title><?php echo $judulapp; ?></title>
  <link rel="icon" href="<?php echo base_url(); ?>style/_/img/favicon.png">
  <!-- SELESAI JUDUL WEB DAN ICO -->
  <!-- MULAI GAYA WEB BAWAAN -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/animate.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/flaticon.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/magnific-popup.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/slick.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/all.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/style.css">
  <!-- SELESAI GAYA WEB BAWAAN -->
</head>
<!-- SELESAI DARI HEAD -->
<!-- MULAI BODY -->

<body>

<?php $this->load->view("v_header"); ?>

<!-- MULAI PAPAN IKLAN -->
<section class="banner_part">
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <div class="col-xl-6 col-md-6">
        <div class="banner_text">
          <div class="banner_text_iner text-center">
            <h3>Balitbangda</h3>
            <h4><b>Ba</b>dan Pene<b>li</b>tian dan Pengem<b>bang</b>an <b>Da</b>erah</h4>
            <a href="<?php echo base_url(); ?>profil/detail/4/sejarah" class="btn_1">Tentang Kami <i class="ti-angle-right"></i> </a>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-md-6">
        <div class="banner_bg">
          <img src="<?php echo base_url(); ?>style/_/img/banner_img.png" alt="banner">
        </div>
      </div>
    </div>
  </div>
  <div class="hero-app-1 custom-animation"><img src="<?php echo base_url(); ?>style/_/img/animate_icon/icon_1.png" alt=""></div>
  <div class="hero-app-5 custom-animation2"><img src="<?php echo base_url(); ?>style/_/img/animate_icon/icon_3.png" alt=""></div>
  <div class="hero-app-7 custom-animation3"><img src="<?php echo base_url(); ?>style/_/img/animate_icon/icon_2.png" alt=""></div>
  <div class="hero-app-8 custom-animation"><img src="<?php echo base_url(); ?>style/_/img/animate_icon/icon_4.png" alt=""></div>
</section>
<!-- SELESAI PAPAN IKLAN -->

<!-- MULAI DAFTAR APLIKASI -->
<section class="cta_part">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-12">
        <div class="cta_part_iner">
          <div class="cta_part_text">
            <p>Fitur Daftar Aplikasi</p>
            <h1>Daftar Aplikasi</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="service_part section_bg_2 section_padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-sm-6">
        <div class="single_service_part">
          <div class="single_service_part_iner">
            <span class="ti-mobile"></span>
            <a href="http://lpse.tanjabtimkab.go.id" target="_blank">
              <h3>LPSE</h3>
            </a>
            <p>Layanan Pengadaan Secara Elektronik</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="single_service_part">
          <div class="single_service_part_iner">
            <span class="ti-email"></span>
            <a href="http://surat.tanjabtimkab.go.id" target="_blank">
              <h3>e-Office / Surat</h3>
            </a>
            <p>Aplikasi Surat Menyurat Elektronik</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="single_service_part">
          <div class="single_service_part_iner">
            <span class="ti-lock"></span>
            <a href="http://sippd.tanjabtimkab.go.id" target="_blank">
              <h3>e-Planning / SIPPD</h3>
            </a>
            <p>Sistem Informasi Perencanaan Pembangunan Daerah</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="single_service_part">
          <div class="single_service_part_iner">
            <span class="ti-blackboard"></span>
            <a href="http://sipm.tanjabtimkab.go.id" target="_blank">
              <h3>SIPM</h3>
            </a>
            <p>Sistem Informasi Penduduk Miskin</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- SELESAI DAFTAR APLIKASI -->

<!-- MULAI BERITA -->
<section class="about_part">
  <div class="container-fluid">
    <div class="row align-items-center">
      <?php
      $no=1;
      $beritaterbaru = $this->M_data->beritaterbaru2(0,1);
      foreach($beritaterbaru->result() as $row){
        $isi=strip_tags($row->isi_berita);
        $isi=substr($isi,0,180);
        $judul=seo_link($row->judul);
        $judulan=seo_link($row->nama_kategori);
        $photopath = str_replace('-', '/', $row->tanggal_modif);
        $a=substr($row->tanggal, 0,4);
        $b=substr($row->tanggal, 5,2);
        $c=substr($row->tanggal, 8,9);
        $tanggal=$c.'/'.$b.'/'.$a;
        if  ($row->gambar!='') {
          $gambar=base_url() ."foto_berita/".$photopath."/".$row->gambar;
        }
        else {
          $gambar=base_url() ."foto_berita/image-default.jpg";
        }

        ?>
        <div class="col-lg-5">
          <img src="<?php echo $gambar; ?>" alt="">
        </div>
        <div class="offset-lg-1 col-lg-4">
          <div class="about_text">
            <h5>Update Berita Terbaru</h5>
            <h2><?php echo $row->judul; ?></h2>
            <p><?php echo $isi; ?></p>
            <a href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul;?>" class="btn_1">Selengkapnya <i class="ti-angle-right"></i> </a>
          </div>
        </div>
        <?php
        $no=$no+1;
      } ?>
    </div>
  </div>
  <div class="hero-app-7 custom-animation"><img src="<?php echo base_url(); ?>style/_/img/animate_icon/icon_7.png" alt=""></div>
  <div class="hero-app-8 custom-animation2"><img src="<?php echo base_url(); ?>style/_/img/animate_icon/icon_4.png" alt=""></div>
  <div class="hero-app-6 custom-animation3"><img src="<?php echo base_url(); ?>style/_/img/animate_icon/icon_5.png" alt=""></div>
</section>
<!-- SELESAI BERITA -->

<!-- MULAI ARTIKEL DAN MULTIMEDIA -->
<section class="our_latest_work section_padding">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="section_tittle text-center">
          <p>Update Terbaru Artikel dan Multimedia</p>
          <h2>Artikel dan Multimedia</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?php
        $no=1;
        $artikel = $this->M_data->artikelterbaru2(0,1);
        foreach($artikel->result() as $row){
          $isi=strip_tags($row->isi_artikel);
          $isi=substr($isi,0,180);
          $judul=seo_link($row->judul);
          $judulan=seo_link($row->nama_kategori);
          $photopath = str_replace('-', '/', $row->tanggal_modif);
          $a=substr($row->tanggal, 0,4);
          $b=substr($row->tanggal, 5,2);
          $c=substr($row->tanggal, 8,9);
          $tanggal=$c.'/'.$b.'/'.$a;
          if  ($row->gambar!='') {
            $gambar=base_url() ."foto_artikel/".$photopath."/".$row->gambar;
          }
          else {
            $gambar=base_url() ."foto_berita/image-default.jpg";
          }
          ?>
          <div class="single_work">
            <div class="row align-items-center">

              <div class="offset-lg-1 col-lg-4 col-md-6">
                <div class="single_work_demo">
                  <h5><?php echo $row->hari; ?>,  <?php echo tgl_indo($row->tanggal); ?> | <?php echo $row->jam; ?></h5>
                  <h3><?php echo $row->judul; ?></h3>
                  <p><?php echo $isi; ?>...</p>
                  <a href="<?php echo base_url(); ?>artikel/detail/<?php echo $row->id_artikel."/".$judul;?>" class="btn_3">Selengkapnya<span class="flaticon-slim-right"></span> </a>
                </div>
              </div>
              <div class="offset-lg-1 col-lg-6 col-md-6">
                <div class="demo_img">
                  <img src="<?php echo $gambar; ?>" alt="<?php echo $row->judul; ?>">
                </div>
              </div>
            </div>
          </div>
          <?php
          $no=$no+1;
        } ?>

        <?php
        $no=1;
        $artikel = $this->M_data->artikelterbaru2(1,1);
        foreach($artikel->result() as $row){
          $isi=strip_tags($row->isi_artikel);
          $isi=substr($isi,0,180);
          $judul=seo_link($row->judul);
          $judulan=seo_link($row->nama_kategori);
          $photopath = str_replace('-', '/', $row->tanggal_modif);
          $a=substr($row->tanggal, 0,4);
          $b=substr($row->tanggal, 5,2);
          $c=substr($row->tanggal, 8,9);
          $tanggal=$c.'/'.$b.'/'.$a;
          if  ($row->gambar!='') {
            $gambar=base_url() ."foto_artikel/".$photopath."/".$row->gambar;
          }
          else {
            $gambar=base_url() ."foto_berita/image-default.jpg";
          }
          ?>
          <div class="single_work">
            <div class="row align-items-center">
              <div class="col-lg-6 col-md-6">
                <div class="demo_img">
                  <img src="<?php echo $gambar; ?>" alt="<?php echo $row->judul; ?>">
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="single_work_demo">
                  <h5><?php echo $row->hari; ?>,  <?php echo tgl_indo($row->tanggal); ?> | <?php echo $row->jam; ?></h5>
                  <h3><?php echo $row->judul; ?></h3>
                  <p><?php echo $isi; ?>...</p>
                  <a href="<?php echo base_url(); ?>artikel/detail/<?php echo $row->id_artikel."/".$judul;?>" class="btn_3">Selengkapnya <span class="flaticon-slim-right"></span> </a>
                </div>
              </div>
            </div>
          </div>
          <?php
          $no=$no+1;
        } ?>
      </div>
    </div>
  </div>
</section>
<!-- SELESAI ARTIKEL DAN MULTIMEDIA -->

<!-- MULAI BERHITUNG -->
<section class="happy_client">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-sm-6">
        <div class="single_happy_client">
          <img src="<?php echo base_url(); ?>style/_/img/icon/cap.svg" alt="cap">
          <span class="counter"><?php echo $jumlah_kegiatan ?></span>
          <h4>Kegiatan</h4>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="single_happy_client">
          <img src="<?php echo base_url(); ?>style/_/img/icon/bag.svg" alt="cap">
          <span class="counter"><?php echo $jumlah_artikel ?></span>
          <h4>Artikel</h4>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="single_happy_client">
          <img src="<?php echo base_url(); ?>style/_/img/icon/shirt.svg" alt="cap">
          <span class="counter"><?php echo $jumlah_berita ?></span>
          <h4>Berita</h4>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="single_happy_client">
          <img src="<?php echo base_url(); ?>style/_/img/icon/cafe.svg" alt="cap">
          <span class="counter"><?php echo $jumlah_pengumuman ?></span>
          <h4>Pengumuman</h4>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- SELESAI BERHITUNG -->

<!-- MULAI PENGUMUMAN -->
<section class="review_part padding_top">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="section_tittle text-center">
          <p>Pengumuman Terbaru</p>
          <h2>Pengumuman</h2>
        </div>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-lg-5">
        <div class="intro_video_bg">
          <div class="intro_video_iner text-center">
            <div class="intro_video_icon">
              <a id="play-video_1" class="video-play-button popup-youtube"
              href="https://www.youtube.com/watch?v=pBFQdxA-apI">
              <span class="ti-control-play"></span>
            </a>
          </div>
          <p>Video Terbaru</p>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-lg-5">
      <div class="review_text_item">
        <?php
        $pengumuman=$this->M_data->pengumuman(3);
        foreach($pengumuman->result() as $row){
          $judul=seo_link($row->judul);
          $tahunp=substr($row->tanggal_pengumuman, 0,4);
          $bulanp=substr($row->tanggal_pengumuman, 5,2);
          $tanggalp=substr($row->tanggal_pengumuman, 8,10);
          $photopath = str_replace('-', '/', $row->tanggal_pengumuman);
          ?>
          <div class="client_review_text">
            <h3> <a href="<?php echo base_url(); ?>pengumuman/detail/<?php echo $row->id_pengumuman."/".$judul;?>"><?php echo $row->judul; ?></a></h3>
            <p><?php echo $tanggalp; ?>/<?php echo $bulanp; ?>/<?php echo $tahunp; ?> Jam <?php echo $row->jam; ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</section>
<!-- SELESAI PENGUMUMAN -->

<!-- MULAI GALERI KEGIATAN -->
<section class="blog_part section_padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-5">
        <div class="section_tittle text-center">
          <p>Kegiatan Terbaru</p>
          <h2>Galeri Kegiatan</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      $fotokolom=$this->M_data->fotokolom(0,3);
      foreach($fotokolom->result() as $row){
        $isi=strip_tags($row->keterangan);
        $isi=substr($isi,0,140);
        $judul=seo_link($row->judul_fotoberita);
        $photopath = str_replace('-', '/', $row->tanggal_modif);
        $a=substr($row->tanggal, 0,4);
        $b=substr($row->tanggal, 5,2);
        $c=substr($row->tanggal, 8,9);
        $tanggal=$c.'/'.$b.'/'.$a;
        ?>
        <div class="col-sm-6 col-lg-4 col-xl-4">
          <div class="single-home-blog">
            <div class="card">
              <img src="<?php echo base_url(); ?>foto_galeri/<?php echo$photopath; ?>/small_<?php echo $row->gbr_gallery;?>" class="card-img-top" alt="" style="width: 350px; height: 311px;">
              <div class="card-body">
                <span>Tanggal : <?php echo $tanggal; ?></span>
                <a href="<?php echo base_url(); ?>galeri/detail/<?php echo $row->id_fotoberita; ?>/<?php echo seo_link($row->judul_fotoberita); ?>">
                  <h5 class="card-title"><?php echo $row->judul_fotoberita; ?></h5>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<!-- SELESAI GALERI -->

<?php $this->load->view("v_footer"); ?>

  <!-- MULAI JAVASCRIPT BAWAAN -->
  <script src="<?php echo base_url(); ?>style/_/js/jquery-1.12.1.min.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/jquery.magnific-popup.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/swiper.min.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/masonry.pkgd.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/jquery.counterup.min.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/owl.carousel2.thumbs.min.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/slick.min.js"></script>
  <script src="<?php echo base_url(); ?>style/_/js/custom.js"></script>
  <!-- SELESAI JAVASCRIPT BAWAAN -->
</body>
<!-- SELESAI BODY -->
</html>
<!-- AKHIR DARI SEBUAH CERITA YANG PANJANG --->