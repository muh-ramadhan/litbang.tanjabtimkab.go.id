<div class="breadcrumb">
	<a href="<?php echo base_url(); ?>">Beranda </a>/
</div>
<div id="frames">
	<div class="titlealbum">Jadwal Kegiatan Biro Kesejahteraan Rakyat & Masyarakat Provinsi Jambi</div>
	<div class="datehour">Diposting oleh: <strong>Staff Biro Kesramas Prov. Jambi</strong></div>
	<br>
	<p>Pilih/Klik Detail Kegiatan untuk data lebih lengkap.</p>
	<table id="ver-zebra3">
		<tbody>
			<tr>
				<th>No</th>
				<th>Tanggal Kegiatan</th>
				<th>Nama Kegiatan</th>
				<th>Tempat</th>
				<th>Detail</th>
			</tr>
			<?php
			if ($this->uri->segment(2)=='index') {
				$no=$this->uri->segment(3)+1;
			}
			else {
				$no=1;
			}
			foreach($artikel as $key => $row){
				$judul=seo_link($row['namakegiatan']);
				//$row['id_pengumuman']
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td style="width:25%;"> <?php $tanggal=$row['tgl_kegiatan']; echo nama_hari($tanggal).', '; echo tgl_indo($tanggal); ?></td>
					<td><b><?php echo $row['namakegiatan'];?></b></td>
					<td><?php echo $row['tempat']; ?></td>
					<td align="center">
						<a href="<?php echo base_url(); ?>kegiatan/detail/<?php echo $row['id_kegiatan']."/".$judul."/";?>"><b>Detail</b></a>
					</td>
				</tr>
				<?php
				// $no=$this->uri->segment(3);
				$no++; } ?>
			</tbody>
		</table>
		<br>
		<div class="pagination">
			<?php echo $pagination; ?></div>
		</div>
