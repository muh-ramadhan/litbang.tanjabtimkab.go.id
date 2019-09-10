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
                        <?php
                        $no=1;
                        $katdokumen=$this->M_data->katdokumen();
                        foreach($katdokumen->result() as $row){
                            ?>
                            <div class="blog_details">
                                <a class="d-inline-block" href="<?php echo base_url()."dokumen/kategori/".$row->id_katdokumen."/".seo_link($row->nama_katdokumen);?>">
                                    <h2><?php echo $row->nama_katdokumen; ?></h2>
                                </a>
                                <p><?php echo $postingby; ?></p>
                            </div>
                            <?php $no=$no+1; } ?>
                        </article>
                    </div>
                </div>