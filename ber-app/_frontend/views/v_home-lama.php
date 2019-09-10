
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
	<meta name="description" content="<?php  echo $deskripsi; ?> ">
	<title><?php echo $judulapp; ?></title>

	<meta property="og:description" content="<?php echo $judulapp; ?>"/>

	<meta property="fb:app_id" content="134668073230548"/>
	<meta property="og:title" content="<?php echo $judulapp; ?>"/>
	<?php
	$gambar=   base_url() ."foto_berita/default-image-big.jpg";
	?>
	<meta property="og:image" content="<?php echo $gambar; ?>"/>
	<link rel="image_src" href="<?php echo $gambar; ?>" />
	<base href="<?php echo base_url(); ?>"/>

	<meta property="og:type" content="article"/>
	<meta property="og:url" content="<?php echo current_url(); ?>"/>
	<meta property="og:site_name" content="DISKOMINFO.TANJABTIMKAB.GO.ID"/>
	<meta property="og:locale" content="id_ID"/>
	<meta property="my:fb" content="on"/>

	<meta name="alexaVerifyID" content="QQ4z9L44M4FeRfCV-exkU5e0Ru4" />
	<meta http-equiv="refresh" content="900">
	<meta content='Aeiwi, Alexa, AllTheWeb, AltaVista, AOL Netfind, Anzwers, Canada, DirectHit, EuroSeek, Excite, Overture, Go, Google, HotBot, InfoMak, Kanoodle, Lycos, MasterSite, National Directory, Northern Light, SearchIt, SimpleSearch, WebsMostLinked, WebTop, What-U-Seek, AOL, Yahoo, WebCrawler, Infoseek, Excite, Magellan, LookSmart, CNET, Googlebot' name='search engines'/>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo base_url(); ?>feed.php?sindikasi=rss" />

	<meta name="copyright" content="Copyright 2017 Diskominfo.Tanjabtimkab.go.id" />

	<link rel="shortcut icon" href="<?php echo base_url(); ?>style/images/favicon.png">

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,400italic"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/css/bootstrap.min.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/css/factory.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/css/template.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/css/apps.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/css/home.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/css/font-awesome.min.css"  />

	<script src="<?php echo base_url(); ?>style/js/swfobject-2.1.js" ></script>
	<script src="<?php echo base_url(); ?>style/js/jquery-1.11.1.min.js" ></script>
	<script src="<?php echo base_url(); ?>style/js/jquery-migrate-1.2.1.min.js" ></script>
	<script src="<?php echo base_url(); ?>style/js/jquery.form.20140218.min.js" ></script>
	<script src="<?php echo base_url(); ?>style/js/jquery.printelement.min.js" ></script>
	<script src="<?php echo base_url(); ?>style/js/bootstrap.min.js" ></script>
	<script src="<?php echo base_url(); ?>style/js/default.js" ></script>
	<script src="<?php echo base_url(); ?>style/js/carousel-module.js" ></script>
	<script src="<?php echo base_url(); ?>style/js/office-locations-module.js" ></script>
	<script src="<?php echo base_url(); ?>style/js/get-connected-module.js" ></script>
</head>
<body>

	<?php $this->load->view($vheader); ?>
	<div class="main-content">
		<div class="home">


