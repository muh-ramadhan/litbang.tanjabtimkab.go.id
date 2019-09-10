    <!-- MULAI MINI IKLAN HEADER -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2><?php echo $judulapp; ?></h2>
                            <p>
                                <a href="<?php echo base_url(); ?>" class="text-white">Home</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SELESAI MINI IKLAN HEADER -->

    <!-- MULAI ISI -->
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                          <?php if (count($detail_berita)) {
                           foreach($detail_berita  as $row){
                               $photopath = str_replace('-', '/', $row->tanggal_modif);
 //$judul=seo_link($row->nama_kategori);
                               ?>

                               <div class="blog_item_img">
                                  <?php if  ($row->gambar!='') {?>
                                    <img class="card-img rounded-0" src="<?php echo base_url(); ?>foto_halamanprofil/<?php echo $photopath; ?>/<?php echo $row->gambar; ?>" alt="">
                                <?php } ?>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="#" class="blog_item_date">
                                    <h2><?php echo $row->judul; ?></h2>
                                </a>
                                <p><?php echo $row->isi_halaman;  ?></p>
                                <ul class="blog-info-link">
                                 <li><?php
                                 $tanggal=$row->tgl_posting;
                                 echo nama_hari($tanggal).', ';
                                 echo tgl_indo($tanggal).' | ';
                                 echo $row->jam.' WIB ';
                                 ?> | Dibaca: <?php echo $row->dibaca; ?> Kali</li>
                             </ul>
                         </div>
                         <?php
                     }}
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