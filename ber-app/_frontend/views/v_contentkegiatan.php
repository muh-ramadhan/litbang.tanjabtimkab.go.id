<?php  if ($this->uri->segment(1,0)=='kegiatan' and $this->uri->segment(2,0)=='index') {
//-- JIKA KONDISINYA INDEX --//
  ?>
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
                <a href="<?php echo base_url(); ?>kegiatan" class="text-white">Semua Agenda Kegiatan</a>
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
            .jadwal-tab {
              width: 100%;
              text-align: left;
              border-collapse: collapse;
              margin-top: 10px;
              margin-bottom: 10px;
              background-color: #e4e4e4;
            }
            .jadwal-tab td {
              padding: 8px 15px;
              border: 1px solid #fff;
              line-height: 160%;
              color: #161313;
            }

            .tanggal-k{
              background:#304180;
              color:#fff;
              *width:40px;
              height:50px;
              font-size:24px;
              text-align:center;
              padding:15px 0;
              font-family: 'open_sansbold',Arial, Helvetica, sans-serif;

            }

            .date-k {
              background: #000;
              *height: 50px;
              width: 120px;border-radius:10px;
            }
            .tahun-p {
              font-size: 18px;
              font-family: 'open_sansbold',Arial, Helvetica, sans-serif;
            }

            .bulan-p, .tahun-p {
              text-align: center;
              line-height: 150%;
            }
            .corange {
              color: #d79a16;
            }
          </style>
          <!-- SELESAI GAYA KOSTUM -->
          <div class="content grid_9 allberita marked-category">
            <div class="single-page">
              <div class="box-single-content">
               <?php
               if (count($artikel)) {
                 ?>

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
                 $judul=seo_link($row['namakegiatan']);
                 $tahunj=substr($row['tgl_kegiatan'], 0,4);
                 $bulanj=substr($row['tgl_kegiatan'], 5,2);
                 $tanggalj=substr($row['tgl_kegiatan'], 8,2);
                 ?>
                 <table class="jadwal-tab">
                  <tr>
                    <td rowspan="4" width="160">
                      <center>
                       <div class="date-k right">
                         <div class="tanggal-k"> <?php echo $tanggalj; ?></div>
                         <div class="bulan-p corange"> <?php echo bulan($bulanj); ?></div>
                         <div class="tahun-p corange"><?php echo $tahunj; ?></div>
                       </div>
                     </center>
                   </td>
                   <td> Kegiatan :  <strong><?php echo $row['namakegiatan']; ?></strong></td>
                 </tr>
                 <tr>
                  <td>Tempat : <strong><?php echo $row['tempat']; ?></strong></td>
                </tr>
                <tr>
                  <td>Waktu : <strong><?php echo $row['waktu']; ?></strong></td>
                </tr>

                <tr>
                  <td>
                   <a href="<?php echo base_url(); ?>kegiatan/detail/<?php echo $row['id_kegiatan']; ?>/<?php  echo $judul; ?>" class="btn btn-green">Selengkapnya</a>

                 </td>
               </tr>
             </table>
             <?php
             $no++;
           }
           ?>
           <!-- SELESAI ISI -->

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

  <?php
//-- JIKA KONDISINYA DETAIL --//
} elseif ($this->uri->segment(1,0)=='kegiatan' and $this->uri->segment(2,0)=='detail') { ?>
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
                <a href="<?php echo base_url(); ?>kegiatan" class="text-white">Semua Agenda Kegiatan</a>
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
            #ver-zebra3 {
              width: 100%;
              text-align: left;
              margin-top: 10px;
              margin-bottom: 10px;
              border-bottom: 1px solid #ccc;
            }
            #ver-zebra3 td {
              padding: 8px;
              line-height: 160%;
              color: #161313;
            }
            #ver-zebra5 {
              width: 100%;
              text-align: left;
              border-collapse: collapse;
              margin-bottom: 10px;
            }
            #ver-zebra5 td {
              padding: 5px;
              border-bottom: 1px solid #1bf216;
              line-height: 160%;
              color: #161313;
            }
            #ver-zebra5 td a{
             font-weight:bold;
             color:#000;
             font-size:15px;
           }
           .ver-zebra2 {
            width: 100%;
            text-align: left;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 10px;
          }
          .oce-tri {
            background: #2a6289;
            border-left: 6px solid #ddd;
          }
          .ver-zebra2 td {
            padding: 3px;
            border: 1px solid #ddd;
            line-height: 160%;
            color: #161313;
          }
          .komisioner-tab {
            width: 100%;
            text-align: left;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
          }
          .komisioner-tab td {
            padding: 5px 15px;
            border: 1px solid #f18103;
            line-height: 160%;
            color: #161313;
          }
        </style>
        <!-- SELESAI GAYA KOSTUM -->
        <?php
        if (count($detail_kegiatan)) {
         foreach($detail_kegiatan as $row){
          ?>
          <div class="content grid_9 allberita marked-category">
           <div class="single-page">
            <div class="box-single-content">
             <br>
             <br>
             <br>
             <h3 class="rs single-title">Agenda : <?php echo $judulan;?></h3>
             <p class="rs post-by"><?php echo $postingby; ?></p>
             <center>
             </center>
             <table class="komisioner-tab">
              <colgroup><col class="oce-tri"></colgroup>
              <tbody>
                <tr>
                  <td width="200">
                    <span style="color:#fff;">Agenda</span>
                  </td>
                  <td width="500"> : <strong> <?php echo $row->namakegiatan;?></strong></td>
                </tr>
                <tr>
                </tr>
                <tr>
                  <td>
                    <span style="color:#fff;">Tanggal</span>
                  </td>
                  <td> : <?php
                  $tanggal=$row->tgl_kegiatan;
                  echo nama_hari($tanggal).', ';
                  echo tgl_indo($tanggal);
                  ?>
                </td>
              </tr>
              <tr>
                <td>
                  <span style="color:#fff;">Waktu</span>
                </td>
                <td> : <?php echo $row->waktu;?></td>
              </tr>
              <tr>
                <td>
                  <span style="color:#fff;">Tempat</span>
                </td>
                <td> : <?php echo $row->tempat; ?></td>
              </tr>
              <tr>
                <td>
                  <span style="color:#fff;">Perihal</span>
                </td>
                <td>:   <?php echo $row->perihal;?>
              </td>
            </tr>
            <tr>
              <td>
                <span style="color:#fff;">Jadwal Agenda</span>
              </td>
              <td><?php echo $row->jadwalkegiatan;?></td>
            </tr>
          </tbody>
        </table>
        <?php
      }
      ?>
      <div class="clearfix"></div>
      <?php
    }
    else { }
      ?>
  </div>
</div>
</div>
<?php
}
?>
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
</div>
</div>

<!-- AKHIR DARI SEMUA CERITA YANG PANJANG -->