<!--
				<div class="module" id="announcements">
	<div class="announcements-inner">
		<div class="container">
			<p><a href="https://www.lgraham.senate.gov/public/index.cfm/press-releases?ID=DF05C992-E262-4653-AFEF-D16410277537"><strong>Important Update!</strong> Judiciary Committee Leaders Seek Copies Of Reported Comey Memos And Possible Trump Tapes</a></p>
		</div>
	</div>
				</div>
			-->



			<div class="home-top seed-1">
				<div class="container">
					<div class="row">
						<div class="col-md-8">



							<div class="module" id="carousel">
								<div class="carousel-tabs">
									<div class="carousel-tabs-inner">
										<?php
										$no=1;
										$beritaterbaru = $this->M_data->beritaterbaru2(0,4);
										foreach($beritaterbaru->result() as $row){
											$isi=strip_tags($row->isi_berita);
											$isi=substr($isi,0,180);
											$judul=seo_link($row->judul);
											$judulan=seo_link($row->nama_kategori);
											$photopath = str_replace('-', '/', $row->tanggal_modif);
											$a=substr($row->tanggal, 0,4);
											$b=substr($row->tanggal, 5,2);
											$c=substr($row->tanggal, 8,9);
											$tanggal=$c.'/'.$b.'/'.$a;
											if  ($row->gambar!='') {
												$gambar=base_url() ."foto_berita/".$photopath."/".$row->gambar;
											}
											else {
												$gambar=base_url() ."foto_berita/image-default.jpg";
											}

											?>
											<div class="carousel-tab" id="ct-<?php echo $no; ?>" style="background-image: url(<?php echo $gambar; ?>);">
												<div class="carousel-tab-inner">
													<div class="info">
														<h3 class="title"><a href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul;?>"><?php echo $row->judul; ?></a></h3>
														<p class="abstract"><?php echo $isi; ?></p>
														<a class="read-more" href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul;?>">Baca</a>
													</div>
												</div>
											</div>
											<?php
											$no=$no+1;
										} ?>


										<div class="carousel-tabs-nav">
											<span class="button button-previous"><button class="previous">Previous</button></span>
											<span class="button button-next"><button class="next">Next</button></span>
										</div>
									</div>
								</div>
								<div class="carousel-links row">
									<?php
									$no=1;
									foreach($beritaterbaru->result() as $row){
										$photopath = str_replace('-', '/', $row->tanggal_modif);
										if  ($row->gambar!='') {
											$gambar=base_url() ."foto_berita/".$photopath."/small_".$row->gambar;
										}
										else {
											$gambar=base_url() ."foto_berita/image-default.jpg";
										}

										?>
										<div class="carousel-link col-sm-3">
											<a href="#ct-<?php echo $no; ?>">
												<span class="carousel-link-image" style="background-image: url(<?php echo $gambar; ?>);"></span>
												<span class="title"><?php echo $row->judul; ?></span>
											</a>
										</div>
										<?php
										$no=$no+1;
									} ?>
								</div>
							</div>

							<br><br>
							<h3>ARTIKEL & MULTIMEDIA</h3>
							<hr>
							<?php
							$no=1;
							$artikel = $this->M_data->artikelterbaru2(0,4);
							foreach($artikel->result() as $row){
								$isi=strip_tags($row->isi_artikel);
								$isi=substr($isi,0,180);
								$judul=seo_link($row->judul);
								$judulan=seo_link($row->nama_kategori);
								$photopath = str_replace('-', '/', $row->tanggal_modif);
								$a=substr($row->tanggal, 0,4);
								$b=substr($row->tanggal, 5,2);
								$c=substr($row->tanggal, 8,9);
								$tanggal=$c.'/'.$b.'/'.$a;
								if  ($row->gambar!='') {
									$gambar=base_url() ."foto_artikel/".$photopath."/".$row->gambar;
								}
								else {
									$gambar=base_url() ."foto_berita/image-default.jpg";
								}

								?>
								<div class="content-info-short clearfix">
									<a href="<?php echo base_url(); ?>artikel/detail/<?php echo $row->id_artikel."/".$judul;?>" class="thumb-img">
										<img src="<?php echo $gambar; ?>" alt="<?php echo $row->judul; ?>">
									</a>
									<div class="wrap-short-detail">
										<h3 class="rs acticle-title"><a class="be-fc-orange" href="<?php echo base_url(); ?>artikel/detail/<?php echo $row->id_artikel."/".$judul;?>"><?php echo $row->judul; ?></a></h3>
										<p class="rs tiny-desc"><?php echo $row->hari; ?>,  <span class="fc-gray"><?php echo tgl_indo($row->tanggal); ?> | <?php echo $row->jam; ?> </span></p>
										<p class="rs title-description"><?php echo $isi; ?>...</p>
									</div>
								</div>
								<?php
								$no=$no+1;
							} ?>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-4">

							<div class="module" id="quick-links">

								<h2>Daftar Aplikasi </h2>
								<?php $this->load->view("v_aplikasi"); ?>
							</div>
							<div class="clearfix"></div>
							<hr>
							<center><a href="" class="button2"><i class="fa fa-th"></i>  | Semua Aplikasi</a></center>

							<div class="clearfix"></div>
							<br>
<!--
<br>
<div class="col-md-12 clear-pm">
	<div class="subpage-sidebar " style="border-bottom:3px solid #d4a216;">
		<div class="section submenu">
			<h3>Profil</h3>
				<ul class="">
					<li class="nav_congressional-delegation even active"><a href="https://www.lgraham.senate.gov/public/index.cfm/congressional-delegation">Congressional Delegation</a></li>
					<li class="nav_visiting-south-carolina odd last"><a href="https://www.lgraham.senate.gov/public/index.cfm/visiting-south-carolina">Visiting South Carolina</a></li>
				</ul>
		</div>
	</div>
