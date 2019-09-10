<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $judulapp; ?></title>
	<meta http-equiv="refresh" content="500">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="Offical Website Pemerintah Kab. Tanjung Jabung Timur - Media Publikasi, Promosi dan Profil Kab. Tanjung Jabung Timur">
	<meta name="keywords" content="tanjung jabung timur, tanjabtim, pemkab tanjabtim, muarasabak, jambi sabak, bupati, tanjabtim samudera, bermultimedia">
	<meta content='Aeiwi, Alexa, AllTheWeb, AltaVista, AOL Netfind, Anzwers, Canada, DirectHit, EuroSeek, Excite, Overture, Go, Google, HotBot, InfoMak, Kanoodle, Lycos, MasterSite, National Directory, Northern Light, SearchIt, SimpleSearch, WebsMostLinked, WebTop, What-U-Seek, AOL, Yahoo, WebCrawler, Infoseek, Excite, Magellan, LookSmart, CNET, Googlebot' name='search engines'/>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://tanjabtimkab.go.id/feed" />

	<meta name="author" content="bermultimedia.com" />
	<meta name="copyright" content="Copyright 2014 Tanjabtimkab.go.id" />



	<base href="<?php echo base_url(); ?>"/>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>

	<link href="<?php echo base_url(); ?>style/css/style.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>style/css/menu.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/menus2.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/kolom2.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/greatbg.css" rel="stylesheet">
	<!-- merdeka slide -->
	<link href="<?php echo base_url(); ?>style/css/slidemer.css" rel="stylesheet">
	<!-- smh headline -->
	<link href="<?php echo base_url(); ?>style/css/smh2.css" rel="stylesheet">

	<script src="<?php echo base_url(); ?>style/js/jquery-1.8.0.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>style/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>style/js/jquery.limit.js" type="text/javascript"></script>

	<script  type="text/javascript">
		$(document).ready(function() {

			$("#alamat").limit({
				limit: 200,
				id_result: "counter1",
				alertClass: "alert"
			});

			$("#pesan").limit({
				limit: 400,
				id_result: "counter",
				alertClass: "alert"
			});
		});
	</script>


	<script src="<?php echo base_url(); ?>style/js/cycle2.js" type="text/javascript"></script>





	<script src="<?php echo base_url(); ?>style/js/jquery.jcarousel.min.js" type="text/javascript"></script>



	<script src="<?php echo base_url(); ?>style/js/contentslider.js" type="text/javascript"></script>


	<link rel="stylesheet" href="<?php echo base_url(); ?>style/css/skin.css" type="text/css" />







	<script type="text/javascript">
		var amenuOptions2 =
		{
			menuId: "acdnmenuDemo",
			linkIdToMenuHtml: null,
			expand: "single",
			license: "2a8e9"
		};
		var amenuDemo = new McAcdnMenu(amenuOptions2);
	</script>





	<!-- Fav and touch icons -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>style/images/favicon.ico">



</head>
<body>


	<?php $this->load->view($vheader); ?>

	<div id="templatemo_main">
		<div id="templatemo_main_content">
			<div id="templatemo_main_left2" class="left">
				<?php //$this->load->view($vkiri1); ?>
			</div>

			<div id="templatemo_main_center2" class="right">

				<?php $this->load->view($vdata); ?>


			</div>

		</div>
	</div>


	<div id="sosmed">
		<div class="section social">
			<a href="https://twitter.com/#!/AT_Internet" id="twitter" target="_blank" onclick="return xt_click(this,'C','9','Footer::Banner::Twitter','S')">
				<span class="logo"></span>Twitter <span>Tell us </span>
			</a>
			<a href="https://plus.google.com/117492519948557315404/posts" id="google_plus" target="_blank" onclick="return xt_click(this,'C','9','Footer::Banner::Google','S')" rel="publisher">
				<span class="logo"></span>Google+ <span>Join us </span>
			</a>
			<a href="http://www.facebook.com/pages/AT-Internet-Online-Intelligence-Solutions/47665418370" id="facebook" target="_blank" onclick="return xt_click(this,'C','9','Footer::Banner::Facebook','S')">
				<span class="logo"></span>Facebook <span>Join us </span>
			</a>
			<a href="http://blog.atinternet.com/en/" id="blog" target="_blank" onclick="return xt_click(this,'C','9','Footer::Banner::Blog','S')">
				<span class="logo"></span>Blog <span>Latest trends</span>
			</a>
			<a href="#form-news" id="newsletter" class="nyroModal" onclick="return xt_click(this,'C','9','Footer::Banner::Newsletter','N')">
				<span class="logo"></span>Newsletter <span>Our latest news</span>
			</a>
		</div> <!-- .social -->

	</div>




	<div id="templatemo_footer_wrapper">

		<?php $this->load->view($vfooter); ?>

	</div>
</body>
</html>
