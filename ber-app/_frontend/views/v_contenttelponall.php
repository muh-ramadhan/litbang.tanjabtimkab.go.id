    <!-- MULAI MINI IKLAN HEADER -->
    <section class="breadcrumb breadcrumb_bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb_iner text-center">
              <div class="breadcrumb_iner_item">
                <h2><?php echo $judulan; ?></h2>
                <p>
                  <a href="<?php echo base_url(); ?>" class="text-white">Home</a>
                  <span>//</span>
                  <a href="<?php echo base_url(); ?>telpon" class="text-white"><?php echo $judulan; ?></a>
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
              <!-- MULAI GAYA KOSTUM -->
              <style>
              .accordion {
                background-color: #eee;
                color: #444;
                cursor: pointer;
                padding: 18px;
                width: 100%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 15px;
                transition: 0.4s;
              }
              .active, .accordion:hover {
                background-color: #ccc;
              }
              .panel {
                padding: 0 18px;
                display: none;
                background-color: white;
                overflow: hidden;
              }
            </style>
            <!-- SELESAI GAYA KOSTUM -->

            <div class="content grid_9 allberita marked-category">
              <div class="single-page">
                <div class="box-single-content">
                  <h3 class="rs single-title">Telpon-telpon Penting</h3>
                  <p class="rs post-by"><?php echo $postingby; ?></p>
                  <?php
                  if (count($artikel)) {
                    ?>
                    <br>
                    <div id="no-more-tables" style="*padding:15px;margin:0 auto;">
                      <table class="col-md-12 table-bordered table-striped table-condensed cf" style="margin-bottom:15px;">
                        <thead class="cf">
                          <tr bgcolor="#F2F2F2" align="left">
                            <th width="4% !important"><center>No</center></th>
                            <th width="25% !important">Nama Instansi</th>
                            <th width="16% !important"><center>Telpon</center></th>
                            <th width="13% !important">Alamat</th>
                            <th width="8% !important"><center>Website/Keterangan</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($this->uri->segment(4)!=null) {
                            $no=15*($this->uri->segment(4)-1)+1;
                          }
                          else {
                            $no=1;
                          }
                          foreach($artikel  as $row){
                            if($no%2 == 0) {
                              $background='#FCFCFC';
                            }
                            else {
                              $background='#fff';
                            }
                            ?>

                            <tr class="ok" bgcolor="<?php echo $background; ?>">
                              <td data-title="No"><center><?php echo $no; ?></center></td>
                              <td  data-title="Nama Instansi"><b><?php echo $row['nama_telpon']; ?></b></td>
                              <td align="center" data-title="Telpon"><b><?php echo $row['no_telpon']; ?></b>
                              </td>
                              <td align="center"  data-title="Alamat">
                                <?php echo $row['alamat']; ?>
                              </td>
                              <td align="center"  data-title="Keterangan/Website">
                                <?php
                                echo $row['website']."<br>";
                                echo $row['keterangan'];
                                ?>
                              </td>
                            </tr>
                            <?php
                            $no++;
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>

                    <!-- MULAI PAGINATION -->
                    <nav class="blog-pagination justify-content-center d-flex">
                      <ul class="pagination">
                        <li class="page-item">
                          <?php echo $pagination; ?>
                        </li>
                      </ul>
                    </nav>
                    <!-- SELESAI PAGINATION -->
                    <?php
                  }
                  else {
                    ?>
                    <h4 >Maaf, Data Belum Tersedia !</h4>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>


            <!-- MULAI SCRIPT KOSTUM -->
            <script>
              var acc = document.getElementsByClassName("accordion");
              var i;
              for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                  this.classList.toggle("active");
                  var panel = this.nextElementSibling;
                  if (panel.style.display === "block") {
                    panel.style.display = "none";
                  } else {
                    panel.style.display = "block";
                  }
                });
              }
            </script>
            <!-- SELESAI SCRIPT KOSTUM -->
          </div>
        </div>
        <!-- AKHIR DARI SEMUA CERITA YANG PANJANG -->