</div>
<div class="clearfix"></div>
-->
<script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
<div id="gpr-kominfo-widget-container" style="*height:300px;"></div>
</div>

<div class="clearfix"></div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-4">
			<div class="sambutan" style="border-bottom:3px solid #d4a216;">
				<div class="col-md-6" style="padding:0;">
					<img src="<?php echo base_url(); ?>images/kadis.png" width="160">
				</div>
				<div class="col-md-6 deskripsi"><br>
					SAMBUTAN KEPALA<br>
					<om>DINAS KOMUNIKASI DAN INFORMATIKA </om><br>
					<om>KAB. TANJUNG JABUNG TIMUR</om>
					<hr>
					Herman Toni, SE, ME

				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="bidang col-md-12" style="border-bottom:3px solid #001347;">
				<h3> BIDANG DISKOMINFO </h3>
				<div class="col-bidang">
					<a href=""><img src="http://dishubkominfo.sukabumikab.go.id/icon/term.png"></a>
					<hr>
					Sekretariat Diskominfo
				</div>
				<div class="col-bidang">
					<a href=""><img src="http://dishubkominfo.sukabumikab.go.id/icon/term.png"></a>
					<hr>
					Bidang Pelayanan e-Gov
				</div>
				<div class="col-bidang">
					<a href=""><img src="http://dishubkominfo.sukabumikab.go.id/icon/term.png"></a>
					<hr>
					Bidang Pengelolaan Infokom
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="sambutan" style="border-bottom:3px solid #d4a216;">
				<img src="<?php echo base_url(); ?>images/iklan.jpg" width="100%">
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="home-top galerifoto">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ">
				<h3>GALERI KEGIATAN </h3>
				<a href="<?php echo base_url(); ?>galeri" class="button2" style="position: absolute; top: 0;right: 15px;"><i class="fa fa-photo"></i>  | Arsip Galeri</a>
				<hr>
			</div>
			<?php
			$fotokolom=$this->M_data->fotokolom(0,4);
			foreach($fotokolom->result() as $row){
				$isi=strip_tags($row->keterangan);
				$isi=substr($isi,0,140);
				$judul=seo_link($row->judul_fotoberita);
				$photopath = str_replace('-', '/', $row->tanggal_modif);
				$a=substr($row->tanggal, 0,4);
				$b=substr($row->tanggal, 5,2);
				$c=substr($row->tanggal, 8,9);
				$tanggal=$c.'/'.$b.'/'.$a;
				?>
				<div class="col-md-3">
					<div class="galeri">
						<img src="<?php echo base_url(); ?>foto_galeri/<?php echo$photopath; ?>/small_<?php echo $row->gbr_gallery;?>" width="100%">
						<div style="padding:10px;"><a href="<?php echo base_url(); ?>galeri/detail/<?php echo $row->id_fotoberita; ?>/<?php echo seo_link($row->judul_fotoberita); ?>"><?php echo $row->judul_fotoberita; ?></a>
							<br><span style="font-size:14px;">Tanggal: <?php echo $tanggal; ?></span>
						</div>
					</div>
				</div>

			<?php } ?>

		</div>
	</div>
</div>

