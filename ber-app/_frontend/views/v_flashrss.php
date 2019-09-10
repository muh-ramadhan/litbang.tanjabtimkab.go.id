


&lt;?xml version="1.0" encoding="utf-8" standalone="yes"?&gt;<br>
&lt;images&gt;<br>
<?php
//include "../configue/koneksi.php";
?>
<images>
	<?php
	$tampil = mysql_query("SELECT *,gallery.keterangan as jangkrik FROM gallery,album WHERE gallery.id_album=album.id_album ORDER BY id_gallery DESC");
	while($r=mysql_fetch_array($tampil)){
		$pathi=$r['tanggal_modif'];
		$pathi=str_replace("-","/",$pathi);
		?>
		<?php echo"&lt;pic&gt;"; ?><br>
		&lt;image&gt;http://keckotabaru.jambikota.go.id/foto_galeri/<?php echo"$pathi";?>/<?php echo"$r[gbr_gallery]";?>&lt;/image&gt;<br>
		&lt;caption&gt; <?php echo"$r[keterangan]";?> &lt;/caption&gt;<br>
		<?php echo"&lt;/pic&gt;"; ?><br>
		<?php
	}
	?>
	&lt;/images&gt; <br>
	&lt;?xml version="1.0" encoding="utf-8" standalone="yes"?&gt;

