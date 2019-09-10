                <!-- MULAI MENU SIDEBAR -->
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <!-- MULAI PENCARIAN -->
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Keyword">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button main_btn w-100" type="submit">Pencarian</button>
                            </form>
                        </aside>
                        <!-- SELESAI PENCARIAN -->
                        <!-- MULAI KATEGORI -->
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Kategori Berita</h4>
                            <?php
                            foreach($kategori as $k){
                                ?>
                                <ul class="list cat-list">
                                    <li>
                                        <a href="<?php echo base_url(); ?>kategori/<?php echo $k->kategori_seo ?>/" class="d-flex">
                                            <p><?php echo $k->nama_kategori ?></p>
                                        </a>
                                    </li>
                                </ul>
                            <?php } ?>
                        </aside>
                        <!-- SELESAI KATEGORI -->
                        <!-- MULAI BIDANG -->
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Bidang</h4>
                            <?php
                            $menu = $this->M_data->ambilsubmenu('',7);
                            foreach($menu->result() as $row){
                                ?>
                                <ul class="list cat-list">
                                    <li>
                                        <a href="<?php echo base_url();  echo $row->link_submenu;?>" class="d-flex">
                                            <p><?php echo $row->nama_submenu; ?></p>
                                        </a>
                                    </li>
                                </ul>
                            <?php } ?>
                        </aside>
                        <!-- SELESAI BIDANG -->
                        <!-- MULAI BERITA TERBARU -->
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Berita Terbaru</h3>
                            <?php
                            $berita1 = $this->M_data->beritaterbaru2(0,5);
                            foreach($berita1->result() as $row){
                                $judul=seo_link($row->judul);
                                $tanggal=$row->tanggal;
                                $photopath = str_replace('-', '/', $row->tanggal_modif);
                                ?>
                                <div class="media post_item">
                                    <div class="media-body">
                                        <a href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>">
                                            <h3><?php echo $row->judul; ?></h3>
                                        </a>
                                        <p><?php   echo tgl_indo($tanggal).' | '; echo $row->jam.' WIB '; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </aside>
                        <!-- SELESAI BERITA TERBARU -->
                        <!-- MULAI PROFIL INSTANSI -->
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Profil Instansi</h4>
                            <?php
                            $menu = $this->M_data->ambilsubmenu('',3);
                            foreach($menu->result() as $row){
                                ?>
                                <ul class="list cat-list">
                                    <li>
                                        <a href="<?php echo base_url();  echo $row->link_submenu;?>" class="d-flex">
                                            <p><?php echo $row->nama_submenu; ?></p>
                                        </a>
                                    </li>
                                </ul>
                            <?php } ?>
                        </aside>
                        <!-- SELESAI PROFIL INSTANSI -->
                        <!-- MULAI BASIS DATA -->
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Basis Data</h4>
                            <?php
                            $menu = $this->M_data->ambilsubmenu('',11);
                            foreach($menu->result() as $row){
                                ?>
                                <ul class="list cat-list">
                                    <li>
                                        <a href="<?php echo base_url();  echo $row->link_submenu;?>" class="d-flex">
                                            <p><?php echo $row->nama_submenu; ?></p>
                                        </a>
                                    </li>
                                </ul>
                            <?php } ?>
                        </aside>
                        <!-- SELESAI BASIS DATA -->
                    </div>
                </div>
                <!-- SELESAI MENU SIDEBAR -->
            </div>
        </div>
    </section>
    <!-- SELESAI ISI -->