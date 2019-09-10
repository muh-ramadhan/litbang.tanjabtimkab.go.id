    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Berita Terkini</h2>
                            <p><a href="<?php echo base_url(); ?>">Home</a><span>/</span><a href="<?php echo base_url(); ?>berita">Semua Berita</a></p>
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