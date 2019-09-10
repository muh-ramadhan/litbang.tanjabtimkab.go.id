                <!-- MULAI MENU SIDEBAR -->
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
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