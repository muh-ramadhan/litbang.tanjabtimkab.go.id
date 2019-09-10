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
                  <span>//</span>
                  <a href="<?php echo base_url(); ?>galeri" class="text-white">Semua Galeri Kegiatan</a>
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
                <?php
                if (count($artikel)) {
                  foreach($artikel  as $row){
                    $isi=strip_tags($row['keterangan']);
                    $isi=substr($isi,0,140);
                    $judul=seo_link($row['judul_fotoberita']);
                    $photopath = str_replace('-', '/', $row['tanggal_modif']);
                    $a=substr($row['tanggal'], 0,4);
                    $b=substr($row['tanggal'], 5,2);
                    $c=substr($row['tanggal'], 8,9);
                    $tanggal=$c.'/'.$b.'/'.$a;
                    ?>
                    <div class="blog_item_img">
                      <img class="card-img rounded-0" src="<?php echo base_url(); ?>foto_galeri/<?php echo $photopath; ?>/small_<?php echo $row['gbr_gallery'];?>" alt="" height="400px">
                      <a href="<?php echo base_url(); ?>galeri/detail/<?php echo $row['id_fotoberita']; ?>/<?php echo seo_link($row['judul_fotoberita']); ?>" class="blog_item_date">
                        <h3 style="text-align: center;"><?php echo $row['jumlah']; ?></h3>
                        <p style="text-align: center;">Foto</p>
                      </a>
                    </div>

                    <div class="blog_details">
                      <a class="d-inline-block" href="<?php echo base_url(); ?>galeri/detail/<?php echo $row['id_fotoberita']; ?>/<?php echo seo_link($row['judul_fotoberita']); ?>" class="blog_item_date">
                        <h2><?php echo $row['judul_fotoberita']; ?></h2>
                      </a>
                      <ul class="blog-info-link">
                       <li><?php echo nama_hari($row['tanggal']).', ';?><?php   echo tgl_indo($row['tanggal']).' | '; echo $row['jam'].' WIB '; ?></li>
                     </ul>
                   </div>
                 <?php }} ?>
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