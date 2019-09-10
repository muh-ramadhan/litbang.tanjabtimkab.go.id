<?php  if ($this->uri->segment(2,0)=='index') { ?>
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
								<a href="<?php echo base_url(); ?>pegawai" class="text-white">Semua Pejabat / Staff</a>
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
					<!-- Start Align Area -->
					<div class="whole-wrap">
						<div class="container box_1170">
							<?php
							if (count($artikel)) {
								foreach($artikel  as $row){
									$photopath = str_replace('-', '/', $row['tgl_modif']);
									$seo=seo_link($row['nama_pegawai']);
									?>
									<div class="row">
										<div class="col-md-3">
											<br><br>
											<?php if($row['gambar']!='') { ?>
												<img src="<?php echo base_url(); ?>foto_pegawai/<?php echo $photopath; ?>/<?php echo $row['gambar']; ?>" alt="" class="img-fluid" style="width: 120px; height: 140px;">
											<?php }else { ?>
												<img src="<?php echo base_url(); ?>style/images/profile.jpg" alt="" class="img-fluid">
											<?php } ?>
										</div>
										<div class="col-md-9 mt-sm-20">
											<table id="ver-zebra5">
												<tbody><br><br>
													<tr><td width="22%">Nama</td><td>:  <a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1,0)?>/detail/<?php  echo $row['id_pegawai'];?>/<?php echo $seo;?>">
														<b><?php  echo $row['nama_pegawai'];?></b>
													</a> </td></tr>
													<tr><td>Jabatan</td><td>:
														<?php  echo $row['nama_jabatanpegawai'];?>

													</td></tr>
													<tr><td>Pangkat/Golongan</td><td>:  <?php  echo $row['pangkat'];?> - <?php  echo $row['gol_ruang'];?>   </td></tr>
													<tr><td>Jenis Kelamin</td><td>:
														<?php if ($row['kelamin']=='L') {?>
															Laki-laki
														<?php } else { ?>
															Perempuan
															<?php }  ?>  </td></tr>

															<tr><td> TTL </td><td>: <?php if ($row['tempat']=='') {?>
																-
															<?php } else {
																echo $row['tempat'];
															} ?>
															<?php if ($row['no_tgl_lahir']=='Y') {?>
																, -
															<?php }
															else { ?>
																, <?php echo tgl_indo($row['tgl_lahir']);?>
															<?php } ?>
														</td>
													</tr>
													<tr><td colspan="2">
														<a href="<?php echo base_url(); ?><?php echo $this->uri->segment(1,0)?>/detail/<?php  echo $row['id_pegawai'];?>/<?php echo $seo;?>" style="color:#fff;">
															<div class="butt"> SELENGKAPNYA </div>
														</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<!-- End Align Area -->

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

			<?php }
			else  if ($this->uri->segment(2,0)=='detail') { ?>
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
											<a href="<?php echo base_url(); ?>pegawai" class="text-white">Semua Pejabat / Staff</a>
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
								if (count($detail_pegawai)) {
									foreach($detail_pegawai as $row){
										if ($row->kelamin=='L') {
											$kelamin='Laki-laki';
										}
										else {
											$kelamin='Perempuan';
										}

										?>
										<div class="content grid_9 allberita marked-category">
											<div class="single-page">
												<div class="box-single-content clearfix"  id="pagehead" >
													<center>

														<?php
														if ($row->gambar!=null) {
															$photopath = str_replace('-', '/', $row->tgl_modif);
															?>
															<img src="<?php echo base_url(); ?>foto_pegawai/<?php echo $photopath; ?>/<?php echo $row->gambar;?>" style="border:5px solid #000;margin-bottom:20px;width:300px;">
														<?php }
														else {  ?>
															<img src="<?php echo base_url(); ?>style/images/profile.jpg" style="border:5px solid #000;margin-bottom:20px;width:300px;">
														<?php } ?>

													</center>
													<table class="ver-zebra2">
														<colgroup><col class="oce-first"></colgroup>
														<tbody>
															<tr><td width="200">Nama</td>  <td width="500">: <strong> <?php echo $row->nama_pegawai;?> </strong></td>
															</tr>

															<tr><td>Jabatan</td>  <td> :
																<?php echo $row->nama_jabatanpegawai;?>

															</td></tr>
															<tr><td>Pangkat</td>  <td> : <?php echo $row->pangkat;?></td></tr>
														</tr><tr><td>Tempat/Tanggal Lahir</td>  <td> :
															<?php if ($row->tempat=='') {?>
																-
															<?php } else {
																echo $row->tempat;
															}  ?>
															<?php if ($row->no_tgl_lahir=='Y') {?>
																, -
															<?php }
															else {?>
																, <?php echo tgl_indo($row->tgl_lahir);?>
															<?php }  ?>
														</td></tr>
														<!--<tr><td>Agama</td>  <td> : <?php // echo $row->agama;?></td></tr> -->
														<tr><td>Jenis Kelamin</td>  <td> : <?php echo $kelamin; ?></td></tr>
														<tr><td>Pendidikan</td>  <td>:    <?php echo $row->pendidikan;?></td></tr>
														<tr><td>Tahun Lulus</td>  <td>:   <?php echo $row->tahun_lulus;?></td></tr>
														<?php
														if ($this->uri->segment(1)=='pegawaipolsek') {
															?>
															<tr><td>Keterangan</td>  <td> <?php echo $row->jangkrik;?></td></tr>
														<?php } else { ?>
															<tr><td>Keterangan</td>  <td> <?php echo $row->keterangan;?></td></tr>
														<?php } ?>

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