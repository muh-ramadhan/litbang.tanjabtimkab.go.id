<style>
hr {
	margin-top: 8px;
    margin-bottom: 8px;
    border: 0;
    border-top: 1px solid #ccc
}
</style>
<script language="javascript"> 
$(document).ready(function(){ 
 
$("#tgl_lahir").change(function() { 
  $("#lahir_none").removeAttr("checked");
}); 
$("#bln_lahir").change(function() { 
  $("#lahir_none").removeAttr("checked");
}); 
$("#thn_lahir").change(function() { 
  $("#lahir_none").removeAttr("checked");
});  

$("#tmttanggalpangkat").change(function() { 
  $("#pangkat_none").removeAttr("checked");
}); 
$("#tmtbulanpangkat").change(function() { 
  $("#pangkat_none").removeAttr("checked");
}); 
$("#tmttahunpangkat").change(function() { 
  $("#pangkat_none").removeAttr("checked");
}); 

$("#tmttanggaljabatan").change(function() { 
  $("#jabatan_none").removeAttr("checked");
}); 
$("#tmtbulanjabatan").change(function() { 
  $("#jabatan_none").removeAttr("checked");
}); 
$("#tmttahunjabatan").change(function() { 
  $("#jabatan_none").removeAttr("checked");
}); 

$("#bulanlatihan").change(function() { 
  $("#latihan_none").removeAttr("checked");
}); 
$("#tahunlatihan").change(function() { 
  $("#latihan_none").removeAttr("checked");
}); 

});
</script> 

<?php 
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?> 
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet"> 
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Pegawai</h1>
                </div> 
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Data Semua Pegawai 
                        </div> 
                        <div class="panel-body">
