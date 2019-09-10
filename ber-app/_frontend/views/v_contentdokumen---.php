<?php  if ($this->uri->segment(2,0)=='index') { ?>

	<div class="content grid_9 allberita marked-category">
		<div class="single-page">
			<div class="box-single-content">
				<div class="breadcrumb">
					<a href="<?php echo base_url(); ?>">Beranda </a>/ <a href="<?php echo base_url(); ?>dok"> Dokumen </a>
				</div>
				<br>
				<h3 class="rs single-title"><?php echo $judulan; ?></h3>
				<p class="rs post-by"><?php echo $postingby; ?></p>

				<?php
				$no=1;
				foreach($katdokumen->result() as $row){
	//$judul=seo_link($row->nama_katdokumen);
					?>
					<a href="<?php echo base_url()."dok/kategori/".$row->id_katdokumen."/";?>" class="btn btn-green" style="margin-bottom:15px;margin-right:7px;">Kategori: <?php echo $row->nama_katdokumen; ?></a>


					<?php
					$no++;
				}
				?>
			</div>


			<h3 class="title-welcome rs" style="margin-top:30px;">Berita Terbaru <span class="fc-orange"><?php echo $judulan;?></span></h3>
<!--
<div class="wrap-title redborder clearfix">
    <h2 class="title-mark rs">Berita <span class="fc-orange">Terkini</span></h2>
    <a href="category.html" class="count-project be-fc-orange">View <span class="fw-b">Indeks</span> </a>
</div>
-->
<?php
$no=1;
foreach($beritaterbaru->result() as $row){
	$isi=strip_tags($row->isi_berita);
	$isi=substr($isi,0,170);
	$judul=seo_link($row->judul);
	$photopath = str_replace('-', '/', $row->tanggal_modif);
	$tanggal=$row->tanggal;
	if ($row->gambar!='') {
		$gambar=base_url() ."foto_berita/".$photopath."/small_".$row->gambar;
	}
	else {
		$gambar=base_url() ."foto_berita/image-default.jpg";
	}
	?>
	<div class="content-info-short clearfix">
		<a href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>" class="thumb-img">
			<div class="thumb-news1" data-original="<?php echo $gambar; ?>" style="background-image: url('<?php echo $gambar; ?>')"></div>
		</a>
		<div class="wrap-short-detail">
			<h3 class="rs acticle-title"><a class="be-fc-orange" href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>"><?php echo $row->judul; ?></a></h3>
			<p class="rs tiny-desc"><?php echo nama_hari($tanggal).', ';?> <span class="fw-b fc-gray"><?php   echo tgl_indo($tanggal).' | '; echo $row->jam.' WIB ';
			?></span></p>
			<p class="rs title-description"><?php echo $isi; ?>...</p>
		</div>
	</div>
	<?php
	$no=$no+1;
}
?>


</div>
</div>

<?php
}
elseif ($this->uri->segment(2,0)=='detail') { ?>
	<style>
	#ver-zebra3 {
		width: 100%;
		text-align: left;
		margin-top: 10px;
		margin-bottom: 10px;
		border-bottom: 1px solid #ccc;
	}
	#ver-zebra3 td {
		padding: 8px;
		line-height: 160%;
		color: #161313;
	}
	#ver-zebra5 {
		width: 100%;
		text-align: left;
		border-collapse: collapse;
		margin-bottom: 10px;
	}
	#ver-zebra5 td {
		padding: 5px;
		border-bottom: 1px solid #1bf216;
		line-height: 160%;
		color: #161313;
	}
	#ver-zebra5 td a{
		font-weight:bold;
		color:#000;
		font-size:15px;
	}
	.ver-zebra2 {
		width: 100%;
		text-align: left;
		border-collapse: collapse;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	.oce-first {
		background: #f0f0f0;
		border-left: 6px solid #ddd;
	}
	.ver-zebra2 td {
		padding: 3px;
		border: 1px solid #ddd;
		line-height: 160%;
		color: #161313;
	}
</style>
<?php
if (count($detail_berita)) {
	foreach($detail_berita as $row){
		$judul=seo_link($row->nama_katdokumen);
		?>
		<div class="content grid_9 allberita marked-category">
			<div class="single-page">
				<div class="box-single-content">
					<div class="breadcrumb">

						<a href="<?php echo base_url(); ?>">Beranda </a>/ <a href="<?php echo base_url(); ?>dok">Dokumen Laporan </a> / <a href="<?php echo base_url(); ?>dok/kategori/<?php echo $row->id_katdokumen; ?>">Kategori: <?php echo $row->nama_katdokumen;?> </a>

					</div>

					<br>
					<h3 class="rs single-title"><?php echo $judulan;?></h3>
					<p class="rs post-by"><?php echo $postingby; ?></p>





					<center>

					</center>
					<table class="ver-zebra2">    <colgroup><col class="oce-first"></colgroup>

						<tbody><tr><td width="200">Tahun Dokumen</td>  <td width="500">: <strong> <?php echo $row->tahun; ?> </strong></td>  </tr><tr>
						</tr><tr><td>Keterangan</td>  <td> : <?php echo $row->jangkrik; ?></td></tr>
						<tr><td>Tanggal Upload</td>  <td> : <?php
						$tanggal=$row->tanggal;
						echo nama_hari($tanggal).', ';
						echo tgl_indo($tanggal);

						?></td></tr>
						<tr><td>Didownload</td>  <td> :  <?php echo $row->dibaca; ?> Kali</td></tr>
						<tr>  <td>Link File</td>     <td>:   <?php if ($row->metode_link==1) { ?>
							<a href="<?php echo base_url(); ?>dokumen/<?php echo $row->nama_file;?>" target="_blank"><b>Download</b></a>
						<?php } else { ?>
							<a href="<?php echo $row->link_file; ?>" target="_blank"><b>Download</b></a>
						<?php } ?>
					</td></tr>
				</tbody>
			</table>

			<?php
		}
		?>
		<div class="clearfix"></div>

		<?php
		$id=$row->id_dokumen;
		$ip_addr = $this->input->ip_address();
 // $ip_addr = $this->input->ip_address();
 // $dibaca=$row->dibaca;


		$data = array('dibaca' => $row->dibaca + 1);
		$where = "id_dokumen = '".$row->id_dokumen."'";
		$str = $this->db->update('dokumen', $data, $where);
		?>
		<?php if(@$msg<>"") echo @$msg;

	}
	else { }
		?>
</div>

<div class="wrap-title redborder clearfix" style="margin-top:30px;">
	<h2 class="title-mark rs">Berita <span class="fc-orange">Terkini</span></h2>
	<a href="<?php echo base_url(); ?>berita" class="count-project be-fc-orange">View <span class="fw-b">Indeks</span> </a>
</div>
<?php
$no=1;
foreach($beritaterbaru->result() as $row){
	$isi=strip_tags($row->isi_berita);
	$isi=substr($isi,0,170);
	$judul=seo_link($row->judul);
	$photopath = str_replace('-', '/', $row->tanggal_modif);
	$tanggal=$row->tanggal;
	if ($row->gambar!='') {
		$gambar=base_url() ."foto_berita/".$photopath."/small_".$row->gambar;
	}
	else {
		$gambar=base_url() ."foto_berita/image-default.jpg";
	}
	?>
	<div class="content-info-short clearfix">
		<a href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>" class="thumb-img">
			<div class="thumb-news1" data-original="<?php echo $gambar; ?>" style="background-image: url('<?php echo $gambar; ?>')"></div>
		</a>
		<div class="wrap-short-detail">
			<h3 class="rs acticle-title"><a class="be-fc-orange" href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>"><?php echo $row->judul; ?></a></h3>
			<p class="rs tiny-desc"><?php echo nama_hari($tanggal).', ';?> <span class="fw-b fc-gray"><?php   echo tgl_indo($tanggal).' | '; echo $row->jam.' WIB ';
			?></span></p>
			<p class="rs title-description"><?php echo $isi; ?>...</p>
		</div>
	</div>
	<?php
	$no=$no+1;
}
?>

</div>
</div>

<?php }
//---- KONDISI BILA KATEGORI BERIT ------------
else if ($this->uri->segment(2,0)=='kategori') {
	?>

	<div class="content grid_9 allberita marked-category">
		<div class="single-page">
			<div class="box-single-content">
				<div class="breadcrumb">
					<a href="<?php echo base_url(); ?>">Beranda </a>/ <a href="<?php echo base_url(); ?>dok"> Dokumen </a>
				</div>
				<br>
				<h3 class="rs single-title"><?php echo $judulan; ?></h3>
				<p class="rs post-by"><?php echo $postingby; ?></p>
				<?php
				if (count($artikel)) {
					?>
					<div id="no-more-tables" style="*padding:15px;margin:0 auto;">
						<table class="col-md-12 table-bordered table-striped table-condensed cf" style="margin-bottom:15px;">
							<thead class="cf">

								<tr bgcolor="#F2F2F2" align="left">
									<th width="4% !important">No</th>
									<th width="25% !important">Judul Dokumen</th>
									<th width="8% !important">Tahun</th>
									<th width="13% !important">Tanggal Upload</th>
									<th width="8% !important"><center>Detail</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!is_numeric($this->uri->segment(4))){		$no=1;	}
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
										<td data-title="No"><?php echo $no; ?></td>
										<td  data-title="Judul"><b><?php echo $row['judul'];?></b> <br>
											<?php echo $row['jangkrik'];?>  </td>

											<td align="center" data-title="Tahun">
												<?php
												echo $row['tahun'];
												?>
											</td>
											<td align="center"  data-title="Tgl Upload">

												<?php
												$tanggal=$row['tanggal'];
												echo nama_hari($tanggal).', ';
												echo tgl_indo($tanggal);

												?>
											</td>
											<td align="center"  data-title="Detail">
												<a href="<?php echo base_url(); ?>dok/detail/<?php echo $row['id_dokumen']."/".$judul."/";?>"><b>Detail</b></a>
											</td>
										</tr>
										<?php
										$no++;
									}
									?>
								</tbody>
							</table>
						</div>
						<div class="clearfix"></div>
						<center>
							<div class="pagination">
								<ul class="tsc_pagination">
									<?php echo $pagination; ?>
								</ul>
							</div>
						</center>
						<?php
					}
					else {
						?>
						<h4 >Maaf, Data Belum Tersedia !</h4>
						<?php
					}
					?>
				</div>
