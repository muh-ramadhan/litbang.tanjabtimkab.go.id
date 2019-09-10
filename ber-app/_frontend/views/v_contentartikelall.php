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
                                  <h1 class="text-uppercase"><?php echo $judulan; ?></h1>
                              </div>
                              <div class="banner-right position-relative">
                                <p><?php echo $judulapp; ?></p>
                                <span class="main_btn mt-4 mt-md-0" href="#">
                                    <a href="<?php echo base_url(); ?>" class="text-white">Home</a>
                                    <i class="fa fa-arrow-right mx-2"></i>
                                    <a href="<?php echo base_url(); ?>artikel" class="text-white"><?php echo $judulan; ?></a>
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
                        <article class="blog_item">
                            <?php
                            if (count($artikel)) {
                                ?>

                                <?php
                                $no=1;
                                foreach($artikel as $key => $row){
                                    $isi=strip_tags($row['isi_artikel']);
                                    $isi=substr($isi,0,220);
                                    $judul=seo_link($row['judul']);
                                    $photopath = str_replace('-', '/', $row['tanggal_modif']);
                                    $a=substr($row['tanggal'], 0,4);
                                    $b=substr($row['tanggal'], 5,2);
                                    $c=substr($row['tanggal'], 8,9);
                                    $tanggal=$c.'/'.$b.'/'.$a;

                                    if  ($row['gambar']!='') {
                                        $gambar=base_url() ."foto_artikel/".$photopath."/small_".$row['gambar'];
                                    } else {
                                        $gambar=base_url() ."foto_artikel/image-default.jpg";
                                    }
                                    ?>
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="<?php echo $gambar; ?>" alt="">
                                        <a href="<?php echo base_url(); ?>artikel/detail/<?php echo $row['id_artikel']."/".$judul."/";?>" class="blog_item_date">
                                            <h3><?php echo tgl_indo('d'); ?></h3>
                                            <p><?php echo tgl_indo('M'); ?></p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="<?php echo base_url(); ?>artikel/detail/<?php echo $row['id_artikel']."/".$judul."/";?>" class="blog_item_date">
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
                            <!-- SELESAI ISI -->
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