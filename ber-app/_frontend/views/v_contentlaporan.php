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
	foreach($katlaporan->result() as $row){
	//$judul=seo_link($row->nama_katlaporan); 
?>
<a href="<?php echo base_url(); ?>laporan/kategori/<?php echo $row->id_katlaporan;?>" class="btn btn-green" style="margin-bottom:15px;margin-right:7px;">Kategori: <?php echo $row->nama_katlaporan; ?></a> 
<?php  
}
?>
<a href="<?php echo base_url(); ?>profil/detail/2/laporan-kinerja" class="btn btn-green" style="margin-bottom:15px;margin-right:7px;">Kategori: Laporan Kinerja</a>
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
 elseif ($this->uri->segment(2,0)=='detail') {
?>
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
padding: 5px;
border: 1px solid #ddd;
line-height: 160%;
color: #161313;
}
</style>
<?php
if (count($detail_berita)) { 
 foreach($detail_berita as $row){
 $judul=seo_link($row->nama_katlaporan);
?>
<div class="content grid_9 allberita marked-category">
	<div class="single-page">
		<div class="box-single-content"> 
<div class="breadcrumb"> 

<a href="<?php echo base_url(); ?>">Beranda </a>/ <a href="<?php echo base_url(); ?>dok">Dokumen Laporan </a> / <a href="<?php echo base_url(); ?>laporan/kategori/<?php echo $row->id_katlaporan; ?>">Kategori: <?php echo $row->nama_katlaporan;?> </a>

</div>

<br>
<h3 class="rs single-title"><?php echo $row->nama_katlaporan;?>: <?php echo $judulan;?></h3>
<p class="rs post-by"><?php echo $postingby; ?></p> 
<center> 

</center>
<table class="ver-zebra2">    <colgroup><col class="oce-first"></colgroup>

  <tbody><tr><td width="200">Nama</td>  <td width="500">: <strong> <?php echo $row->nama; ?> </strong></td>  </tr><tr>
  </tr><tr><td>Alamat</td>  <td> : <?php echo $row->alamat; ?></td></tr>
  <tr><td>LP</td>  <td> : <?php echo $row->lp; ?></td></tr>
  <tr><td><?php if ($row->id_katlaporan==1) { ?>
Lokasi TKP
<?php } else { ?>
Lokasi Laka
<?php } ?></td>  <td> :  <?php echo $row->lokasi; ?></td></tr>
  <tr>  <td>Kerugian</td>     <td>:   <?php echo $row->kerugian; ?></td></tr>
  <tr><td>Tahap Penyelesaian Perkara</td>  <td> : <b><?php echo $row->tahap; ?></b></td></tr>
  <tr><td>Keterangan</td>  <td><?php echo $row->keterangan; ?> </td></tr>
</tbody>
</table>

<?php if ($row->id_katlaporan==1) { ?>
Lokasi TKP
<?php } else { ?>
Lokasi Laka
<?php } ?>
	
<?php 
}
?>  
<div class="clearfix"></div>
	 
  <?php  

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
	<a href="<?php echo base_url(); ?>">Beranda </a>/ <a href="<?php echo base_url(); ?>laporan"> Data Laporan Publik </a>  <!-- / <a href="<?php echo base_url(); ?>laporan/kategori/<?php echo $this->uri->segment(3); ?>"> <?php echo $judulan; ?> </a> -->   
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
		<th width="25% !important">Nama	</th> 
		<th width="8% !important">Alamat</th>
		<th width="13% !important">LP</th>
		<th width="13% !important"><?php if ($this->uri->segment(3)==1) { ?>
Lokasi TKP
<?php } else { ?>
Lokasi Laka
<?php } ?></th>
		<th width="13% !important">Tahap Penyelesaian Perkara</th>
		<th width="8% !important"><center>Detail</center></th>
</tr>
        		</thead>
        		<tbody>	
	<?php
	if ($this->uri->segment(4)!=null) {
		$no=15*($this->uri->segment(4)-1)+1;
	}
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
	$judul=seo_link($row['nama']);	
	 //$row->id_katlaporan
	?>
<tr class="ok" bgcolor="<?php echo $background; ?>">
<td data-title="No"><?php echo $no; ?></td>
<td  data-title="Nama"><b><?php echo $row['nama'];?></b>   </td> 
<td align="center" data-title="Alamat"> <?php echo $row['alamat']; ?> </td>
<td align="center"  data-title="LP"> <?php echo $row['lp']; ?> </td> 
<td align="center" data-title="Lokasi"> <?php echo $row['lokasi']; ?> </td>
<td align="center" data-title="Tahap Penyelesaian Perkara"> <?php echo $row['tahap']; ?> </td>
<td align="center"  data-title="Detail">
<a href="<?php echo base_url(); ?>laporan/detail/<?php echo $row['id_laporan']."/".$judul."/";?>"><img src="<?php echo base_url(); ?>style/images/detail1.png" /></a>
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