<!--
<div class="wrap-title redborder clearfix">
    <h2 class="title-mark rs">Berita <span class="fc-orange">Terkini</span></h2>
    <a href="category.html" class="count-project be-fc-orange">View <span class="fw-b">Indeks</span> </a>
                </div>
<?php
$no=1;
	foreach($beritaterbaru->result() as $row){
	$isi=strip_tags($row->isi_berita);
	$isi=substr($isi,0,170);
	$judul=seo_link($row->judul);
	$photopath = str_replace('-', '/', $row->tanggal_modif);
	$tanggal=$row->tanggal;
	if ($row->gambar!='') {
		$gambar=base_url() ."foto_berita/".$photopath."/small_".$row->gambar;
	}
	else {
		$gambar=base_url() ."foto_berita/image-default.jpg";
	}
?>
<div class="content-info-short clearfix">
	<a href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>" class="thumb-img">
		<div class="thumb-news1" data-original="<?php echo $gambar; ?>" style="background-image: url('<?php echo $gambar; ?>')"></div>
	</a>
    <div class="wrap-short-detail">
		<h3 class="rs acticle-title"><a class="be-fc-orange" href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>"><?php echo $row->judul; ?></a></h3>
        <p class="rs tiny-desc"><?php echo nama_hari($tanggal).', ';?> <span class="fw-b fc-gray"><?php   echo tgl_indo($tanggal).' | '; echo $row->jam.' WIB ';
		?></span></p>
        <p class="rs title-description"><?php echo $isi; ?>...</p>
	</div>
</div>
<?php
$no=$no+1;
}
?>
-->

</div>
</div>


<?php } ?>