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
                                    <h3 class="mb-30">Kategori: <?php echo $judulan; ?></h3>
                                    <p class="rs post-by"><?php echo $postingby; ?></p>
                                    <br>
                                    <?php
                                    if (count($artikel)) {
                                        ?>
                                        <div id="no-more-tables" style="*padding:15px;margin:0 auto;">
                                            <table class="col-md-12 table-bordered table-striped table-condensed cf" style="margin-bottom:15px;">
                                                <thead class="cf">
                                                    <tr bgcolor="#F2F2F2" align="left">
                                                        <th width="4% !important"><center>No</center></th>
                                                        <th width="25% !important">Judul Dokumen</th>
                                                        <th width="8% !important">Tahun</th>
                                                        <th width="13% !important">Tanggal Upload</th>
                                                        <th width="8% !important"><center>Detail</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!is_numeric($this->uri->segment(4))){ $no=1;    }
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
                                                        $judul=seo_link($row['judul']);
                                                //$row->id_katdokumen
                                                        ?>
                                                        <tr class="ok" bgcolor="<?php echo $background; ?>">
                                                            <td data-title="No"><center><?php echo $no; ?></center></td>
                                                            <td  data-title="Judul"> <?php echo $row['judul'];?> <br> <?php echo $row['jangkrik'];?> </td>
                                                            <td align="center" data-title="Tahun"> <?php echo $row['tahun']; ?> </td>
                                                            <td align="center"  data-title="Tgl Upload">
                                                                <?php
                                                                $tanggal=$row['tgl_upload'];
                                                                echo nama_hari($tanggal).', ';
                                                                echo tgl_indo($tanggal); ?>
                                                            </td>
                                                            <td align="center"  data-title="Detail">
                                                                <a href="<?php echo base_url(); ?>dokumen/detail/<?php  echo $row['id_dokumen']."/".$judul."/";?>"><b>Detail</b></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $no++;
                                                    }}
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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