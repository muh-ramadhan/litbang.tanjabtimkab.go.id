
<div class="content grid_9 allberita marked-category">
	<div class="single-page">
		<div class="box-single-content">
			<div class="breadcrumb">
				<a href="<?php echo base_url(); ?>"><span>Beranda</span> </a><a href="<?php echo base_url(); ?>berita"><span style="background:#F8C300;color: #000; margin-left:-5px;text-shadow: 0px 1px 1px #fff;">Pencarian Berita</span>  </a>
			</div>
			<br><br>

			<h3>Pencarian Keyword Berita: <span style="color:#ff0000"><i><?php echo $kata;?></i></span></h3>
			<br>
			<?php
			if (count($cariberita)) {
				foreach($cariberita as $key => $row){
					$isi=strip_tags($row->isi_berita);
					$isi=substr($isi,0,220);
					$judul=seo_link($row->judul);
					$photopath = str_replace('-', '/', $row->tanggal_modif);
					$a=substr($row->tanggal, 0,4);
					$b=substr($row->tanggal, 5,2);
					$c=substr($row->tanggal, 8,9);
					$tanggal=$c.'/'.$b.'/'.$a;
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
							<p class="rs tiny-desc"><?php echo nama_hari($row->tanggal).', ';?> <span class="fw-b fc-gray"><?php   echo tgl_indo($row->tanggal).' | '; echo $row->jam.' WIB ';
							?></span></p>
							<p class="rs title-description"><?php echo $isi; ?>...</p>
						</div>
					</div>
					<?php
				}
			}
			else {
				?>
				<h4 >Maaf, Data Belum Tersedia !</h4>
				<?php
			}
			?>
			<br>
			<br>
		</div>
	</div>
</div>