<!--		 <form action="<?php echo base_url(); ?>pegawai/a_deleteall" method="POST">	-->	
	<?php echo form_open_multipart('pegawai/deleteall'); ?> 		 
						<br> 
					 <center> 
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>
						
						<a href="<?php echo base_url(); ?>pegawai/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
						</a>
						
						<a href="<?php echo base_url(); ?>pegawai" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-refresh bigger-160"></i> Refresh
						</a>
						
						<button type="submit" class="btn btn-app btn-inverse btn-xs radius-4" style="width:140px;">
							<i class="ace-icon fa  fa-trash-o bigger-160"></i> Remove Selected
						</button>
						
						
						</center>
						<div class="clearfix"></div> 
						<br>
						
	<?php
    if (count($artikel)) { 
	?> 
	 <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="no" colspan="0" id="ck" title="Pilih Semua">  
									<input type="checkbox" id="selectall"></th>	
                                            <th>Nama Pegawai</th> 
											<th>TTL</th>
                                            <th>Jabatan/Bidang</th>
                                            <th>Aktif</th>
											<th>Pend. Terakhir</th> 
											<th>Operator</th>
											<th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	
	<?php
	$no=1; 
	foreach($artikel as $key => $row){ 
		$judul=seo_link($row['nama_pegawai']); 	
		$a=substr($row['tgl_upload'], 0,4);
		$b=substr($row['tgl_upload'], 5,2);
		$c=substr($row['tgl_upload'], 8,9);
		$tanggal=$c.'/'.$b.'/'.$a; 
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_pegawai']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
            <td><a class="bold" href="<?php echo base_url(); ?>pegawai/edit/<?php echo $row['id_pegawai']."/".$judul."/";?>"> <?php echo $row['nama_pegawai']; ?> </a></td>
			<td><?php echo $row['tempat']; ?>, <?php if ($row['no_tgl_lahir']!='N') { echo tgl_indo($row['tgl_lahir']); }?></td>
			<td class="center"><center><?php  echo $row['nama_jabatanpegawai']; ?></center></td>
			<td>
			<?php if ($row['jangkrik']=='Y') {?>
				<a href="<?php echo base_url(); ?>pegawai/nonaktif/<?php echo $row['id_pegawai']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>pegawai/aktif/<?php echo $row['id_pegawai']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?> 
			</td>
			<!--<td></td>-->
			<td><?php echo $row['pendidikan']; ?> </td>
            <td class="center"><?php echo $row['nama_lengkap']; ?> </td>
            <td class="center">
				<a href="<?php echo base_url(); ?>pegawai/edit/<?php echo $row['id_pegawai']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
                </a> 
				
				<a href="<?php echo base_url(); ?>pegawai/delete/<?php echo $row['id_pegawai']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
					<i class="fa fa-times"></i> Delete
				</a>
			</td>
		</tr>  
	  
  <?php
    $no=$no+1;
	}
	?>
									</tbody>
                                </table>
                            </div>
							
							<div class="clear"></div>
 
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
	
	Maaf, Data Belum Tersedia
	
	<?php } ?>	 
	<?php echo form_close(); ?> 	
                        </div>
                        <!-- /.panel-body -->
                    </div> 
                </div> 
            </div> 
			 
		<?php
}
else if ($this->uri->segment(2,0)=='add') { 
        ?>
<?php 
	$tanggal=date('d-m-Y'); 
?>
<link rel="stylesheet" href="<?php echo base_url()?>style/css/tag.css">	
 <script type="text/javascript" src="<?php echo base_url()?>../tinymce/tinymce.min.js"></script>
            <script>
            tinymce.init({
				mode : "exact",
				elements : "loko",
                theme: "modern",
                //width: 850,
               // height: 300,
                relative_urls : false,
                remove_script_host: false,
                plugins: [
                     "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                     "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                     "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
               ],
               content_css: "css/content.css",
               toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons", 
               style_formats: [
                    {title: "Bold text", inline: "b"},
                    {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
                    {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
                    {title: "Example 1", inline: "span", classes: "example1"},
                    {title: "Example 2", inline: "span", classes: "example2"},
                    {title: "Table styles"},
                    {title: "Table row 1", selector: "tr", classes: "tablerow1"}
                ],
				external_filemanager_path:"<?php echo base_url()?>../filemanager/",
				filemanager_title:"Responsive Filemanager" ,
				external_plugins: { "filemanager" : "<?php echo base_url()?>../filemanager/plugin.min.js"}
             }); 
            </script>



<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>
	
 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Pegawai</h1>
                </div> 
            </div>
<?php // echo form_open_multipart('pegawai/a_simpan'); ?> 			
<form action="<?php echo base_url()?>pegawai/a_simpan" enctype="multipart/form-data" method="post" accept-charset="utf-8"  onSubmit="return validasi(this)">

            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Pegawai 
                        </div> 
                        <div class="panel-body"> 
							
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>pegawai" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>  
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">	 
						<div class="form-group">
						<label>Tanggal Data</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
                                            <label>Pegawai Aktif</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" id="optionsRadios1" value="Y" checked>Ya
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" id="optionsRadios2" value="N">Tidak
                                                </label>
                                            </div> 
                                        </div>
			</div>
							<div class="form-group">
								<label>Nama Pegawai</label> 
								<input  class="form-control" type="text" name="namapegawai" value=""> 
							</div>
							
							<div class="form-group">
								<label>NIP</label> 
								<input  class="form-control" type="text" name="nip" value=""> 
							</div>
							<div class="dwarn">	
							<center><label>Tempat Tanggal Lahir</label></center>
<hr> 
							<div class="form-group">
								<label>Tempat Lahir</label> <br>
								<input  class="form-control" type="text" name="tempatlahir" value="" > 
							</div>
							
							<div class="form-group">
								<label>Tanggal Lahir</label> <br>
								 <?php 
								$tgl_sekarang = date("Ymd");
								$tgl_skrg     = date("d");
								$bln_sekarang = date("m");
								$thn_sekarang = date("Y");
								$jam_sekarang = date("H:i:s");

								$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
													"Juni", "Juli", "Agustus", "September", 
													"Oktober", "November", "Desember");
													
								combotgl(1,31,'tgl_lahir',$tgl_skrg);
				combonamabln(1,12,'bln_lahir',$bln_sekarang);
				combothn2(1950,$thn_sekarang,'thn_lahir',$thn_sekarang);
								?> 
&ensp;&ensp;&ensp;&ensp;<input type="radio" name="lahir_none" id="lahir_none" value="Y" class="cekbox" checked> Tidak Tahu&ensp;&ensp;&ensp;&ensp; 
							</div>
							</div>
							<div class="form-group">
								<label>Jenis Kelamin</label> 
								<div class="radio">
                                    <label>
										<input type="radio" name="kelamin" id="optionsRadios1" value="L" checked>Laki-laki
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
										<input type="radio" name="kelamin" id="optionsRadios2" value="P">Perempuan
                                    </label>
                                </div> 
							</div> 
				<div class="dwarn">	
<center><label>Jabatan</label></center>
<hr> 					
							<div class="form-group">
								<label>Jabatan</label> 
								<select class="form-control"  name="jabatan" id="jabatan">
								<option value="0" selected>- Pilih -</option>
						<?php
						$dataa = $this->M_dataadmin->pilihjabatanpegawai(); 
						foreach($dataa->result_array() as $raw) {
						?> 
							<option  value="<?php echo $raw['id_jabatan'];?>"><?php echo $raw['nama_jabatanpegawai'];?></option>
						<?php } ?>			
                                </select>
							</div>
							<div class="form-group">
								<label>TMT</label> <br>
								 <?php  			
									 combotgl(1,31,'tmttanggaljabatan',$tgl_skrg);
				combonamabln(1,12,'tmtbulanjabatan',$bln_sekarang);
				combothn2($thn_sekarang-25,$thn_sekarang+2,'tmttahunjabatan',$thn_sekarang);	
				?> &ensp;&ensp;&ensp;&ensp;<input type="radio" name="jabatan_none" id="jabatan_none" value="Y" class="cekbox" checked> Tidak Tahu&ensp;&ensp;&ensp;&ensp; 
							</div>
					</div>	
<div class="dwarn">	
<center><label>Pangkat/Golongan</label></center>
<hr> 						
							<div class="form-group">
								<label>Pangkat/Golongan</label> 
								<select class="form-control"  name="pangkat" id="pangkat">
								<option value="0" selected>- Pilih -</option>
						<?php
						$dataa = $this->M_dataadmin->pilihgolongan(); 
						foreach($dataa->result_array() as $raw) {
						?> 
							<option  value="<?php echo $raw['id_pangkat'];?>"><?php echo $raw['pangkat'];?> - <?php echo $raw['gol_ruang'];?></option>
						<?php } ?>			
                                </select>
							</div>
						<div class="form-group">
								<label>TMT</label> <br>
								 <?php  
								combotgl(1,31,'tmttanggalpangkat',$tgl_skrg);
					combonamabln(1,12,'tmtbulanpangkat',$bln_sekarang);
					combothn2($thn_sekarang-25,$thn_sekarang+2,'tmttahunpangkat',$thn_sekarang);	
								?> &ensp;&ensp;&ensp;&ensp;<input type="radio" name="pangkat_none" id="pangkat_none" value="Y" class="cekbox" checked> Tidak Tahu&ensp;&ensp;&ensp;&ensp; 
							</div>	
					</div>
<div class="dwarn">	
	<div class="form-group">
<center><label>Masa Kerja</label></center>
<hr> 	
		<table>
		<tr><td><label>Bulan</label> <input  class="form-control" type="text" name="masakerjatahun" value="" style="width:150px;margin-right:15px;"></td><td><label>Tahun</label> <input  class="form-control" type="text" name="masakerjabulan" value="" style="width:150px;"></td></tr>
		</table> 
	</div>
</div>

<div class="dwarn">			
<center><label>Latihan Jabatan</label></center>
<hr> 			
<div class="form-group">
		<label>Nama</label> 
		<input  class="form-control" type="text" name="namalatihan" value=""> 
		</div>
		<div class="form-group">
		<label>TMT</label> <br>
		<?php
		combonamabln(1,12,'bulanlatihan',$bln_sekarang);
		combothn2($thn_sekarang-20,$thn_sekarang+2,'tahunlatihan',$thn_sekarang);	
		?> &ensp;&ensp;&ensp;&ensp;<input type="radio" name="latihan_none" id="latihan_none" value="Y" class="cekbox" checked> Tidak Tahu&ensp;&ensp;&ensp;&ensp; 
	</div>	
</div>

<div class="dwarn">			
<center><label>Pendidikan</label></center>
<hr> 			
<div class="form-group">
	<label>Nama Lembaga</label> 
	<input  class="form-control" type="text" name="pend" value=""> 
</div>
<div class="form-group">
	<label>Tahun Lulus</label> 
	<input  class="form-control" type="text" name="tahunlulus" value=""> 
</div>
<div class="form-group">
	<label>Tingkat Ijazah</label> 
	<select class="form-control"  name="tingkat" id="tingkat">
	<option value="0" selected>- Pilih -</option>
	<?php
		$dataa = $this->M_dataadmin->pilihijazah(); 
		foreach($dataa->result_array() as $raw) {
	?> 
		<option  value="<?php echo $raw['id_ijazah'];?>"><?php echo $raw['nama_ijazah'];?></option>
	<?php } ?>			
	</select>
</div>
</div>

							
 
						</div>
                        <!-- /.panel-body -->
                    </div> 
                </div> 
				<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Foto & Keterangan
                        </div> 
                        <div class="panel-body">
                            <div class="form-group">
								<label>Foto Pegawai</label> 
								<input type="file" name="imagefile"> 
							</div>
							<div class="form-group">
								<label>Alamat</label> 
								<textarea class="form-control" rows="6"  name="alamat" ></textarea>
							</div>
							<div class="form-group">
								<label>Keterangan</label> 
								<textarea class="form-control" rows="6"  name="keterangan" ></textarea>
							</div>
							<div class="form-group">
								<label>Catatan Mutasi Pegawai</label> 
								<textarea class="form-control" rows="3"  name="mutasi" ></textarea>
							</div>
							 
							
							<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>pegawai" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						</div>  
						
                        </div> 
                    </div> 
                </div>  
            </div> 
			<?php echo form_close(); ?> 
		<?
		}
else if ($this->uri->segment(2,0)=='edit') { 
        ?>
 
 <script type="text/javascript" src="<?php echo base_url()?>../tinymce/tinymce.min.js"></script>
     <script>
            tinymce.init({
				mode : "exact",
				elements : "loko",
                theme: "modern",
                //width: 850,
               // height: 300,
                relative_urls : false,
                remove_script_host: false,
                plugins: [
                     "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                     "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                     "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
               ],
               content_css: "css/content.css",
               toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons", 
               style_formats: [
                    {title: "Bold text", inline: "b"},
                    {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
                    {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
                    {title: "Example 1", inline: "span", classes: "example1"},
                    {title: "Example 2", inline: "span", classes: "example2"},
                    {title: "Table styles"},
                    {title: "Table row 1", selector: "tr", classes: "tablerow1"}
                ],
				external_filemanager_path:"<?php echo base_url()?>../filemanager/",
				filemanager_title:"Responsive Filemanager" ,
				external_plugins: { "filemanager" : "<?php echo base_url()?>../filemanager/plugin.min.js"}
             }); 
            </script>
<link rel="stylesheet" href="<?php echo base_url()?>style/css/tag.css">			

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>
	
 <div class="row">
 <?php echo form_open_multipart('pegawai/a_edit'); ?> 
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Pegawai</h1>
                </div> 
            </div>
	<?php
		$edit = $this->M_dataadmin->editpegawai($this->uri->segment(3,0)); 
		foreach($edit->result_array() as $raw)
		{
		$photopath = str_replace('-', '/', $raw['tgl_modif']);   
		$a=substr($raw['tgl_upload'], 0,4);
		$b=substr($raw['tgl_upload'], 5,2);
		$c=substr($raw['tgl_upload'], 8,9);
		$tanggal=$c.'-'.$b.'-'.$a;
		?>
						<input type="hidden" name="id" value="<?php echo $raw['id_pegawai']; ?>"> 		
 <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Pegawai 
                        </div> 
                        <div class="panel-body"> 
							
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>pegawai" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>  
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">	 
						<div class="form-group">
						<label>Tanggal Data</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
                                            <label>Pegawai Aktif</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" id="optionsRadios1" value="Y" checked>Ya
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="aktif" id="optionsRadios2" value="N">Tidak
                                                </label>
                                            </div> 
                                        </div>
			</div>
							<div class="form-group">
								<label>Nama Pegawai</label> 
								<input  class="form-control" type="text" name="namapegawai" value="<?php echo $raw['nama_pegawai']; ?>"> 
							</div>
							
							<div class="form-group">
								<label>NIP</label> 
								<input  class="form-control" type="text" name="nip" value="<?php echo $raw['nip']; ?>"> 
							</div>
							<div class="dwarn">	
							<center><label>Tempat Tanggal Lahir</label></center>
<hr> 
							<div class="form-group">
								<label>Tempat Lahir</label> <br>
								<input  class="form-control" type="text" name="tempatlahir" value="<?php echo $raw['tempat']; ?>" > 
							</div>
							
							<div class="form-group">
								<label>Tanggal Lahir</label> <br>
								 <?php 
								$tgl_sekarang = date("Ymd");
								$tgl_skrg     = date("d");
								$bln_sekarang = date("m");
								$thn_sekarang = date("Y");
								$jam_sekarang = date("H:i:s");

								$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
													"Juni", "Juli", "Agustus", "September", 
													"Oktober", "November", "Desember");
								?>
					
<?php
if ($raw['no_tgl_lahir']=='Y') {
          $get_tgl2=substr($raw['tgl_lahir'],8,2);
          combotgl(1,31,'tgl_lahir',$get_tgl2);
          $get_bln2=substr($raw['tgl_lahir'],5,2);
          combonamabln(1,12,'bln_lahir',$get_bln2);
          $get_thn2=substr($raw['tgl_lahir'],0,4);
          combothn2($thn_sekarang-70,$thn_sekarang+2,'thn_lahir',$get_thn2);	
?>
&ensp;&ensp;&ensp;&ensp;<input type="radio" name="lahir_none" id="lahir_none" value="Y" class="cekbox" > Tidak Tahu&ensp;&ensp;&ensp;&ensp; <?php // echo $raw['no_tgl_lahir'];?>
<?php } 
else {
          $get_tgl2=substr($raw['tgl_lahir'],8,2);
          combotgl(1,31,'tgl_lahir',$get_tgl2);
          $get_bln2=substr($raw['tgl_lahir'],5,2);
          combonamabln(1,12,'bln_lahir',$get_bln2);
          $get_thn2=substr($raw['tgl_lahir'],0,4);
          combothn2($thn_sekarang-70,$thn_sekarang+2,'thn_lahir',$get_thn2);	
?>
&ensp;&ensp;&ensp;&ensp;<input type="radio" name="lahir_none" id="lahir_none" value="Y" class="cekbox" checked> Tidak Tahu&ensp;&ensp;&ensp;&ensp;  
<?php }  ?>
								
							</div>
							</div>
							<div class="form-group">
								<label>Jenis Kelamin</label>
<?php if ($raw['kelamin']=='L'){?>
			<div class="radio"> <label> <input type="radio" name="kelamin" id="headlineradios1" value="L" checked>Laki-laki </label> </div>
			<div class="radio"> <label> <input type="radio" name="kelamin" id="headlineradios2" value="P">Perempuan </label> </div> 
		<?php } else {?>
			<div class="radio"> <label> <input type="radio" name="kelamin" id="headlineradios1" value="L">Laki-laki </label> </div>
			<div class="radio"> <label> <input type="radio" name="kelamin" id="headlineradios2" value="P" checked>Perempuan </label> </div> 
		<?php } ?> 
							</div> 
				<div class="dwarn">	
<center><label>Jabatan</label></center>
<hr> 					
							<div class="form-group">
								<label>Jabatan</label> 
					<select class="form-control"  name="jabatan" id="jabatan">
					<?php
						$dataa = $this->M_dataadmin->pilihjabatanpegawai(); 
						if ($raw['id_jabatan']==0){
						echo "<option value='' selected>- Pilih -</option>";
						}   
						foreach($dataa->result_array() as $raaw) { 
						if ($raw['id_jabatan']==$raaw['id_jabatan']){ ?>
							<option  value="<?php echo $raaw['id_jabatan'];?>" selected><?php echo $raaw['nama_jabatanpegawai'];?></option>
						<?php } else {?>
							<option  value="<?php echo $raaw['id_jabatan'];?>"><?php echo $raaw['nama_jabatanpegawai'];?></option>
						<?php }
						}
						?> 
					</select> 
							</div>
							<div class="form-group">
								<label>TMT</label> <br>
<?php
if ($raw['no_tmtjabatan']=="Y") {
          $get_tgl2=substr($raw['tmtjabatan'],8,2);
          combotgl(1,31,'tmttanggaljabatan',$get_tgl2);
          $get_bln2=substr($raw['tmtjabatan'],5,2);
          combonamabln(1,12,'tmtbulanjabatan',$get_bln2);
          $get_thn2=substr($raw['tmtjabatan'],0,4);
          combothn2($thn_sekarang-70,$thn_sekarang+2,'tmttahunjabatan',$get_thn2);		
?>
&ensp;&ensp;&ensp;&ensp;<input type="radio" name="jabatan_none" id="jabatan_none" value="Y" class="cekbox" > Tidak Tahu&ensp;&ensp;&ensp;&ensp; 
<?php } 
else {
          $get_tgl2=substr($raw['tmtjabatan'],8,2);
          combotgl(1,31,'tmttanggaljabatan',$get_tgl2);
          $get_bln2=substr($raw['tmtjabatan'],5,2);
          combonamabln(1,12,'tmtbulanjabatan',$get_bln2);
          $get_thn2=substr($raw['tmtjabatan'],0,4);
          combothn2($thn_sekarang-70,$thn_sekarang+2,'tmttahunjabatan',$get_thn2);		
?>
&ensp;&ensp;&ensp;&ensp;<input type="radio" name="jabatan_none" id="jabatan_none" value="Y" class="cekbox" checked> Tidak Tahu&ensp;&ensp;&ensp;&ensp;  
<?php }  ?>								 
							</div>
					</div>	
<div class="dwarn">	
<center><label>Pangkat/Golongan</label></center>
<hr> 						
							<div class="form-group">
								<label>Pangkat/Golongan</label> 
					<select class="form-control"  name="pangkat" id="pangkat">
					<?php
						$dataa = $this->M_dataadmin->pilihgolongan(); 
						if ($raw['id_pangkat']==0){
						echo "<option value='' selected>- Pilih -</option>";
						}   
						foreach($dataa->result_array() as $raaw) { 
						if ($raw['id_pangkat']==$raaw['id_pangkat']){ ?>
							<option  value="<?php echo $raaw['id_pangkat'];?>" selected><?php echo $raaw['pangkat'];?> - <?php echo $raaw['gol_ruang'];?></option>
						<?php } else {?>
							<option  value="<?php echo $raaw['id_pangkat'];?>"><?php echo $raaw['pangkat'];?> - <?php echo $raaw['gol_ruang'];?></option>
						<?php }
						}
						?> 
					</select>  
							</div>
						<div class="form-group">
								<label>TMT</label> <br>
<?php
if ($raw['no_tmtpangkat']=="Y") {
          $get_tgl2=substr($raw['tmtpangkat'],8,2);
          combotgl(1,31,'tmttanggalpangkat',$get_tgl2);
          $get_bln2=substr($raw['tmtpangkat'],5,2);
          combonamabln(1,12,'tmtbulanpangkat',$get_bln2);
          $get_thn2=substr($raw['tmtpangkat'],0,4);
          combothn2($thn_sekarang-70,$thn_sekarang+2,'tmttahunpangkat',$get_thn2);		 
?>
&ensp;&ensp;&ensp;&ensp;<input type="radio" name="pangkat_none" id="pangkat_none" value="Y" class="cekbox" checked> Tidak Tahu&ensp;&ensp;&ensp;&ensp; 
<?php }
else { 
$get_tgl2=substr($raw['tmtpangkat'],8,2);
          combotgl(1,31,'tmttanggalpangkat',$get_tgl2);
          $get_bln2=substr($raw['tmtpangkat'],5,2);
          combonamabln(1,12,'tmtbulanpangkat',$get_bln2);
          $get_thn2=substr($raw['tmtpangkat'],0,4);
          combothn2($thn_sekarang-70,$thn_sekarang+2,'tmttahunpangkat',$get_thn2);		 
?>
&ensp;&ensp;&ensp;&ensp;<input type="radio" name="pangkat_none" id="pangkat_none" value="Y" class="cekbox"> Tidak Tahu&ensp;&ensp;&ensp;&ensp;  
<?php } ?>					 
							</div>	
					</div>
<div class="dwarn">	
	<div class="form-group">
<center><label>Masa Kerja</label></center>
<hr> 	
		<table>
		<tr><td><label>Bulan</label> <input  class="form-control" type="text" name="masakerjatahun" value="<?php echo $raw['masa_bulan']; ?>" style="width:150px;margin-right:15px;"></td><td><label>Tahun</label> <input  class="form-control" type="text" name="masakerjabulan" value="<?php echo $raw['masa_tahun']; ?>" style="width:150px;"></td></tr>
		</table> 
	</div>
</div>

<div class="dwarn">			
<center><label>Latihan Jabatan</label></center>
<hr> 			
<div class="form-group">
		<label>Nama</label> 
		<input  class="form-control" type="text" name="namalatihan" value="<?php echo $raw['namalatihan']; ?>"> 
		</div>
		<div class="form-group">
		<label>TMT</label> <br>
<?php 
if ($raw['no_latihan']=="Y") {    
	$get_bln2=$raw['bulanlatihan'];
    combonamabln(1,12,'bulanlatihan',$get_bln2);
    $get_thn2=$raw['tahunlatihan'];
    combothn2($thn_sekarang-70,$thn_sekarang+2,'tahunlatihan',$get_thn2);		  
?>	
&ensp;&ensp;&ensp;&ensp;<input type="radio" name="latihan_none" id="latihan_none" value="Y" class="cekbox" checked> Tidak Tahu&ensp;&ensp;&ensp;&ensp; 
<?php }
else { 
	$get_bln2=$raw['bulanlatihan'];
    combonamabln(1,12,'bulanlatihan',$get_bln2);
    $get_thn2=$raw['tahunlatihan'];
    combothn2($thn_sekarang-70,$thn_sekarang+2,'tahunlatihan',$get_thn2);		  
	?>	
&ensp;&ensp;&ensp;&ensp;<input type="radio" name="latihan_none" id="latihan_none" value="Y" class="cekbox"> Tidak Tahu&ensp;&ensp;&ensp;&ensp;  
<?php } ?> 
	</div>	
</div>

<div class="dwarn">			
<center><label>Pendidikan</label></center>
<hr> 			
<div class="form-group">
	<label>Nama Lembaga</label> 
	<input  class="form-control" type="text" name="pend" value="<?php echo $raw['pendidikan']; ?>"> 
</div>
<div class="form-group">
	<label>Tahun Lulus</label> 
	<input  class="form-control" type="text" name="tahunlulus" value="<?php echo $raw['tahun_lulus']; ?>"> 
</div>
<div class="form-group">
	<label>Tingkat Ijazah</label>
	<select class="form-control"  name="tingkat" id="tingkat">
		<?php
		$dataa = $this->M_dataadmin->pilihijazah(); 
		if ($raw['id_tingkat']==0){
			echo "<option value='' selected>- Pilih -</option>";
		}   
		foreach($dataa->result_array() as $raaw) { 
		if ($raw['id_tingkat']==$raaw['id_ijazah']){ ?>
		<option  value="<?php echo $raaw['id_ijazah'];?>" selected><?php echo $raaw['nama_ijazah'];?>  </option>
		<?php } else {?>
			<option  value="<?php echo $raaw['id_ijazah'];?>"><?php echo $raaw['nama_ijazah'];?> </option>
		<?php }
		}
		?> 
	</select>  
</div>
</div>

							
 
						</div>
                        <!-- /.panel-body -->
                    </div> 
                </div> 
				<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Foto & Keterangan
                        </div> 
                        <div class="panel-body">
                            <div class="form-group">
								<label>Foto Pegawai</label> 
								<? 
								if ($raw['gambar']!=''){
									$pathi=$raw['tgl_modif'];
									$pathi=str_replace("-","/",$pathi); ?> 
									<img src="<?php echo base_url(); ?>../foto_pegawai/<?php echo $pathi; ?>/small_<?php echo $raw['gambar']; ?>" width="100%">
								<?php } ?> <br> <br>
								<input type="file" name="imagefile"> 
								<br><br>
							</div>
							<div class="form-group">
								<label>Alamat</label> 
								<textarea class="form-control" rows="6"  name="alamat" ><?php echo $raw['alamat']; ?></textarea>
							</div>
							<div class="form-group">
								<label>Keterangan</label> 
								<textarea class="form-control" rows="6"  name="keterangan" ><?php echo $raw['keterangan']; ?></textarea>
							</div>
							<div class="form-group">
								<label>Catatan Mutasi Pegawai</label> 
								<textarea class="form-control" rows="3"  name="mutasi" ><?php echo $raw['mutasi']; ?></textarea>
							</div>
							 
							
							<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>pegawai" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						</div>  
						
                        </div> 
                    </div> 
                </div>  
            </div> 
	<?php } ?>
<?php echo form_close(); ?> 	 
		<? 
} 
?>
 