<div class="home-top tengah">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 pengumuman border">
					<h3><i class="fa fa-bullhorn"></i> PENGUMUMAN </h3>
					<hr>
					<table>
						<?php
						$pengumuman=$this->M_data->pengumuman(5);
						foreach($pengumuman->result() as $row){
							$judul=seo_link($row->judul);
							$tahunp=substr($row->tanggal_pengumuman, 0,4);
							$bulanp=substr($row->tanggal_pengumuman, 5,2);
							$tanggalp=substr($row->tanggal_pengumuman, 8,10);
							$photopath = str_replace('-', '/', $row->tanggal_pengumuman);
							?>
							<tr>
								<td valign="top" width="120px">
									<div class="tanggal"> <?php echo $tanggalp; ?>/<?php echo $bulanp; ?>/<?php echo $tahunp; ?> </div>
									<span style="font-size:14px;">Jam <?php echo $row->jam; ?> WIB</span>
								</td>
								<td>
									<a href="<?php echo base_url(); ?>pengumuman/detail/<?php echo $row->id_pengumuman."/".$judul;?>"><?php echo $row->judul; ?></a>
								</td>
							</tr>
						<?php } ?>
					</table>
					<br>
					<a href="<?php echo base_url(); ?>pengumuman" class="email">Arsip Pengumuman</a>
					<div class="clearfix"></div> <br>
				</div>
				<div class="col-md-6 video border">
					<h3><i class="fa fa-film"></i> VIDEO </h3>
					<hr>
					<?php
					$video = $this->M_data->video(0,1);
					foreach($video->result_array() as $row) {
						$link=str_replace('watch?v=','embed/', $row['link']);
						?>
						<iframe width="100%" height="300" src="<?php echo $link; ?>" allowfullscreen></iframe>
						<?php
					}
					?>
					<center><a href="<?php echo base_url(); ?>video" class="email" style="border:1px solid #ccc;margin-top:12px;">Arsip Pengumuman</a></center><div class="clearfix"></div> <br>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="home-top">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="unduh " style="padding-bottom:15px;">
					<h3><i class="fa fa-folder-open"></i> DOWNLOAD DOKUMEN </h3>
					<table>
						<?php
						$dokumen=$this->M_data->ambildokumen(3);
						foreach($dokumen->result() as $row){
							$photopath = str_replace('-', '/', $row->tgl_upload);
							?>
							<tr><td valign="top" width="30px"> <i class="fa fa-copy"></i></td>
								<td><a href="<?php echo base_url(); ?>dokumen/detail/<?php echo $row->id_dokumen."/".$judul;?>"><?php echo $row->judul; ?></a><br><span style="font-size:14px;color:#666;">Update: <?php echo $photopath; ?></span></td></tr>

							<?php } ?>
						</table>
						<div class="clearfix"></div><br>
						<center><a href="<?php echo base_url(); ?>dokumen" class="button2"><i class="fa fa-th"></i>  | Semua Arsip Download</a></center>
					</div>
				</div>

				<div class="col-md-4">
					<div class="unduh polling " style="padding-bottom:15px;">
						<h3><i class="fa fa-user"></i>  E-POLLING </h3>
						<br>
						<form method="POST" action="<?php echo base_url(); ?>polling/vote"> <input type="hidden" name="idpolling" value="413"><div class="polling-1">Bagaimana Menurut Anda Informasi Yang kami Sediakan? </div><div class="pilihanpoll"><span class="news-text"><input type="radio" name="pilihan" value="1">Sangat Lengkap</span><br><span class="news-text"><input type="radio" name="pilihan" value="2">Lengkap</span><br><span class="news-text"><input type="radio" name="pilihan" value="3">Tidak lengkap</span><br><span class="news-text"><input type="radio" name="pilihan" value="4">Sangat Tidak Lengkap</span><br> <br>
							<button class="button2 btn-green" type="submit" style="border:inherit">Submit</button>
							<a href="<?php echo base_url(); ?>polling/" class="button2 btn-green">Lihat Hasil</a>
						</div></form>
					</div>
				</div>

				<div class="col-md-4">
					<div class="unduh " style="padding-bottom:15px;">
						<h3><i class="fa fa-link"></i> WEBLINK </h3>
						<ul>
							<?php
							$weblink=$this->M_data->weblink(4);
							foreach($weblink->result() as $row){
								$judul=seo_link($row->nama_weblink);
								?>
								<li><div class="left" style="height:30px;margin-right:10px;"><i class="fa fa-globe"></i></div><a href="<?php echo $row->link; ?>" target="_blank"><?php echo $row->nama_weblink; ?></a><br><?php echo $row->link; ?></li>
							<?php } ?>
						</ul>
						<div class="clearfix"></div><br>
						<center><a href="<?php echo base_url(); ?>weblinks" class="button2"><i class="fa fa-th-list"></i>  | Semua Link</a></center>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="home-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<script src="<?php echo base_url(); ?>style/js/highmaps.js"></script>
					<script src="<?php echo base_url(); ?>style/js/exporting.js"></script>
					<style>
					#container {
						height: 460px;
						*min-width: 360px;
						max-width: 640px;
						margin: 0 auto;
					}
					.loading {
						margin-top: 10em;
						text-align: center;
						color: gray;
					}
				</style>
				<script type='text/javascript'>
					$(document).ready(function () {
						$.getJSON('<?php echo base_url(); ?>home/map',
							function (data) {
    // Initiate the chart
    Highcharts.mapChart('container', {

    	chart: {
        //borderWidth: 1,
        margin:10,
        backgroundColor:'transparent',
        spacing: [10, 10, 15, 10],
    },

    title: {
    	text: 'Data Kecamatan Kab. Tanjung Jabung Timur'
    },
    subtitle : {
    	text : '<a href="http://tanjabtimkab.go.id">Tanjabtimkab.go.id</a>'},

    	mapNavigation: {
    		enabled: true,
    		buttonOptions: {
    			verticalAlign: 'top'
    		}
    	},

    	tooltip: {
    		backgroundColor: 'none',
    		borderWidth: 0,
    		shadow: false,
    		useHTML: true,
    		hideDelay: 12000,
    		padding: 0,
    		followPointer: true,
    		followTouchMove: true,
    		pointFormat: '<div style="padding:8px 0;border-bottom:1px solid #ff0000;"><span style="font-size:18px">{point.name}</span></div><br>' +
    		'<span style="font-size:14px">Desil 1: {point.desil1} KK</span><br>' +
    		'<span style="font-size:14px">Desil 2: {point.desil2} KK</span><br>' +
    		'<span style="font-size:14px">Desil 3: {point.desil3} KK</span><br>' +
    		'<span style="font-size:14px">Desil 4: {point.desil4} KK</span> <br>',
				//'<span style="font-size:14px">Detail Data: <a href="{point.URLs}">Link </a></span>',
				positioner: function () {
					return { x: 0, y: 310 };
				}
			},
		/*
        colorAxis: {
            min: 1,
            max: 1000,
            type: 'logarithmic'
        },
        */
		/*
        legend: {
            title: {
                text: 'Population density per km?',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }
        },
        */
        credits: {
        	enabled: true,
        	href: "http://www.diskominfo.tanjabtimkab.go.id",
        	text: "Diskominfo Kab. Tanjung Jabung Timur",
        	style: { "cursor": "pointer", "color": "#999999", "fontSize": "10px" },
        },

        plotOptions: {
        	series: {
        		cursor: 'pointer',
        		point: {
        			events: {
        				click: function () {
                        //location.href = 'https://en.wikipedia.org/wiki/';
						//location.href = event.point.URLs;
						//this.point.options.URLs;
						//location.href = 'https://en.wikipedia.org/wiki/';
						//+ this.options.key
					}
					/*
									click: function() {
                                        var someURL = this.series.userOptions.URLs[this.x]; // onclick get the x index and use it to find the URL
                                        if (someURL)
                                            window.open('http://'+someURL);
                                    }
                                    */
                                }
                            }
                        }
                    },

                    series: [{
                    	name: 'Data',
                    	showInLegend: false,
                    	borderColor: "#fff",
        //mapData: Highcharts.maps['custom/europe'],
		//joinBy: ['iso-a2', 'code'], // <- mapping 'name' in data to 'name' in mapData
		mapData: [
		{
			"name": "Kec. Nipah Panjang",
			"color": "#8aa1d0",
			"hc-key":"15.07.02",
			"desil1": 568,
			"desil2": 773,
			"desil3": 295,
			"desil4": 93,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.02",
				"path": "M628,-779,607,-706,623,-703,633,-700,639,-703,634,-708,637,-711,642,-712,646,-732,653,-731,658,-716,655,-712,658,-711,661,-715,665,-718,672,-715,671,-723,675,-724,682,-720,688,-707,702,-696,713,-680,710,-671,711,-667L716,-667L732,-677,765,-682,776,-666,846,-668,869,-664,866,-684,853,-704,845,-706,832,-729,842,-739,846,-737,853,-749,857,-750,858,-753,852,-758,849,-760,829,-755,808,-756,791,-755,773,-745,766,-745,755,-738,744,-739,732,-749,711,-754,679,-752,683,-757,671,-763,658,-769,646,-771zM756,-765,750,-762,749,-759,756,-757,754,-755,750,-750,749,-743,763,-746,786,-763,786,-767zM742,-766,748,-766,747,-760,746,-757,751,-755,747,-750,745,-746,740,-749,733,-756,735,-760zM727,-766,728,-759C728,-759,725,-757,725,-758,725,-759,724,-763,724,-763L727,-766z"
			},
			{
				"name": "Kec. Mendahara Ulu",
				"color": "#6382c1",
				"hc-key":"15.07.09",
				"desil1": 402,
				"desil2": 593,
				"desil3": 246,
				"desil4": 92,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.09",
				"path": "M273,-689,268,-578,258,-572,232,-564,210,-563,215,-557,214,-552,211,-546,212,-539,216,-534,215,-524,211,-517,210,-502,201,-504,202,-531,156,-532,155,-523L109,-523L55,-570,0,-574,5,-580,7,-598,43,-599,63,-607,72,-614,80,-620,82,-634,89,-646,102,-647,102,-651,98,-658,100,-686,96,-689,102,-700,102,-705,96,-708,81,-729,123,-729,172,-707,176,-715,202,-695,224,-689z"
			},
			{
				"name": "Kec. Mendahara",
				"color": "#9db0d8",
				"hc-key":"15.07.03",
				"desil1": 500,
				"desil2": 972,
				"desil3": 408,
				"desil4": 148,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.03",
				"path": "M81,-729,123,-729,172,-707,176,-715,202,-695,224,-689,273,-689L273,-689L278,-690,296,-734,351,-747,348,-751,349,-755,346,-763,340,-770,345,-773,352,-782,358,-777,361,-780,357,-785L357,-800L360,-809,331,-835,317,-838,307,-836,304,-839,297,-838,290,-832L290,-834L294,-839,291,-848,278,-858,261,-868,254,-868,253,-872,233,-890,223,-904,215,-900,207,-900,202,-891,204,-885,200,-883,196,-873,202,-870,196,-867,198,-860,203,-859,203,-856,198,-857,197,-848L202,-848L202,-845L197,-845L190,-834,195,-833,191,-826,187,-828,182,-818,187,-814,180,-813,176,-808,178,-804,177,-801,172,-801,168,-797,166,-792,157,-794,156,-789,151,-792,118,-768,109,-771,90,-756,88,-758,83,-750,88,-740,80,-737z"
			},
			{
				"color": "#8ca3d1",
				"name": "Kec. Muara Sabak Barat",
				"hc-key":"15.07.07",
				"desil1": 214,
				"desil2": 514,
				"desil3": 239,
				"desil4": 69,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.07",
				"path": "M437,-716,422,-713,411,-712,412,-708,407,-709,404,-712,395,-705,381,-697,361,-692,364,-683,370,-686,376,-680,376,-671,375,-669,376,-664L376,-656L372,-653L372,-645L369,-640,372,-629,361,-617,366,-604,371,-601,373,-590,360,-588,360,-565,370,-554,370,-501,439,-511,438,-541,440,-548,443,-566,440,-570,448,-574,445,-581,455,-587,452,-614,459,-618,466,-632,464,-638,474,-653,472,-661,463,-674,454,-671,442,-687,441,-707z"
			},
			{
				"name": "Kec. Geragai",
				"color": "#7590c8",
				"hc-key":"15.07.10",
				"desil1": 137,
				"desil2": 618,
				"desil3": 423,
				"desil4": 142,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.10",
				"path": "M351,-747,359,-749,365,-740,355,-738,354,-728,366,-717,363,-711,359,-705,361,-692,364,-683,370,-686,376,-680,376,-671,375,-669,376,-664L376,-656L372,-653L372,-645L369,-640,372,-629,361,-617,366,-604,371,-601,373,-590,360,-588,360,-565,370,-554,370,-501,346,-497,287,-440,263,-430,245,-427,218,-455,219,-501,210,-502,211,-517,215,-524,216,-534,212,-539,211,-546,214,-552,215,-557,210,-563,232,-564,258,-572,268,-578,273,-689,278,-690,296,-734z"
			},
			{
				"name": "Kec. Kuala Jambi",
				"color": "#4f72b9",
				"hc-key":"15.07.08",
				"desil1": 293,
				"desil2": 506,
				"desil3": 249,
				"desil4": 73,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.08",
				"path": "M360,-809,357,-800L357,-785L361,-780,358,-777,352,-782,345,-773,340,-770,346,-763,349,-755,348,-751,351,-747,359,-749,365,-740,355,-738,354,-728,366,-717,363,-711,359,-705,361,-692,381,-697,395,-705,404,-712,407,-709,412,-708,411,-712,422,-713,437,-716,432,-726,412,-741,417,-757,429,-756,445,-752,447,-771,442,-789,429,-787,412,-793,402,-801,364,-801z"
			},
			{
				"name": "Kec. Sadu",
				"color": "#8ca3d1",
				"hc-key":"15.07.05",
				"desil1": 330,
				"desil2": 457,
				"desil3": 170,
				"desil4": 65,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.05",
				"path": "M880,-777,869,-764,852,-758,858,-753,857,-750,853,-749,846,-737,842,-739,832,-729,845,-706,853,-704,866,-684,869,-664,852,-644,880,-491,889,-451,882,-443,874,-430,878,-357,888,-254,897,-257,908,-255,915,-258,919,-262,926,-260,931,-264,934,-263,935,-260,938,-259,940,-263,942,-260,941,-255,945,-251,951,-253,954,-257,965,-248,969,-252,971,-249,967,-246,968,-243,973,-246,978,-242,988,-231,992,-229,993,-224,995,-219,997,-218,1000,-220,992,-235,977,-260,960,-314,959,-333,947,-368,955,-408,965,-439,964,-458,960,-465,965,-510,951,-525,956,-527,955,-533,932,-565,919,-586,911,-603,908,-630,914,-653,921,-663,918,-682,918,-691,909,-728,904,-747,886,-776z"
			},
			{
				"name": "Kec. Berbak",
				"color": "#3b62b1",
				"hc-key":"15.07.11",
				"desil1": 508,
				"desil2": 701,
				"desil3": 158,
				"desil4": 41,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.11",
				"path": "M888,-254L888,-254L885,-253,867,-257,838,-277,830,-289,815,-320,788,-331,736,-396,731,-404,715,-421,699,-445,698,-452,663,-510,652,-525,634,-540,592,-533,592,-624,605,-628,606,-624,597,-612,600,-606,613,-612,616,-610,618,-603,622,-604,632,-612,683,-600,691,-619,682,-623,677,-632,686,-637,703,-627,714,-632,726,-649,739,-660L751,-660L751,-664,732,-677,765,-682,776,-666,846,-668,869,-664,852,-644,879,-496,879,-494,888,-455,889,-451,882,-443,874,-430,878,-369,879,-353,883,-312,887,-266z"
			},
			{
				"name": "Kec. Dendang",
				"color": "#7e97cb",
				"hc-key":"15.07.06",
				"desil1": 229,
				"desil2": 542,
				"desil3": 385,
				"desil4": 151,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.06",
				"path": "M439,-511,592,-533,592,-624,593,-631,562,-653,559,-659,548,-664,520,-651,511,-657,509,-669,495,-673,472,-661,474,-653,464,-638,466,-632,459,-618,452,-614,455,-587,445,-581,448,-574,440,-570,443,-566,440,-548,438,-541z"
			},
			{
				"name": "Kec. Muara Sabak Timur",
				"color": "#5476ba",
				"hc-key":"15.07.01",
				"desil1": 315,
				"desil2": 1091,
				"desil3": 634,
				"desil4": 237,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.01",
				"path": "M628,-779,607,-706,623,-703,628,-696,622,-688,617,-698,613,-698,615,-690,605,-687,606,-683L615,-683L618,-677,610,-678,605,-674,604,-665,601,-665,594,-672,586,-662,587,-657,565,-672,548,-664,520,-651,511,-657,509,-669,495,-673,472,-661,463,-674,454,-671,442,-687,441,-707,437,-716,432,-726,412,-741,417,-757,429,-756,445,-752,447,-771,442,-789,461,-797,464,-794,466,-797,481,-805,485,-804,490,-809,503,-810,533,-801,537,-799,545,-802,590,-797,603,-792,606,-787,611,-788z"
			},
			{
				"name": "Kec. Rantau Rasau",
				"hc-key":"15.07.04",
				"desil1": 293,
				"desil2": 1129,
				"desil3": 723,
				"desil4": 193,
				//"URLs" : "http://localhost/simiskin/admin//kecamatan/15.07.04",
				"path": "M732,-677,716,-667L711,-667L710,-671,713,-680,702,-696,688,-707,682,-720,675,-724,671,-723,672,-715,665,-718,661,-715,658,-711,655,-712,658,-716,653,-731,646,-732,642,-712,637,-711,634,-708,639,-703,633,-700,623,-703,628,-696,622,-688,617,-698,613,-698,615,-690,605,-687,606,-683L615,-683L618,-677,610,-678,605,-674,604,-665,601,-665,594,-672,586,-662,587,-657,565,-672,548,-664,559,-659,562,-653,593,-631,592,-624,605,-628,606,-624,597,-612,600,-606,613,-612,616,-610,618,-603,622,-604,632,-612,683,-600,691,-619,682,-623,677,-632,686,-637,703,-627,714,-632,726,-649,739,-660L751,-660L751,-664z"
			}

			],
			data: [
			['15.07.02', 1],
			['15.07.09', 1],
			['15.07.03', 1],
			['15.07.07', 1],
			['15.07.04', 1],
			['15.07.01', 1],
			['15.07.06', 1],
			['15.07.11', 1],
			['15.07.05', 1],
			['15.07.08', 1],
			['15.07.10', 1]
			],
		/*
		point: {
                                events: {
                                    click: function() {
                                        var someURL = this.series.userOptions.URLs[this.x]; // onclick get the x index and use it to find the URL
                                        if (someURL)
                                            window.open('http://'+someURL);
                                    }
                                }
                            },
                            */
                            dataLabels: {
                            	enabled: true,
                            	color: '#FFFFFF',
                            	allowOverlap: true,
			//borderRadius: 5,
                //backgroundColor: 'rgba(252, 255, 197, 0.7)',
                //borderWidth: 1,
                //borderColor: '#AAA',
                //y: +16,
                y: -5,
                shape: "square",
                format: '{point.name}'
			/*
			formatter: function () {
                if (this.point.value) {
                    return this.point.name;
                }
            }
            */
        },
           // animation: false
		/*
        tooltip: {
            headerFormat: '',
            pointFormat: '{point.value}'
        }
        */
    }]
});
});
});
</script>

