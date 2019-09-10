<!-- AWAL SEBUAH CERITA -->
<!DOCTYPE html>
<html lang="en">
<!-- DIMULAI DARI HEAD -->
<head>
    <!-- MULAI META TAGS -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- SELESAI META TAGS -->
    <!-- MULAI JUDUL WEB DAN ICO -->
    <link rel="icon" href="<?php echo base_url(); ?>style/_/img/favicon.png" type="image/png" />
    <title><?php echo $judulapp; ?></title>
    <!-- SELESAI JUDUL WEB DAN ICO -->
    <!-- MULAI GAYA WEB BAWAAN -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/vendors/linericon/style.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/vendors/nice-select/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/vendors/animate-css/animate.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/responsive.css" />
    <!-- SELESAI GAYA WEB BAWAAN -->
</head>
<!-- SELESAI DARI HEAD -->

<!-- MULAI BODY -->
<body>
    <!-- MULAI HEADER -->
    <?php $this->load->view($vheader); ?>
    <!-- SELESAI HEADER -->

    <!-- MULAI MENU NAVIGASI -->
    <!-- MULAI BANNER IMAGE -->
    <section class="home_banner_area banner-area">
        <!-- SELESAi BANNER IMAGE -->
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="banner_content d-flex flex-md-row flex-column">
                            <div class="banner-left text-md-right">
                                <?php
                                if (count($detail_berita->result())>0) {
                                    foreach($detail_berita->result() as $row){
                                      $photopath = str_replace('-', '/', $row->tanggal_modif);
                                      $judul=seo_link($row->nama_kategori);
                                      ?>
                                      <h1 class="text-uppercase"><?php echo $row->nama_kategori; ?></h1>
                                  </div>
                                  <div class="banner-right position-relative">
                                    <p><?php echo $judulapp; ?></p>
                                    <span class="main_btn mt-4 mt-md-0" href="#">
                                        <a href="<?php echo base_url(); ?>" class="text-white">Home</a>
                                        <i class="fa fa-arrow-right mx-2"></i>
                                        <a href="<?php echo base_url(); ?>berita" class="text-white"><?php echo $judulan; ?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- SELESAI MENU NAVIGASI -->
        <!-- MULAI ISI -->
        <section class="blog_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">
                            <!-- MULAI KONTEN-->
                            <article class="blog_item">
                                <?php
                                if (count($artikel)) {
                                    ?>
                                    <?php
                                    $no=1;
                                    foreach($artikel as $key => $row){
                                        $isi=strip_tags($row['isi_berita']);
                                        $isi=substr($isi,0,220);
                                        $judul=seo_link($row['judul']);
                                        $photopath = str_replace('-', '/', $row['tanggal_modif']);
                                        $a=substr($row['tanggal'], 0,4);
                                        $b=substr($row['tanggal'], 5,2);
                                        $c=substr($row['tanggal'], 8,9);
                                        $tanggal=$c.'/'.$b.'/'.$a;

                                        if  ($row['gambar']!='') {
                                            $gambar=base_url() ."foto_berita/".$photopath."/small_".$row['gambar'];
                                        }
                                        else {
                                            $gambar=base_url() ."foto_berita/image-default.jpg";
                                        } ?>
                                        <div class="blog_item_img">
                                            <img class="card-img rounded-0" src="<?php echo $gambar; ?>" alt="">
                                            <a href="<?php echo base_url(); ?>berita/detail/<?php echo $row['id_berita']."/".$judul."/";?>" class="blog_item_date">
                                                <h3><?php echo tgl_indo('d'); ?></h3>
                                                <p><?php echo tgl_indo('M'); ?></p>
                                            </a>
                                        </div>
                                        <div class="blog_details">
                                            <a class="d-inline-block" href="<?php echo base_url(); ?>berita/detail/<?php echo $row['id_berita']."/".$judul."/";?>">
                                                <h2><?php echo $row['judul']; ?></h2>
                                            </a>
                                            <p><?php echo $isi; ?>...</p>
                                            <ul class="blog-info-link">
                                                <li><?php echo nama_hari($row['tanggal']).', ';?><span class="fw-b fc-gray"><?php   echo tgl_indo($row['tanggal']).' | '; echo $row['jam'].' WIB '; ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php $no=$no+1; } ?>
                                    <?php } else { ?>
                                      <h4 >Maaf, Data Belum Tersedia !</h4>
                                  <?php } ?>
                              </article>
                              <!-- SELESAI KONTEN -->
                              <!-- MULAI PAGINATION -->
                              <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    <li class="page-item"><?php echo $pagination; ?></li>
                                </ul>
                            </nav>
                            <!-- SELESAI PAGINATION -->
                        </div>
                    </div>


                    <?php $this->load->view("v_footer"); ?>
                    <!-- MULAI JAVASCRIPT -->
                    <script src="<?php echo base_url(); ?>style/_/js/jquery-3.2.1.min.js"></script>
                    <script src="<?php echo base_url(); ?>style/_/js/popper.js"></script>
                    <script src="<?php echo base_url(); ?>style/_/js/bootstrap.min.js"></script>
                    <script src="<?php echo base_url(); ?>style/_/vendors/nice-select/js/jquery.nice-select.min.js"></script>
                    <script src="<?php echo base_url(); ?>style/_/vendors/isotope/isotope-min.js"></script>
                    <script src="<?php echo base_url(); ?>style/_/vendors/owl-carousel/owl.carousel.min.js"></script>
                    <script src="<?php echo base_url(); ?>style/_/js/jquery.ajaxchimp.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
                    <script src="<?php echo base_url(); ?>style/_/js/mail-script.js"></script>
                    <script src="<?php echo base_url(); ?>style/_/js/custom.js"></script>
                    <!-- SELESAI JAVASCRIPT -->
                </body>
                <!-- SELESAI BODY -->
                </html>
<!-- ### AKHIR DARI SEMUA CERITA ### -->