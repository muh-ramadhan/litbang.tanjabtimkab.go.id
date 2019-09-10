   <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner text-center">
            <div class="breadcrumb_iner_item">
              <h2>Pengaduan Masyarakat</h2>
              <p>
                <a href="<?php echo base_url(); ?>">Home</a>
                <span>/</span>
                <a href="<?php echo base_url(); ?>pengaduan">Pengaduan</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- SELESAI BREAD CRUMB -->
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
                <h3 class="rs single-title"><?php echo $judulan; ?></h3>
                <p class="rs post-by"><?php echo $postingby; ?></p>
                <a href="<?php echo base_url(); ?>pengaduan/data" class="btn btn-green">Lihat Data Pengaduan</a>
                <div class="clearfix"></div>
                <div style="padding:10px; color:#333;">
                  <p style="line-height: 140%;font-size:15px;">Pengaduan Anda Telah Masuk ke Database Kami. Terima Kasih Atas Informasinya.</p>
                </div>
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