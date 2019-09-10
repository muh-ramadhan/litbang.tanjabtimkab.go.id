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
                  if (count($detail_artikel->result())>0) {
                    foreach($detail_artikel->result() as $row){
                      $photopath = str_replace('-', '/', $row->tanggal_modif);
                      $judul=seo_link($row->nama_kategori);
                      ?>
                      <h1 class="text-uppercase">Artikel & Multimedia</h1>
                    </div>
                    <div class="banner-right position-relative">
                      <p><?php echo $judulapp; ?></p><br>
                      <span class="main_btn mt-4 mt-md-0" href="#">
                        <a href="<?php echo base_url(); ?>" class="text-white">Home</a>
                        <i class="fa fa-arrow-right mx-2"></i>
                        <a href="<?php echo base_url(); ?>artikel" class="text-white">Semua Artikel</a>
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
                    <div class="blog_item_img">
                      <?php if  ($row->gambar!='') {?>
                        <img class="card-img rounded-0" src="<?php echo base_url(); ?>foto_artikel/<?php echo $photopath; ?>/<?php echo $row->gambar; ?>" alt="">
                      <?php }else {?>
                        <img class="card-img rounded-0" src="<?php echo base_url(); ?>foto_artikel/image-default-big.jpg" alt="">
                      <?php }?>
                      <a href="#" class="blog_item_date">
                        <h3><?php echo $row->dibaca; ?> x</h3>
                        <p>Dibaca</p>
                      </a>
                    </div>

                    <div class="blog_details">
                      <a class="d-inline-block" href="#" class="blog_item_date">
                        <h2><?php echo $row->judul; ?></h2>
                      </a>
                      <p><?php echo $row->isi_artikel;  ?></p>
                      <ul class="blog-info-link">
                       <li><?php
                       $tanggal=$row->tanggal;
                       echo nama_hari($tanggal).', ';
                       echo tgl_indo($tanggal).' | ';
                       echo $row->jam.' WIB ';
                       ?></li>
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