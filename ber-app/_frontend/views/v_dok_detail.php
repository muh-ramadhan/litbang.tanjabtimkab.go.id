        <!-- MULAI MINI IKLAN HEADER -->
        <section class="breadcrumb breadcrumb_bg">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                  <div class="breadcrumb_iner_item">
                    <?php
                    if (count($detail_berita)) {
                      foreach($detail_berita as $row){
                        $judul=seo_link($row->nama_katdokumen);
                        ?>
                        <h2><?php echo $judulan; ?></h2>
                        <p>
                          <a href="<?php echo base_url(); ?>" class="text-white">Home</a>
                          <span>//</span>
                          <a href="<?php echo base_url(); ?>dok" class="text-white">Semua Dokumen</a>
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
                        <div class="section-top-border">
                          <h3 class="mb-30"><?php echo $judulan;?></h3>
                          <p><?php echo $postingby; ?></p>
                          <br>
                          <br>
                          <table class="ver-zebra2">
                            <colgroup> <col class="oce-first"></colgroup>
                            <tbody>
                              <tr>
                                <td width="200">Tahun Dokumen</td>
                                <td width="500">: <strong> <?php echo $row->tahun; ?> </strong></td>
                              </tr>
                              <tr></tr>
                              <tr>
                                <td>Keterangan</td>
                                <td> : <?php echo $row->jangkrik; ?></td>
                              </tr>
                              <tr>
                                <td>Tanggal Upload</td>
                                <td> : <?php
                                $tanggal=$row->tgl_upload;
                                echo nama_hari($tanggal).', ';
                                echo tgl_indo($tanggal);
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Didownload</td>
                              <td> :  <?php echo $row->dibaca; ?> Kali</td>
                            </tr>
                            <tr>
                              <td>Link File</td>
                              <td>:   <?php if ($row->metode_link==1) { ?>
                                <a href="<?php echo base_url(); ?>dokumenumen/<?php echo $row->nama_file;?>" target="_blank"><b>Download</b></a>
                              <?php } else { ?>
                                <a href="<?php echo $row->link_file; ?>" target="_blank"><b>Download</b></a>
                              <?php } ?>
                            </td></tr>
                          </tbody>
                        </table>
                        <?php
                      }}
                      ?>
                    </article>
                  </div>
                </div>