<div id="container"></div>

</div>
<div class="col-md-4">
	<div class="module" id="get-connected">
		<h2>Get Connected</h2>
		<ul class="tab-list clearfix">
			<li class="twitter">
				<a href="#gc-twitter"><span class="centerer"><span class="centerer-inner"><span class="inner">Twitter</span></span></span></a>
			</li>
			<li class="facebook">
				<a href="#gc-facebook"><span class="centerer"><span class="centerer-inner"><span class="inner">Facebook</span></span></span></a>
			</li>
			<li class="youtube">
				<a href="#gc-youtube"><span class="centerer"><span class="centerer-inner"><span class="inner">YouTube</span></span></span></a>
			</li>
		</ul>
		<div class="tabs">
			<div class="tab" id="gc-twitter">
	<!--
		<a href="http://twitter.com/GrahamBlog" class="username">@GrahamBlog</a>
		<ul>
					<li><a href="https://twitter.com/GrahamBlog/status/700348813807063040">Feb 18</a>: .<a href="https://twitter.com/tim_cook" target="_blank">@tim_cook</a> Our nation is at war & this Iphone was used to kill Americans. Protect our homeland, not terrorists. Please cooperate with <a href="https://twitter.com/FBI" target="_blank">@FBI</a>.</li>

					<li><a href="https://twitter.com/GrahamBlog/status/699201398290907136">Feb 15</a>: Will be speaking with ABC <a href="https://twitter.com/GMA" target="_blank">@GMA</a> in just a few minutes about the Supreme Court.</li>

					<li><a href="https://twitter.com/GrahamBlog/status/698659891649626116">Feb 13</a>: On the passing of Justice Scalia. <a href="http://pbs.twimg.com/media/CbIjeCQW4AQNYUz.jpg" target="_blank">https://t.co/i0f7CVFGvw</a></li>
		</ul>
	-->
