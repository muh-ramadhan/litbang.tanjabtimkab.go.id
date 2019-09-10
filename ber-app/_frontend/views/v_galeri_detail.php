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
            <div class="section-top-border">
              <h3><?php echo $judulan; ?></h3>
              <p>Tanggal Kegiatan : <b><?php $tanggal=$this->M_data->tanggalalbum($this->uri->segment(3,0)); echo tgl_indo($tanggal); ?></b></p>
              <div class="row gallery-item">
                <?php
                foreach($detail_album->result() as $row){
                  $photopath = str_replace('-', '/', $row->tanggal_modif);
                  ?>
                  <div class="col-md-4">
                    <a href="<?php echo base_url(); ?>foto_galeri/<?php echo $photopath; ?>/small_<?php echo $row->gbr_gallery; ?>" class="img-pop-up">
                      <div class="single-gallery-image" style="background: url(<?php echo base_url(); ?>foto_galeri/<?php echo $photopath; ?>/small_<?php echo $row->gbr_gallery; ?>);"></div>
                    </a>
                  </div>
                <?php }?>
                <?php
                $id=$row->id_fotoberita;
                $ip_addr = $this->input->ip_address();

                $data = array('dibaca' => $row->dibaca + 1);
                $where = "id_fotoberita = '".$this->uri->segment(3,0)."'";
                $str = $this->db->update('fotoberita', $data, $where);
                ?>
              </div>
            </div>
          </div>