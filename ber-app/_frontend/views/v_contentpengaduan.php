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
                  <a href="<?php echo base_url(); ?>pengaduan" class="text-white"><?php echo $judulan; ?></a>
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

            <script src='https://www.google.com/recaptcha/api.js'></script>
            <script src="<?php echo base_url(); ?>style/js/jquery.limit.js" type="text/javascript"></script>

            <script  type="text/javascript">
              $(document).ready(function() {

                $("#alamat").limit({
                  limit: 200,
                  id_result: "counter1",
                  alertClass: "alert"
                });

                $("#pesan").limit({
                  limit: 400,
                  id_result: "counter",
                  alertClass: "alert"
                });
              });
            </script>

            <div class="content grid_9 allberita marked-category">
              <div class="single-page">
                <div class="box-single-content">
                  <h3 class="rs single-title"><?php echo $judulan; ?></h3>
                  <p class="rs post-by"><?php echo $postingby; ?></p>
                  <a href="<?php echo base_url(); ?>pengaduan/data" class="btn btn-green">Lihat Data Pengaduan</a>
                  <div class="clearfix"></div>
                  <p style="line-height: 140%;font-size:15px;"> Informasi jati diri dan isi pengaduan tidak akan ditampilkan dihalaman website ini dan kami akan merahasiakan jati diri Anda. Identitas anda akan kami jaga dan lindungi secara hukum.</p>
                  <br>
                  <?php
                  $ip_addr = $this->input->ip_address();
                  echo form_open('pengaduan/simpan');
                  ?>
                  <input type="hidden" name="ipaddress"  value="<?php echo $ip_addr;?>">
                  <table width="100%"><tbody>
                    <tr>
                      <td width="20%">Nama Anda</td>
                      <td>
                        <input value="<?php echo set_value('nama'); ?>" type="text" name="nama" style="width:100%;">
                        <span style="color:#ff0000;"><?php echo form_error('nama'); ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td >Email</td>
                      <td >
                        <input value="<?php echo set_value('email'); ?>" type="text" name="email" style="width:100%;">
                        <span style="color:#ff0000;"><?php echo form_error('email'); ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>
                        <textarea id="alamat" name="alamat" style="width: 100%; height: 50px;"><?php echo set_value('alamat'); ?></textarea>
                        <span style="color:#ff0000;"><?php echo form_error('alamat'); ?></span>
                        <div id="counter1">You have <strong>200</strong> characters remaining</div>
                      </td>
                    </tr>
                    <tr>
                      <td>Judul Pengaduan</td>
                      <td>
                        <input value="<?php echo set_value('judulpengaduan'); ?>" type="text" name="judulpengaduan" style="width:100%;">
                        <span style="color:#ff0000;"><?php echo form_error('judulpengaduan'); ?></span>
                      </td>
                    </tr>

                    <tr>
                      <td>Lembaga yang Diadukan</td>
                      <td>
                        <input value="<?php echo set_value('lembaga'); ?>" type="text" name="lembaga" style="width:100%;">
                        <span style="color:#ff0000;"><?php echo form_error('lembaga'); ?></span>
                      </td>
                    </tr>

                    <tr>
                      <td>Pesan Anda</td>
                      <td>
                        <textarea id="pesan" name="pesan" style="width: 100%; height: 200px;"><?php echo set_value('pesan'); ?></textarea>
                        <span style="color:#ff0000;"><?php echo form_error('pesan'); ?></span>
                        <div id="counter">You have <strong>400</strong> characters remaining</div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <br>
                        <b>Validasi</b>
                        <br>
                        <br>
                      </td>
                      <td>
                        <br>
                        <div class="g-recaptcha" data-sitekey="6Lf1jx0TAAAAAARRcVYNy-fdXUKO1QVWqkF2iLXz"></div><?php echo form_error('g-recaptcha-response','<div style="color:red;"> Centang </div>'); ?></td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <input type="submit" class="genric-btn primary e-large" name="submit" value="Kirim">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <?php echo form_close(); ?>
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