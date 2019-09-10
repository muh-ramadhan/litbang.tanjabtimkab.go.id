  <!-- MULAI HEADER -->
  <header class="main_menu home_menu">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg navbar-light">
            <?php
            $identitas = $this->M_data->identitasfooter();
            foreach($identitas->result() as $row) {
              ?>
              <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url()?>style/images/<?php echo $row->logo; ?>" alt="logo">
              </a>
            <?php } ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse main-menu-item justify-content-end"
          id="navbarSupportedContent">
          <ul class="navbar-nav">
            <?php
            $menu = $this->M_data->ambilmenu(2);
            foreach($menu->result() as $row){
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?php echo base_url();  echo $row->link;?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $row->nama_menu; ?>
                </a>
                <?php
                $submenu = $this->M_data->ambilsubmenu('',$row->id_menu);
                ?>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                  foreach($submenu->result() as $sub){
                    $lin1=substr($sub->link_submenu, 0, 3);
                    if ($lin1!="htt") {
                      $link1=base_url().$sub->link_submenu;
                    } else {
                      $link1=$sub->link_submenu;
                    } ?>
                    <a class="dropdown-item" href="<?php echo $link1; ?>"><?php echo $sub->nama_submenu; ?></a>
                  <?php } ?>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</div>
</header>
<!-- SELESAI HEADER -->