<div class="percategory">
   <h3 class="rs"><span>KATA </span> <span style="background:#F8C300;color: #000; text-shadow: 0px 1px 1px #fff;">SAMBUTAN</span></h3>
   <div class="blokblue sambutanka">
     <center>
        <?php
/*
$r = $this->M_data->sambutan();
foreach($r->result() as $row){
?>
<img src="<?php echo base_url(); ?>images/profile.jpg" width="180" height="180"/>
<?php
}
*/
?>
<p  style="padding:0 15px 0 15px;">

 Selamat Datang, Salam Sejahtera, Kita harapkan dengan adanya Website ini dapat menjadi media informasi bagi internal polri maupun bagi masyarakat
</p>
</center>

<p class="rs view-all-category" style="padding:0 15px 15px 15px;">
    <a href="<?php echo base_url(); ?>" class="be-fc-orange">+ Selengkapnya</a>
</p>

</div>
</div>
<div class="percategory">
    <div class="list-group">
        <a href="<?php echo base_url();?>telpon" class="list-group-item active" style="font-size: 16px;font-family: 'Open Sans', sans-serif;font-weight: 700;"> Berita Terbaru
        </a>
        <?php
        $berita1 = $this->M_data->beritaterbaru2(0,5);
        foreach($berita1->result() as $row){
         $judul=seo_link($row->judul);
         $tanggal=$row->tanggal;
         $photopath = str_replace('-', '/', $row->tanggal_modif);
         ?>
         <a href="<?php echo base_url(); ?>berita/detail/<?php echo $row->id_berita."/".$judul."/";?>" class="list-group-item"><?php   echo tgl_indo($tanggal).' | '; echo $row->jam.' WIB '; ?><br>
            <span style="font-weight:700;"><?php echo $row->judul; ?></span>
        </a>
        <?php
    }
    ?>

</div>
</div>

<div class="percategory">
 <h3 class="rs"><span>POLLING</span> <span style="background:#F8C300;color: #000; text-shadow: 0px 1px 1px #fff;">ONLINE</span></h3>
 <div class="blokblue">
     <script type='text/javascript'>
      $(document).ready(function () {
         $('#chartdivpolling').highcharts({
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Hasil e-Polling Diskominfo Kab. Tanjung Jabung Timur'
        },
        <?php

        ?>
        subtitle: {
            text: '<?php echo $pertanyaan; ?>',
            x: -20
        },
        tooltip: {
            pointFormat: '{series.name} : <b>{point.y}</b> Presentase <b>{point.percentage:.1f}%</b>'
        },

        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        credits: {
            enabled: false
        },
        <?php

        ?>
        series: [{
            type: 'pie',
            name: 'Total',
            data: [
            <?php
//$ook = mysql_query("SELECT * from pollingpilihan where id_polling='$rss[id_polling]' order by rating");
            $jumlah=count($pollingpilihan->result());
            $no=1;
            foreach($pollingpilihan->result() as $row){
//while ($rs=mysql_fetch_array($ook)){
                if ($no==1) {
                    $warna="#00FF00";
                }
                elseif ($no==2) {
                    $warna="#ff0000";
                }
                elseif ($no==3) {
                    $warna="#7463b9";
                }
                elseif ($no==4) {
                    $warna="#000";
                }
                elseif ($no==5) {
                    $warna="#e9ae0f";
                }
                elseif ($no==6) {
                    $warna="#6c6758";
                }
                elseif ($no==7) {
                    $warna="#5b4246";
                }
                ?>
                {name: '<?php echo $row->pilihan; ?>',
                y: <?php echo $row->rating; ?>,
                sliced: true,
                selected: true,
                color:'<?php echo $warna;?>'}<?php if ($no<$jumlah) { ?> ,
                    <?php
                }
                $no++;
            }
            ?>
            ]
        }]
    });
     });
 </script>
 <div id="chartdivpolling" style="height:400px"></div>
 <?php
 $pollingan=$this->M_data->pollingan("");
 echo $pollingan; ?>
</div>
</div>

<div class="percategory">
    <div style="background:#fff;">
     <center>
        <?php
        $iklan1 = $this->M_data->ambiliklan(1,1);
        if(count($iklan1->result_array())>0){
            foreach($iklan1->result_array() as $raw)
            {
                $photopath = str_replace('-', '/', $raw['tanggal_modif']);


                if ($raw['link']!=null) {
                    $contiklan="<a href='".$raw['link']."'> <img src='".base_url()."materi_iklan/".$photopath."/".$raw['gambar']."'  class='banner'> </a>";
                } else {
                    $contiklan="<img src='".base_url()."materi_iklan/".$photopath."/".$raw['gambar']."'  class='banner'>";
                }
                echo $contiklan;
                ?>

            <?php }
        } else { ?>

        <?php } ?>
    </center>
</div>
</div>
	<!--
<div class="percategory">
 <h3 class="rs"><span>Berita</span> <span style="background:#F8C300;color: #000; text-shadow: 0px 1px 1px #fff;">Terkini</span></h3>
<div class="blokblue">
                            <a href="<?php echo base_url(); ?>dpo" class="be-fc-orange">+ Lihat Data DPO</a>
                        </div>
	<div id="banner-fade">
        <ul class="bjqs">
<?php
/*
//$r = $this->M_data->fotokapolda();
foreach($dpo->result() as $row){
$judul=seo_link($row->nama);
?>
<li>
<a href="<?php echo base_url(); ?>dpo/detail/<?php echo $row->id_dpo;?>/<?php echo $judul;?>">
	<img src="<?php echo base_url(); ?>f_dpo/<?php echo $row->gambar;?>" title="<?php echo $row->nama.' '.$row->nama_keluarga;?>">
</a>
</li>
<?php
}
*/
?>
	</ul>
</div>

      <script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            width       : 300,
			height      : 300,
            responsive  : true
          });

        });
      </script>
	  <div class="clear"></div>

</div>
-->