</div>
<div class="tab" id="gc-facebook">

	<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FUSSenatorLindseyGraham&amp;width=200&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;height=300" scrolling="auto" frameborder="0" style="overflow:hidden; height:300px; width: 100%;" allowTransparency="true"></iframe>

</div>
<div class="tab" id="gc-youtube">
	<div class="youtube-link">
		<script src="https://apis.google.com/js/platform.js"></script>
		<div class="g-ytsubscribe" data-channel="USSenLindseyGraham"></div>
		<div class="subscribe-label">Subscribe</div>
	</div>
	<ul>
		<?php
		$video = $this->M_data->video(0,1);
		foreach($video->result_array() as $row) {
			$link=str_replace('watch?v=','embed/', $row['link']);
			?>
			<iframe width="100%" height="200" style="border:0;margin-top:-6px;" src="<?php echo $link; ?>" allowfullscreen></iframe>
			<li class="clearfix">
				<a href=""> <span class="info">
					<span class="title">Graham Talks Russia Hack and Tillerson Nomination on Fox News</span>
				</span>
			</a>
		</li>
		<?php
	}
	?>
</ul>
<a class="view" href="https://www.youtube.com/channel/UClLGZMA5Ei2Z8fR1PLEx6yQ">View Channel</a>
</div>
</div>

</div>
</div>
</div>
</div>
</div>





</div>
<?php $this->load->view($vfooter); ?>

</body>

</html>

