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

              .comment .comment-body {
                background-color: #f4f4f4;
                margin: 0;
                overflow: hidden;
                padding: 25px;
                margin-top: 20px;
                padding-left: 116px;
                position: relative;
                border: 1px solid rgba(0, 0, 0, 0);
                border-color: #E8E8E8;
                border-radius: 4px;
              }
              .children .comment .comment-body {
               background-color: #3e4b51;
               color:#fff;
             }
             .children .comment .comment-body a{
              color:#fff;
            }
            .btn.btn-default{
              color: #FFF;
            }
            .comment-reply-link {
              float: right;
            }
            .comment-list {
              padding:0;
            }
            .fn {
              color:#000;
              font-size:14px;
            }
            .btn-default, .label-default {
              background-color: #5D2121;
              border-color: #5D2121;
            }
            .btn-default {
              color: #333;
              background-color: #fff;
              border-color: #ccc;
            }
            .btn {
              display: inline-block;
              padding: 6px 12px;
              margin-bottom: 0;
              font-size: 14px;
              font-weight: 400;
              line-height: 1.42857143;
              text-align: center;
              white-space: nowrap;
              vertical-align: middle;
              -ms-touch-action: manipulation;
              touch-action: manipulation;
              cursor: pointer;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
              background-color: #000;
              border: 1px solid transparent;
              border-radius: 4px;
            }
            .comment-metadata {
              font-size: 11px;
              line-height: 16px;
              margin-bottom: 10px;
            }
            .comment-content p {
              margin: 0 0 10px;
              line-height:150%;
            }
            .comment-list .children {
              margin-left: 0px!important;
              padding-left: 40px;
              border-left: 1px solid #E8E8E8;
              background-repeat: no-repeat;
              background-position: left 20px;
            }
            .vcard .avatar {
              position: absolute;
              left: 29px;
              top: 29px;
            }
          </style>
          <!-- SELESAI GAYA KOSTUM -->
          <div class="content grid_9 allberita marked-category">
            <div class="single-page">
              <div class="box-single-content">
                <h3 class="rs single-title"><?php echo $judulan; ?></h3>
                <p class="rs post-by"><?php echo $postingby; ?></p>
                <a href="<?php echo base_url(); ?>pengaduan/" class="btn btn-green">Isi Pengaduan</a>
                <?php  if (count($artikel)) { ?>
                  <ol class="comment-list">
                    <?php
                    foreach($artikel as $key => $row){
                      ?>
                      <li id="comment-7" class="comment even thread-even depth-1 parent">
                        <article id="div-comment-7" class="comment-body">
                          <footer class="comment-meta">
                            <div class="comment-author vcard">
                              <img alt="" src="<?php echo base_url(); ?>images/unknown.png" class="avatar avatar-60 photo grav-hashed grav-hijack" height="60" width="60" id="grav-fa2af9c9e615b5747d63b6c9c94c0051-0">
                              <cite class="fn"><b><?php echo $row['nama'];?></b></cite>
                              <span class="says">says:</span>
                            </div>
                            <div class="comment-metadata">
                              <a href="">
                                <time datetime="">
                                  <?php
                                  $tanggal=$row['tanggal'];
                                  echo nama_hari($tanggal).', ';
                                  echo tgl_indo($tanggal);
                                  ?> | <?php echo $row['jam'];?>
                                </time>
                              </a>
                            </div>
                          </footer>
                          <div class="comment-content">
                            <p><?php echo $row['pesan'];?></p>
                          </div>
                        </article>
                        <ul class="children">
                          <?php
                          if ($row['jawaban']!='') {
                            ?>
                            <li id="comment-10" class="comment byuser comment-author-setiadi odd alt depth-2">
                              <article id="div-comment-10" class="comment-body hijau">
                                <footer class="comment-meta">
                                  <div class="comment-author vcard">
                                    <img alt="" src="<?php echo base_url(); ?>images/imagejawab.png" class="avatar avatar-60 photo grav-hashed grav-hijack" height="60" width="60">
                                    <cite class="fn">
                                      <a href="" rel="external nofollow" class="url"><b>Polres Kolaka</b></a>
                                    </cite>
                                    <span class="says">says:</span>
                                  </div>
                                </footer>
                                <div class="comment-content">
                                  <p><?php echo $row['jawaban']; ?></p>
                                </div>
                              </article>
                            </li>
                            <?php
                          }
                          else  { ?>
                          <?php } ?>
                        </ul>
                      </li>
                      <?php
                    }
                    ?>
                  </ol>
                  <div class="clearfix"></div>
                  <br>
                  <center>
                    <div class="pagination">
                      <ul class="tsc_pagination">
                        <?php echo $pagination; ?>
                      </ul>
                    </div>
                  </center>
                <?php } else {?>
                  <h4 >Maaf, Data Belum Tersedia !</h4>
                <?php }  ?>
                <style>ol.comment-list, ul.children { list-style:none;}</style>
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