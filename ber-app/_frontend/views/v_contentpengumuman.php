<?php
//-- JIKA KONDISINYA INDEX --//
if ($this->uri->segment(1,0)=='pengumuman' and $this->uri->segment(2,0)==null) { ?>
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
                <a href="<?php echo base_url(); ?>pengumuman" class="text-white">Semua Pengumuman</a>
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

          <h2>Semua Pengumuman</h2>
          <br>
          <br>
          <table id="semuapublikasi"><tbody>
            <?php
            foreach($artikel as $key => $row){
              $isi=strip_tags($row['isi_pengumuman']);
              $isi=substr($isi,0,170);
              $judul=seo_link($row['judul']);
              ?>
              <tr>
                <td width="23%" style="border-bottom:1px dotted #ccc;">
                  <div class="date-p leftt">
                    <span class="tanggal">Tanggal Pengumuman:<br>
                      <div class="date-j left">
                        <b><?php echo tgl_indo($row['tanggal_pengumuman']); ?></b>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </span>
                </td>
                <td style="border-left:1px dotted #ccc;border-bottom:1px dotted #ccc;padding-left:10px;">
                  <div class="judullain">
                    <a href="<?php echo base_url(); ?>pengumuman/detail/<?php echo $row['id_pengumuman']."/".$judul."/";?>"><b><?php echo $row['judul']; ?></b></a>
                  </div> <?php echo $isi; ?>...  <br><br></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
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
          $no++;
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

          <?php
          //-- JIKA KONDISINTA DETAIL --//
        } elseif ($this->uri->segment(1,0)=='pengumuman' and $this->uri->segment(2,0)=='detail') { ?>
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
                        <a href="<?php echo base_url(); ?>pengumuman" class="text-white">Semua Pengumuman</a>
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
                  <?php
                  foreach($detail_pengumuman as $row){
                    ?>
                    <br>
                    <br>
                    <br>
                    <h1><?php echo $row->judul; ?></h1>


                    <p class="rs post-by">
                      <?php
                      $tanggal=$row->tanggal;
                      echo nama_hari($tanggal).', ';
                      echo tgl_indo($tanggal).' ';
                      ?>
                      | Dibaca: <?php echo $row->dibaca; ?> kali
                    </p>
                    <br />
                    <div class="editor-content">
                      <?php echo $row->isi_pengumuman; ?>
                    </div>
                  <?php } ?>
                  <?php
                  $data = array('dibaca' => $row->dibaca + 1);
                  $where = "id_pengumuman = '".$row->id_pengumuman."'";
                  $str = $this->db->update('pengumuman', $data, $where);
                  ?>

                  <br>
                  <?php

//$tampil=mysql_query("SELECT * FROM download ORDER BY id_download desc");
                  $this->db->select('*');
                  $this->db->order_by('id_download', 'desc');
                  $this->db->from('download');
                  $query = $this->db->get();


                  echo"<div class='filependukung'>
                  <h3>FILE PENDUKUNG</h3>";

                  if ($row->file3==0 and $row->file2==0 and $row->file1==0)
                  {
                    echo" Tidak Ada File ";
                  }
                  else {
                    foreach($query->result_array() as $w) {
//          while($w=mysql_fetch_array($tampil)){
                      if ($row->file3==$w['id_download']){
                        if ($w['metode_link']==1) {
                          $photopath = str_replace('-', '/', $w['tanggal_modif']);
                          $file="./file/".$photopath."/".$w['nama_file'];
                          $sizefile= size($file);
                          echo "- <a href='./file/".$photopath."/".$w['nama_file']."' target='_blank'>".$w['judul']." </a> [".$sizefile."]<br>";
                        }
                        else {
                          echo "- <a href='".$w['link_file']."'>".$w['judul']."</a><br>";
                        }
                      }
                      if ($row->file2==$w['id_download']){
                        if ($w['metode_link']==1) {
                          $photopath = str_replace('-', '/', $w['tanggal_modif']);
                          $file="./file/".$photopath."/".$w['nama_file'];
                          $sizefile= size($file);
                          echo "- <a href='./file/".$photopath."/".$w['nama_file']."' target='_blank'>".$w['judul']." </a> [".$sizefile."]<br>";
                        }
                        else {
                          echo "- <a href='".$w['link_file']."'>".$w['judul']."</a><br>";
                        }
                      }
                      if ($row->file1==$w['id_download']){
                        if ($w['metode_link']==1) {
                          $photopath = str_replace('-', '/', $w['tanggal_modif']);
                          $file="./file/".$photopath."/".$w['nama_file'];
                          $sizefile= size($file);
                          echo "- <a href='./file/".$photopath."/".$w['nama_file']."' target='_blank'>".$w['judul']." </a> [".$sizefile."]<br>";
                        }
                        else {
                          echo "- <a href='".$w['link_file']."'>".$w['judul']."</a><br>";
                        }
                      }
                      else{
                        echo "";
                      }
                    }
                  }
                  echo"</div>";
                  ?>
                <?php } ?>
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