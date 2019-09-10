<!-- MULAI FOOTER -->
<footer class="footer-area">
  <div class="container">
    <div class="row justify-content-between">
      <!-- MULAI TENTANG -->
      <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="single-footer-widget footer_1">
          <?php
          $identitas = $this->M_data->identitasfooter();
          foreach($identitas->result() as $row) {
            ?>
            <a href="<?php echo base_url()?>"> <img src="<?php echo base_url()?>style/images/<?php echo $row->logo; ?>" alt=""> </a>
            <p><?php echo $row->meta_deskripsi; ?></p>
          <?php } ?>
        </div>
      </div>
      <!-- SELESAI TENTANG -->
      <!-- MULAI POLLING -->
      <div class="col-sm-6 col-md-6 col-xl-4">
        <div class="single-footer-widget footer_2">
          <h4>E-Polling</h4>
          <p style="color: white;">Bagaimana Menurut Anda Informasi Yang kami Sediakan? </p>
          <br>
          <form method="POST" action="<?php echo base_url(); ?>polling/vote">
            <input type="hidden" name="idpolling" value="413">
            <div class="switch-wrap d-flex justify-content-between">
              <p>Sangat Lengkap</p>
              <div class="primary-radio">
                <input type="checkbox" id="1" name="pilihan" value="1">
                <label for="1"></label>
              </div>
            </div>
            <div class="switch-wrap d-flex justify-content-between">
              <p>Lengkap</p>
              <div class="primary-radio">
                <input type="checkbox" id="2" name="pilihan" value="2">
                <label for="2"></label>
              </div>
            </div>
            <div class="switch-wrap d-flex justify-content-between">
              <p>Tidak Lengkap</p>
              <div class="primary-radio">
                <input type="checkbox" id="3" name="pilihan" value="3">
                <label for="3"></label>
              </div>
            </div>
            <div class="switch-wrap d-flex justify-content-between">
              <p>Sangat Tidak Lengkap</p>
              <div class="primary-radio">
                <input type="checkbox" id="4" name="pilihan" value="4">
                <label for="4"></label>
              </div>
            </div>
            <button class="genric-btn primary" type="submit">Kirim</button>
            <a href="<?php echo base_url(); ?>polling/" class="genric-btn primary-border">Lihat Hasil</a>
          </form>
        </div>
      </div>
      <!-- SELESAI POLLING -->
      <!-- MULAI DOWNLOAD DOKUMEN -->
      <div class="col-sm-12 col-md-8 col-xl-3">
        <div class="single-footer-widget footer_3">
          <h4>Download Dokumen</h4>
          <div class="">
            <?php
            $dokumen=$this->M_data->ambildokumen(3);
            foreach($dokumen->result() as $row){
              $photopath = str_replace('-', '/', $row->tgl_upload);
              ?>
              <ul class="unordered-list">
                <li><p>
                  <a style="color: white;" href="<?php echo base_url(); ?>dokumen/detail/<?php echo $row->id_dokumen."/".$judul;?>"><?php echo $row->judul; ?></a>
                  <br>
                  Update : <?php echo $photopath; ?></p></li>
                </ul>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- SELESAI DOWNLOAD DOKUMEN -->
      </div>
    </div>
    <!-- MULAI COPYRIGHT -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="copyright_part_text text-center">
            <div class="row">
              <div class="col-lg-12">
                <p class="footer-text m-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> <?php echo $judulappfooter; ?> | <a href="http://diskominfo.tanjabtimkab.go.id//" target="_blank">Diskominfo Tanjabtimkab</a></p>
                <!-- MULAI SOSIAL MEDIA DEVELOPER -->
                <div class="social_icon">
                  <a style="color: white;" href="#"> <i class="ti-facebook"></i></a>
                  <a style="color: white;" href="#"> <i class="ti-twitter-alt"></i></a>
                  <a style="color: white;" href="#"> <i class="ti-instagram"></i></a>
                  <a style="color: white;" href="https://github.com/muh-ramadhan"> <i class="ti-github"></i></a>
                  <!-- SELESAI SOSIAL MEDIA DEVELOPER -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- SELESAI COPYRIGHT -->
  </footer>
  <!-- SELESAI FOOTER -->