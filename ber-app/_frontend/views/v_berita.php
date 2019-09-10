<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $judulapp; ?></title>
    <link rel="icon" href="<?php echo base_url(); ?>style/_/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/_/css/style.css">
</head>

<body>
    <!-- MULAi :: HEADER -->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <?php
                        $identitas = $this->M_data->identitasfooter();
                        foreach($identitas->result() as $row) {
                            ?>
                            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                                <img src="<?php echo base_url()?>style/images/<?php echo $row->logo; ?>" alt="logo">
                            </a>
                        <?php } ?>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <?php
                                $menu = $this->M_data->ambilmenu(2);
                                foreach($menu->result() as $row){
                                    ?>
                                    <li class="nav-item dropdown">
                                        <a href="<?php echo base_url();  echo $row->link;?>" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row->nama_menu; ?></a>
                                        <?php
                                        $submenu = $this->M_data->ambilsubmenu('',$row->id_menu);
                                        ?>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php
                                            foreach($submenu->result() as $sub){
                                                $lin1=substr($sub->link_submenu, 0, 3);
                                                if ($lin1!="htt") {
                                                    $link1=base_url().$sub->link_submenu;
                                                }
                                                else {
                                                    $link1=$sub->link_submenu;
                                                }
                                                ?>
                                                <a class="dropdown-item" href="<?php echo $link1; ?>"><?php echo $sub->nama_submenu; ?></a>
                                            <?php } ?>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- SELESAI :: HEADER -->

    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Semua Berita</h2>
                            <p>Home<span>/</span>Semua Berita</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Blog Area =================-->
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
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
                                    }else {
                                        $gambar=base_url() ."foto_berita/image-default.jpg";
                                    }
                                    ?>
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="<?php echo $gambar; ?>" alt="">
                                        <a href="<?php echo base_url(); ?>berita/detail/<?php echo $row['id_berita']."/".$judul."/";?>" class="blog_item_date">
                                            <h3><?php echo tgl_indo('d'); ?></h3>
                                            <p><?php echo tgl_indo('M'); ?></p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="<?php echo base_url(); ?>berita/detail/<?php echo $row['id_berita']."/".$judul."/";?>" class="blog_item_date">
                                            <h2><?php echo $row['judul']; ?></h2>
                                        </a>
                                        <p><?php echo $isi; ?>...</p>
                                        <ul class="blog-info-link">
                                           <li><?php echo nama_hari($row['tanggal']).', ';?><span class="fw-b fc-gray"><?php   echo tgl_indo($row['tanggal']).' | '; echo $row['jam'].' WIB '; ?></li>
                                           </ul>
                                       </div>
                                       <?php
                                       $no=$no+1;}
                                       ?>
                                       <?php
                                   }else {
                                    ?>
                                    <h4 >Maaf, Data Belum Tersedia !</h4>
                                    <?php
                                }
                                ?>
                            </article>

                            <!-- MULAI PAGINATION -->
                            <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <?php echo $pagination; ?>
                                    </li>
                                </ul>
                            </nav>
                            <!-- SELESAI PAGINATION -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Area =================-->

        <!-- MULAI :: FOOTER -->
        <footer class="footer-area">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <div class="single-footer-widget footer_1">
                            <?php
                            $identitas = $this->M_data->identitasfooter();
                            foreach($identitas->result() as $row) {
                                ?>
                                <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>style/images/<?php echo $row->logo; ?>" alt=""></a>
                                <p><?php echo $row->meta_deskripsi; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-xl-4">
                        <div class="single-footer-widget footer_2">
                            <h4>Berlangganan</h4>
                            <p>Dapatkan informasi update terbaru <?php echo $judulapp; ?> melalui email anda
                            </p>
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Masukkan email anda'
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Masukkan email anda'">
                                        <div class="input-group-append">
                                            <button class="btn btn_1" type="button"><i class="ti-angle-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="social_icon">
                                <a href="#"> <i class="ti-facebook"></i> </a>
                                <a href="#"> <i class="ti-twitter-alt"></i> </a>
                                <a href="#"> <i class="ti-instagram"></i> </a>
                                <a href="#"> <i class="ti-skype"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-md-4">
                        <div class="single-footer-widget footer_2">
                            <h4>Alamat Kantor</h4>
                            <div class="contact_info">
                                <?php
                                $identitas = $this->M_data->identitasfooter();
                                foreach($identitas->result() as $row) {
                                    ?>
                                    <p><span>Alamat : </span><?php echo $row->alamat; ?></p>
                                    <p><span>Telp/Fax : </span> <?php echo $row->no_telp; ?></p>
                                    <p><span>E-Mail : </span> <?php echo $row->email; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright_part_text text-center">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="footer-text m-0"> Copyright &copy; <script>document.write(new Date().getFullYear());</script> <?php echo $judulapp; ?> | <a href="https://#/" target="_blank">Diskominfo IT Developer</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- SELESAI :: FOOTER <-->

        <!-- jquery plugins here-->
        <!-- jquery -->
        <script src="<?php echo base_url(); ?>style/_/js/jquery-1.12.1.min.js"></script>
        <!-- popper js -->
        <script src="<?php echo base_url(); ?>style/_/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="<?php echo base_url(); ?>style/_/js/bootstrap.min.js"></script>
        <!-- easing js -->
        <script src="<?php echo base_url(); ?>style/_/js/jquery.magnific-popup.js"></script>
        <!-- swiper js -->
        <script src="<?php echo base_url(); ?>style/_/js/swiper.min.js"></script>
        <!-- swiper js -->
        <script src="<?php echo base_url(); ?>style/_/js/masonry.pkgd.js"></script>
        <!-- particles js -->
        <script src="<?php echo base_url(); ?>style/_/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url(); ?>style/_/js/jquery.nice-select.min.js"></script>
        <!-- swiper js -->
        <script src="<?php echo base_url(); ?>style/_/js/slick.min.js"></script>
        <script src="<?php echo base_url(); ?>style/_/js/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url(); ?>style/_/js/waypoints.min.js"></script>
        <!-- custom js -->
        <script src="<?php echo base_url(); ?>style/_/js/custom.js"></script>
    </body>

    </html>