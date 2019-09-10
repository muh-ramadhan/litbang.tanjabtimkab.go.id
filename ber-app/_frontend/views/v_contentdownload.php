

<div class="breadcrumb">

	<a href="<?php echo base_url(); ?>">Beranda </a>/

</div>

<div id="frames">
	<div class="titlealbum">File Download</div>
	<div class="datehour">
		Diposting oleh: <strong>Staff Pemkab Tanjung Jabung Timur</strong>
	</div>
	<br>


	<?php if ($artikel) {	?>
		<table id="ver-zebra3">
			<tbody><tr><th>No</th><th>Judul File</th><th>Tanggal Upload</th><th>Keterangan</th><th>Link File</th> </tr>


				<?php
				//$row['isi_berita']
				 //$no=$this->uri->segment(3);

				if ($this->uri->segment(2)=='index') {
					$no=$this->uri->segment(3)+1;
				}
				else {
					$no=1;
				}			foreach($artikel as $key => $row){
						//		$judul=seo_link($row['nama_pegawai']);
//$row['id_pengumuman']
					?>

					<tr>
						<td><?php echo $no; ?></td>
						<td style="width:30%;"><b><?php echo $row['judul'];?></b> </td>
						<td align="center">
							<?php
							$tanggal=$row['tgl_upload'];
							echo nama_hari($tanggal).', ';
							echo tgl_indo($tanggal);

							?>
						</td>
						<td align="center">
							<?php
							echo $row['keterangan'];
							?>
						</td>
						<td align="center">
							<?php


							?>
						</td>

					</tr>
					<?php
		  // $no=$this->uri->segment(3);
					$no++;
				} ?>
			</tbody></table>

			<br>
			<div class="pagination">
				<?php echo $pagination; ?></div>
			<?php }
			else {?>
				Maaf !, Data Belum Tersedia
			<?php }
			?>

		</div>
