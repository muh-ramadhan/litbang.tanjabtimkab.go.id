				<div class="percategory">
					<h3 class="rs"><span>PROFIL</span>  </h3>

					<nav class="lst-category menucustom">
						<ul class="rs nav nav-category">
							<?php
							$menu = $this->M_data->ambilsubmenu('',3);
							foreach($menu->result() as $row){
								?>
								<a href="<?php echo base_url();  echo $row->link_submenu;?>"> <li> <i class="icon iPlugGray"></i><?php echo $row->nama_submenu; ?>  </li> </a>

							<?php }
							?>
						</ul>
					</nav><!--end: .lst-category -->
				</div>


				<div class="percategory">
					<h3 class="rs"><span>BIDANG</span>  </h3>

					<nav class="lst-category menucustom">
						<ul class="rs nav nav-category">
							<?php
							$menu = $this->M_data->ambilsubmenu('',7);
							foreach($menu->result() as $row){
								?>
								<a href="<?php echo base_url();  echo $row->link_submenu;?>"> <li> <i class="icon iPlugGray"></i><?php echo $row->nama_submenu; ?>  </li> </a>

							<?php }
							?>
						</ul>
					</nav><!--end: .lst-category -->
				</div>

				<div class="percategory">
					<h3 class="rs"><span>UNIT</span> <span style="background:#F8C300;color: #000; text-shadow: 0px 1px 1px #fff;">PENGELOLA</span></h3>

					<nav class="lst-category menucustom">
						<ul class="rs nav nav-category">
							<?php
							$menu = $this->M_data->ambilsubmenu('',9);
							foreach($menu->result() as $row){
								?>
								<a href="<?php echo base_url();  echo $row->link_submenu;?>"> <li> <i class="icon iPlugGray"></i><?php echo $row->nama_submenu; ?>  </li> </a>

							<?php }
							?>
						</ul>
					</nav><!--end: .lst-category -->
				</div>

				<div class="percategory">
					<div class="list-group">
						<a href="<?php echo base_url();?>telpon" class="list-group-item active" style="font-size: 16px;font-family: 'Open Sans', sans-serif;font-weight: 700;"> Telpon Penting
						</a>
						<?php
						$telpon=$this->M_data->telpon(5);
						foreach($telpon->result() as $row){
							?>
							<a href="<?php echo base_url();?>telpon" class="list-group-item"><?php echo $row->nama_telpon; ?><br>
								<span style="font-weight:700;"><?php echo $row->no_telpon; ?></span>
							</a>
						<?php } ?>

					</div>
				</div>
