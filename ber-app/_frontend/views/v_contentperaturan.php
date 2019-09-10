<?php
//-- JIKA KONDISINYA INDEX --//
if ($this->uri->segment(2,0)=='index') { ?>
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
								<a href="<?php echo base_url(); ?>peraturan" class="text-white"><?php echo $judulan; ?></a>
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

					<h2><?php echo $judulan; ?></h2>
					<?php
					$no=1;
					$katprodukhukum=$this->M_data->katprodukhukum();
					foreach($katprodukhukum->result() as $row){
						?>
						<button class="accordion">+ <?php echo $row->nama_katprodukhukum; ?></button>
						<div class="panel">
							<p class="btn_2">
								<a href="<?php echo base_url()."peraturan/kategori/".$row->id_katprodukhukum."/";?>">Kategori : <?php echo $row->nama_katprodukhukum; ?></a>
							</p>
						</div>
						<?php
						$no++; } ?>

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

			<?php }
			//-- JIKA KONDISINYA DETAIL --//
			elseif ($this->uri->segment(2,0)=='detail') {
				if (count($detail_berita)) {
					foreach($detail_berita as $row){
						$judul=seo_link($row->nama_katprodukhukum);
						$photopath = str_replace('-', '/', $row->tanggal_modif);
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
													<a href="<?php echo base_url(); ?>peraturan" class="text-white">Semua Peraturan</a>
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

										<h2><?php echo $judulan; ?></h2>
										<br>
										<br>
										<table class="ver-zebra2">
											<colgroup><col class="oce-first"></colgroup>
											<tbody>
												<tr>
													<td width="200">Tahun Peraturan/Produk Hukum</td>
													<td width="500">: <strong> <?php echo $row->tahun; ?> </strong></td>
												</tr>
												<tr></tr>
												<tr>
													<td>Keterangan</td>
													<td> : <?php echo $row->jangkrik; ?></td>
												</tr>
												<tr>
													<td>Tanggal Upload</td>
													<td> : <?php
													$tanggal=$row->tgl_upload;
													echo nama_hari($tanggal).', ';
													echo tgl_indo($tanggal);
													?></td>
												</tr>
												<tr>
													<td>Didownload</td>
													<td> :  <?php echo $row->dibaca; ?> Kali</td>
												</tr>
												<tr>
													<td>Link File</td>
													<td>:   <?php if ($row->metode_link==1) { ?>
														<a href="<?php echo base_url(); ?>file/<?php echo $photopath;?>/<?php echo $row->nama_file;?>" target="_blank"><b>Download</b></a>
													<?php } else { ?>
														<a href="<?php echo $row->link_file; ?>" target="_blank"><b>Download</b></a>
													<?php } ?>
												</td>
											</tr>
										</tbody>
									</table>
									<?php
									$no++;
								}}
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


					<?php }
				//-- JIKA KONDISINYA KATEGORI --//
					else if ($this->uri->segment(2,0)=='kategori') {
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
													<a href="<?php echo base_url(); ?>peraturan" class="text-white">Semua Peraturan</a>
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

										<h2><?php echo $judulan; ?></h2>
										<br>
										<br>
										<?php
										if (count($artikel)) {
											?>
											<table class="col-md-12 table-bordered table-striped table-condensed cf" style="margin-bottom:15px;">
												<thead class="cf">
													<tr bgcolor="#F2F2F2" align="left">
														<th width="4% !important"><center>No</center></th>
														<th width="25% !important">Judul Peraturan/Produk Hukum</th>
														<th width="8% !important">Tahun</th>
														<th width="13% !important">Tanggal Upload</th>
														<th width="8% !important"><center>Detail</center></th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (!is_numeric($this->uri->segment(4))){ $no=1;  }
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
														//$row->id_katprodukhukum
														?>
														<tr class="ok" bgcolor="<?php echo $background; ?>">
															<td data-title="No"><center><?php echo $no; ?></center></td>
															<td  data-title="Judul"> <?php echo $row['judul'];?> <br>
																<?php echo $row['jangkrik'];?>  </td>
																<td align="center" data-title="Tahun">
																	<?php
																	echo $row['tahun'];
																	?>
																</td>
																<td align="center"  data-title="Tgl Upload">
																	<?php
																	$tanggal=$row['tgl_upload'];
																	echo nama_hari($tanggal).', ';
																	echo tgl_indo($tanggal);
																	?>
																</td>
																<td align="center"  data-title="Detail">
																	<a href="<?php echo base_url(); ?>peraturan/detail/<?php  echo $row['id_produkhukum']."/".$judul."/";?>"><b>Detail</b></a>
																</td>
															</tr>
															<?php
															$no++;
														}
														?>
													</tbody>
												</table>
												<?php
												$no++;
												?>

												<?php
											} else {
												?>
												<h4 >Maaf, Data Belum Tersedia !</h4>
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

									<?php } ?>