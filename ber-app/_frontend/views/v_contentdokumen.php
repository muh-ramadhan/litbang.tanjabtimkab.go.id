
<?php
//-- JIKA KONDISINYA INDEX --//
if ($this->uri->segment(2,0)=='index') { ?>

    <!-- MULAI BREAD CRUMB -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Semua Dokumen</h2>
                            <p><a href="<?php echo base_url(); ?>">Home</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SELESAI BREAD CRUMB -->

    <!-- MULAI BERITA -->
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <?php
                            $no=1;
                            $katdokumen=$this->M_data->katdokumen();
                            foreach($katdokumen->result() as $row){
                                ?>
                            <div class="blog_details">
                                <a class="d-inline-block" href="<?php echo base_url()."dokumen/kategori/".$row->id_katdokumen."/".seo_link($row->nama_katdokumen);?>">
                                    <h2><?php echo $row->nama_katdokumen; ?></h2>
                                </a>
                                <p><?php echo $postingby; ?></p>
                            </div>
                            <?php $no=$no+1; } ?>
                        </article>
                    </div>
                </div>

<?php }
//-- JIKA KONDISINYA DETAIL --//
elseif ($this->uri->segment(2,0)=='detail') {
	if (count($detail_berita)) {
		foreach($detail_berita as $row){
			$judul=seo_link($row->nama_katdokumen);
			?>
<div class="content grid_9 allberita marked-category">
	<div class="single-page">
<div class="box-single-content clearfix"  id="pagehead" >
<div class="pagehead-action-bar clearfix">
	<ul class="action-buttons clearfix">
		<li><a href="#" class="share">Share</a></li>
		<li><a href="#" class="print">Print</a></li>
	</ul>
	<ul class="cookie-crumbs">
		<li><a href="<?php echo base_url(); ?>">Home</a> </li>
		<li><a href="<?php echo base_url(); ?>dokumen"> Dokumen </a> </li>
		<li><a href="<?php echo base_url(); ?>dokumen/kategori/<?php echo $row->id_katdokumen; ?>"> Kategori: <?php echo $row->nama_katdokumen;?></a> </li>
	</ul>
</div>
<br>

<h1><?php echo $judulan;?></h1>
<p class="rs post-by"><?php echo $postingby; ?></p>
<center>
</center>
<table class="ver-zebra2">    <colgroup><col class="oce-first"></colgroup>
  <tbody>
    <tr>
      <td width="200">Tahun Dokumen</td>
      <td width="500">: <strong> <?php echo $row->tahun; ?> </strong></td>
    </tr>
    <tr>
  </tr><tr><td>Keterangan</td>  <td> : <?php echo $row->jangkrik; ?></td></tr>
  <tr><td>Tanggal Upload</td>  <td> : <?php
 $tanggal=$row->tgl_upload;
  echo nama_hari($tanggal).', ';
echo tgl_indo($tanggal);

?></td></tr>
  <tr><td>Didownload</td>  <td> :  <?php echo $row->dibaca; ?> Kali</td></tr>
  <tr>  <td>Link File</td>     <td>:   <?php if ($row->metode_link==1) { ?>
<a href="<?php echo base_url(); ?>dokumenumen/<?php echo $row->nama_file;?>" target="_blank"><b>Download</b></a>
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


</div>
</div>

<?php }
//-- JIKA KONDISINYA KATEGORI --//
 else if ($this->uri->segment(2,0)=='kategori') {
?>

<div class="content grid_9 allberita marked-category">
	<div class="single-page">
<div class="box-single-content clearfix"  id="pagehead" >
<div class="pagehead-action-bar clearfix">
	<ul class="action-buttons clearfix">
		<li><a href="#" class="share">Share</a></li>
		<li><a href="#" class="print">Print</a></li>
	</ul>
	<ul class="cookie-crumbs">
		<li> <a href="<?php echo base_url(); ?>">Home</a> </li>
		<li><a href="<?php echo base_url(); ?>dokumen"> Dokumen </a> </li>
	</ul>
</div>
<br>
<h1>Kategori: <?php echo $judulan; ?></h1>
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
if (!is_numeric($this->uri->segment(4))){ $no=1;	}
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
<a href="<?php echo base_url(); ?>dokumen/detail/<?php  echo $row['id_dokumen']."/".$judul."/";?>"><b>Detail</b></a>
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
</div>
</div>


 <?php } ?>