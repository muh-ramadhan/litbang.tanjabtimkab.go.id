<div class="breadcrumb">


	<a href="<?php echo base_url(); ?>">Beranda </a>/



</div><br>
<center>
	<div class="titlealbum">Video Kegiatan dan Profil Pemerintah Kab. Tanjung Jabung Timur</div>
	<div class="datehour">
		Diposting oleh: <strong>Staff Pemkab Tanjung Jabung Timur</strong>
	</div>

</center>



<div id="leftmenualbum">


	<div class="menu">
		<b>Berita Terbaru</b><br><br>

		<span class="informasilainnya">
			<span class="artikelcontent">
				<ul>
					<?php
					foreach($beritarandom->result() as $row){
						$judul=seo_link($row->judul);

						?>
						<li><a href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>"> <?php echo $row->judul; ?> </a></li>


					<?php } ?>



				</ul>
			</span>
		</span>



	</div>

	<script type='text/javascript'>make_tree_menu('example1');</script>

</div>



<div id="content-album">

	<center><iframe class="youtube-player" id="youtube" type="text/html" width="620" height="480" src="http://www.youtube.com/embed/jkZeYDdA23A" frameborder="0">
	</iframe></center>
	<br>

	<table id="videogaleri2"><tr>
		<?php
		$col = 2;
		$cnt = 0;
		foreach($video->result() as $row){



  //echo $row->jam.' WIB | Kategori: ';

			if ($cnt >= $col) {
				?>
			</tr><tr>
				<?php
				$cnt = 0;
			}
			$cnt++;
			?>
			<td align="center" valign="top" >


				<img src="<?php echo base_url(); ?>style/images/icon-video.gif" style='float:left;'><a href="<?php echo $row->link_vid; ?> " target='youtube'><b><?php echo $row->judul_vid; ?> </b></a> <br>Tanggal Video: <?php $tanggal=$row->tgl_posting; echo nama_hari($tanggal).", ";
				echo tgl_indo($tanggal); ?>


			</td>
		<?php	}?>
	</tr></table>
</div>