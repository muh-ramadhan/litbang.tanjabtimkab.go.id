<div class="breadcrumb">
	<a href="<?php echo base_url(); ?>">Beranda </a>/   <a href="<?php echo base_url()."kegiatan"; ?>">Semua Kegiatan </a>
</div>
<div id="frames">
  <div class="titlealbum"><?php echo $judulan;?></div>
  <div class="datehour">Diposting oleh: <strong>Staff Biro Kesramas Prov. Jambi</strong></div>
  <br>
  <?php
  foreach($detail_kegiatan as $row){
	//$judul=seo_link($row->nama_kategori);
   ?>
   <table id="ver-zebra2">    <colgroup><col class="oce-first"></colgroup>
    <tbody>
      <tr>
        <td width="200">Nama Kegiatan</td>
        <td width="500">: <strong> <?php echo $row->namakegiatan;?> </strong></td>
      </tr>
      <tr></tr>
      <tr>
        <td>Tanggal Kegiatan</td>
        <td> : <?php $tanggal=$row->tgl_kegiatan; echo nama_hari($tanggal).', '; echo tgl_indo($tanggal); ?></td>
      </tr>
      <tr>
        <td>Waktu Kegiatan</td>
        <td> : <?php echo $row->waktu;?></td>
      </tr>
      <tr>
        <td>Tempat</td>
        <td> : <?php echo $row->tempat; ?></td>
      </tr>
      <tr>
        <td>Perihal</td>
        <td>:   <?php echo $row->perihal;?> </td>
      </tr>
      <tr>
        <td>Tamu Undangan</td>
        <td> :  <?php echo $row->pengisi;?></td>
      </tr>
      <tr>
        <td>Jadwal Kegiatan</td>
        <td> :  <?php echo $row->jadwalkegiatan;?></td>
      </tr>
    </tbody>
  </table>
<?php } ?>
<br>
<span class="informasilainnya">
  <h3>BERITA TERBARU</h3>
  <span class="artikelcontent">
    <ul>
      <?php
      foreach($beritarandom->result() as $row){
        $judul=seo_link($row->judul); ?>
        <li>
          <a href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>"> <?php echo $row->judul; ?></a>
        </li>
      <?php } ?>
    </ul>
  </span>
</span>
</div>