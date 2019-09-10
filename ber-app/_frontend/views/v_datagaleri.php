<!DOCTYPE html>
<html lang="en">
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Cache-control" content="no-cache">
	<meta name="robots" content="index, follow" />
	<meta name="keywords" content="<?php echo $keyword; ?>">
	<meta name="title" content="<?php echo $judulapp; ?>" />
	<meta name="author" content="Bermultimedia.com" />
	<meta name="description" content="<?php //echo $deskripsi; ?>SuaraJambi.com | Berita dan Informasi">
	<title><?php echo $judulapp; ?></title>

	<meta property="og:description" content="<?php //echo $judulapp; ?>SuaraJambi.com | Berita dan Informasi"/>

	<meta property="fb:app_id" content="134668073230548"/>
	<meta property="og:title" content="<?php echo $judulapp; ?>"/>
	<?php
	if ($this->uri->segment(1,0)=='read') {
		?>
		<base href="<?php echo current_url(); ?>"/>
		<?php
		foreach($detail_berita->result() as $row){
			$photopath = str_replace('-', '/', $row->tanggal_modif);
			if  ($row->gambar!='') {
				$gambar=   base_url() ."foto_berita/".$photopath."/".$row->gambar;
			}
			else {
				$gambar=   base_url() ."foto_berita/default-image-big.jpg";
			}
			?>
			<meta property="og:image" content="<?php echo $gambar; ?>"/>
			<link rel="image_src" href="<?php echo $gambar; ?>" />

			<?php
		}
	}
	else {
		$gambar=   base_url() ."foto_berita/default-image-wide.jpg";
		?>
		<meta property="og:image" content="<?php echo $gambar; ?>"/>
		<link rel="image_src" href="<?php echo $gambar; ?>" />
		<base href="<?php echo base_url(); ?>"/>
		<?php
	}
	?>
	<meta property="og:type" content="article"/>
	<meta property="og:url" content="<?php echo current_url(); ?>"/>
	<meta property="og:site_name" content="KECAMATANTELANAIPURA.COM"/>
	<meta property="og:locale" content="id_ID"/>
	<meta property="my:fb" content="on"/>

	<meta name="alexaVerifyID" content="QQ4z9L44M4FeRfCV-exkU5e0Ru4" />
	<meta http-equiv="refresh" content="900">
	<meta content='Aeiwi, Alexa, AllTheWeb, AltaVista, AOL Netfind, Anzwers, Canada, DirectHit, EuroSeek, Excite, Overture, Go, Google, HotBot, InfoMak, Kanoodle, Lycos, MasterSite, National Directory, Northern Light, SearchIt, SimpleSearch, WebsMostLinked, WebTop, What-U-Seek, AOL, Yahoo, WebCrawler, Infoseek, Excite, Magellan, LookSmart, CNET, Googlebot' name='search engines'/>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo base_url(); ?>feed.php?sindikasi=rss" />

	<meta name="copyright" content="Copyright 2015 Kecamatantelanaipura.com" />

	<link href="<?php echo base_url(); ?>style/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/menu.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/slippry.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/fonts.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/social-buttons.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/tree.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/lightbox.min.css" rel="stylesheet">


	<script src="<?php echo base_url(); ?>style/js/jquery-1.8.0.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>style/js/slippry.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>style/js/social-buttons.js"></script>
	<script src="<?php echo base_url(); ?>style/js/TreeMenu.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>style/js/lightbox-plus-jquery.min.js" type="text/javascript"></script>

 <!--
    <script src="<?php echo base_url(); ?>style/js/jquery-1.4.js" type="text/javascript"></script>


  <link rel="stylesheet" href="<?php echo base_url(); ?>style/js/lightbox/themes/default/jquery.lightbox.css" type="text/css" />
<script src="<?php echo base_url(); ?>style/js/lightbox/jquery.lightbox.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('.lightbox').lightbox();
		});
  </script>
-->
<link rel="stylesheet" href="<?php echo base_url(); ?>style/css/skin.css" type="text/css" />




<link rel="shortcut icon" href="<?php echo base_url(); ?>style/images/favicon.png">
</head>
<body>

	<!-- Script Facebook -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1";
	fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
	<?php $this->load->view($vheader); ?>
</div>


<div class="templatemo_main">
	<div class="container-fluid">

		<br>

		<div class="clearfix flex">
	<!--
		<div class="col-md1 left">
			<?php //$this->load->view($vkiri); ?>
		</div>
	-->
	<div class="main-column-galeri abuabusoft left">
		<style>
		.main-column-galeri .titlealbum  {
			color:#fff;
			margin-bottom:0;
		}
		.main-column-galeri .datehour {
			color:#ffff00;
			font-size:16px;
		}
	</style>
	<div style="text-align:center;padding:10px 0;" class="biru">
		<div class="titlealbum">Galeri Kegiatan Kecamatan Telanaipura</div>
		<div class="datehour">
			Diposting oleh: <strong><?php echo $postingby; ?></strong>
		</div>

	</div>
	<div class="contentpad">
		<?php $this->load->view($vdata); ?>
	</div>
</div>
		<!--
		<div class="col-md1 right">

		</div>
	-->
</div>
</div>
</div>


<script>
	$(function() {
		var demo1 = $("#demo1").slippry({
					// transition: 'fade',
					// useCSS: true,
					// speed: 1000,
					// pause: 3000,
					// auto: true,
					// preload: 'visible',
					// autoHover: false
				});

		$('.stop').click(function () {
			demo1.stopAuto();
		});

		$('.start').click(function () {
			demo1.startAuto();
		});

		$('.prev').click(function () {
			demo1.goToPrevSlide();
			return false;
		});
		$('.next').click(function () {
			demo1.goToNextSlide();
			return false;
		});
		$('.reset').click(function () {
			demo1.destroySlider();
			return false;
		});
		$('.reload').click(function () {
			demo1.reloadSlider();
			return false;
		});
		$('.init').click(function () {
			demo1 = $("#demo1").slippry();
			return false;
		});
	});
</script>

<div class="clearfix"></div>
<footer class="footer">
	<?php $this->load->view($vfooter); ?>
</footer>

</body>
</html>
