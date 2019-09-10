<?php 
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?> 
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet"> 
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Iklan</h1>
                </div> 
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Iklan Terbaru
                        </div> 
                        <div class="panel-body">
<!--		 <form action="<?php echo base_url(); ?>iklan/a_deleteall" method="POST">	-->	
	<?php echo form_open_multipart('iklan/deleteall'); ?> 		 
						<br> 
					 <center> 
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>
						
						<a href="<?php echo base_url(); ?>iklan/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
						</a>
						
						<a href="<?php echo base_url(); ?>iklan" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                                            <th>Judul Iklan</th>
                                            <th>Halaman</th>
                                            <th>Mobile</th>
											<th>Publish</th>
											<!--<th>Daerah</th>-->
											<th>Tgl Posting</th>
											<th>Operator</th>
											<th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	
	<?php
	$no=1; 
	foreach($artikel as $key => $row){ 
		$judul=seo_link($row['nama_iklan']); 	
		$a=substr($row['tgl_posting'], 0,4);
		$b=substr($row['tgl_posting'], 5,2);
		$c=substr($row['tgl_posting'], 8,9);
		$tanggal=$c.'/'.$b.'/'.$a; 
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_iklan']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
            <td><a class="bold" href="<?php echo base_url(); ?>iklan/edit/<?php echo $row['id_iklan']."/".$judul."/";?>"> <?php echo $row['nama_iklan']; ?> </a></td>
			<td><?php echo $row['nama_halamaniklan']; ?></td>
			<td class="center"><center>
			<?php if ($row['mobile']=='Y') {?>
				<a href="<?php echo base_url(); ?>iklan/nonmobile/<?php echo $row['id_iklan']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>iklan/mobile/<?php echo $row['id_iklan']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?>
			</center></td>
			<td>
			<?php if ($row['jangkrik']=='Y') {?>
				<a href="<?php echo base_url(); ?>iklan/nonaktif/<?php echo $row['id_iklan']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>iklan/aktif/<?php echo $row['id_iklan']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?> 
			</td>
			<!--<td></td>-->
			<td><?php echo tgl_indo($row['tgl_posting']); ?></td>
            <td class="center"><?php echo $row['nama_lengkap']; ?></td>
            <td class="center">
				<a href="<?php echo base_url(); ?>iklan/edit/<?php echo $row['id_iklan']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
                </a> 
				
				<a href="<?php echo base_url(); ?>iklan/delete/<?php echo $row['id_iklan']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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

<!--------------------------- S: JAVASCRIPT ----------------------->
<script language="javascript">
function validasi(form){
  if (form.halaman.value == 0){
    alert("Anda belum memilih Halaman Iklan.");
    form.halaman.focus();
    return (false);
  }  
  if (form.posisi.value == 0){
    alert("Anda belum memilih Posisi Iklan.");
    form.posisi.focus();
    return (false);
  }  
  return (true); 
}
</script>

<script type="text/javascript"> 
$(document).ready(function(){ 
$("#halaman").change(function(){
var prop = $("#halaman").val();
$.ajax({ 
url: "<?php echo base_url()?>iklan/halamaniklan",
type: 'POST',
data:  $("#iklan").serialize(),
//data: "op=generatecombokabupaten&prop="+prop, //lama
cache: false,
success: function(msg){ 
$("#isian").html(msg);
}
});
});


$("#halaman").change(function(){
var prop = $("#halaman").val();
$.ajax({ 
url: "<?php echo base_url()?>iklan/posisiiklan",
type: 'POST',
data:  $("#iklan").serialize(), 
cache: false,
success: function(msg){ 
$("#posisi").html(msg);

}
});
});
 

});
</script> 
<!----------------------- E: JAVASCRIPT ---------------------------->


<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>
	
 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Iklan</h1>
                </div> 
            </div>
			
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Iklan 
                        </div> 
                        <div class="panel-body"> 
							<?php //echo form_open_multipart('iklan/a_simpan'); ?> 
<!-- <form method="POST" action="$aksi?module=iklan&act=input" enctype="multipart/form-data"> -->


<form method="POST" id="iklan" name="iklan" action="<?php echo base_url(); ?>iklan/a_simpan"  enctype="multipart/form-data" onsubmit="return validasi(this)">		 
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>iklan" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>  
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">	 
						<div class="form-group">
						<label>Tanggal Posting</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
                                            <label>Publish Iklan</label>
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
								<label>Judul Iklan</label> 
								<input  class="form-control" type="text" name="judul" value="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
							</div>
					 
					 <div class="filterd">			
			<div class="form-group">
						<label>Tanggal Awal Iklan</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal1" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			</div>
			<div class="filterd">
			<div class="form-group">
						<label>Tanggal Akhir Iklan</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal2" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			</div>
			<div class="clearfix"></div>
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">	 
			
		<div class="filterd">			
			<div class="form-group">
                                            <label>Tampil pada Mobile Version</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="mobile" id="optionsRadios1" value="Y" checked>Ya
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="mobile" id="optionsRadios2" value="N">Tidak
                                                </label>
                                            </div> 
                                        </div>
				</div>	
				
				<div class="filterd">			
				<div class="form-group">
								<label>Urutan pada Mobile version</label> 
								<input  class="form-control" type="text" name="urutan_mobile" value="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
							</div>
				</div>	
				
<div class="clearfix"></div>				
			</div> 
							<div class="form-group">
								<label>Pilih Halaman Iklan</label> 
								<select class="form-control"  name="halaman" id="halaman">
								<option value="0" selected>- Pilih Halaman Iklan -</option>
						<?php
						$dataa = $this->M_dataadmin->pilihhalamaniklan(); 
						foreach($dataa->result_array() as $raw) {
						?> 
							<option  value="<?php echo $raw['id_halamaniklan'];?>"><?php echo $raw['nama_halamaniklan'];?></option>
						<?php } ?>			
                                </select>
							</div>
							
		<!-- POSISI IKLAN TAMPIL -->

		 <div id="isian" style="margin:20px 0;"></div> 
		 <div class="clearfix"></div>
		<!-- POSISI IKLAN TAMPIL -->
							<div class="form-group">
								<label>Pilih Posisi Iklan</label> 
								<select class="form-control"  name="posisi" id="posisi">
								<option value="0" selected>- Pilih Posisi Iklan -</option>
						<?php
						$dataa = $this->M_dataadmin->pilihposisiiklan(); 
						foreach($dataa->result_array() as $raw) {
						?> 
							<option  value="<?php echo $raw['id_posisiiklan'];?>"><?php echo $raw['nama_posisiiklan'];?></option>
						<?php } ?>			
                                </select>
							</div>
						 
							<div class="form-group">
								<label>Link Iklan</label> 
								<input  class="form-control" type="text" name="link" value="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
							</div>
		<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
						<div class="form-group">
								<label>Materi Iklan</label> 
								<input type="file" name="imagefile"> 
							</div>
							</div>
							<div class="form-group">
								<label>Keterangan </label> 
								<textarea class="form-control" rows="6"  name="keterangan" ></textarea> 
							</div> 
							<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>iklan" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						</div>  
						<?php echo form_close(); ?>		
 
						</div>
                        <!-- /.panel-body -->
                    </div> 
                </div> 
				 
		<?
		}
else if ($this->uri->segment(2,0)=='edit') { 
        ?>

<!--------------------------- S: JAVASCRIPT ----------------------->
<script language="javascript">
function validasi(form){
  if (form.halaman.value == 0){
    alert("Anda belum memilih Halaman Iklan.");
    form.halaman.focus();
    return (false);
  }  
  if (form.posisi.value == 0){
    alert("Anda belum memilih Posisi Iklan.");
    form.posisi.focus();
    return (false);
  }  
  return (true); 
}
</script>

<script type="text/javascript"> 
$(document).ready(function(){ 
$("#halaman").change(function(){
var prop = $("#halaman").val();
$.ajax({ 
url: "<?php echo base_url()?>iklan/halamaniklan",
type: 'POST',
data:  $("#iklan").serialize(),
//data: "op=generatecombokabupaten&prop="+prop, //lama
cache: false,
success: function(msg){ 
$("#isian").html(msg);
}
});
});


$("#halaman").change(function(){
var prop = $("#halaman").val();
$.ajax({ 
url: "<?php echo base_url()?>iklan/posisiiklan",
type: 'POST',
data:  $("#iklan").serialize(), 
cache: false,
success: function(msg){ 
$("#posisi").html(msg);

}
});
});
 

});
</script> 
<!----------------------- E: JAVASCRIPT ---------------------------->	  
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>
	
 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Iklan</h1>
                </div> 
            </div>
			
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Iklan 
                        </div> 
                        <div class="panel-body"> 
					 
	<form method="POST" id="iklan" name="iklan" action="<?php echo base_url(); ?>iklan/a_edit"  enctype="multipart/form-data" onsubmit="return validasi(this)">					
		<?php
		$edit = $this->M_dataadmin->editiklan($this->uri->segment(3,0)); 
		foreach($edit->result_array() as $raw)
		{
		$photopath = str_replace('-', '/', $raw['tanggal_modif']);   
		$a=substr($raw['tgl_posting'], 0,4);
		$b=substr($raw['tgl_posting'], 5,2);
		$c=substr($raw['tgl_posting'], 8,9);
		$tanggal=$c.'-'.$b.'-'.$a;
		$tanggalmulai=substr($raw['tgl_mulai'], 8,9).'-'.substr($raw['tgl_mulai'], 5,2).'-'.substr($raw['tgl_mulai'], 0,4);
		$tanggalakhir=substr($raw['tgl_akhir'], 8,9).'-'.substr($raw['tgl_akhir'], 5,2).'-'.substr($raw['tgl_akhir'], 0,4);
		?>
						<input type="hidden" name="id" value="<?php echo $raw['id_iklan']; ?>">  
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>iklan" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
			<div class="clearfix"></div>
						</div>  
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">	 
						<div class="form-group">
						<label>Tanggal Posting</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
            <label>Publish Iklan</label>
		<?php if ($raw['aktif']=='Y'){?>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios1" value="Y" checked>Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios2" value="N">Tidak </label> </div> 
		<?php } else {?>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios1" value="Y">Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios2" value="N" checked>Tidak </label> </div> 
		<?php } ?> 
            </div>
			</div>
			<div class="form-group">
				<label>Judul Iklan</label> 
				<input  class="form-control" type="text" name="judul" value="<?php echo $raw['nama_iklan']; ?>">
			</div>
					 
			<div class="filterd">			
			<div class="form-group">
				<label>Tanggal Awal Iklan</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal1" class="form-control" value="<?php echo $tanggalmulai; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			</div>
			<div class="filterd">
			<div class="form-group">
				<label>Tanggal Akhir Iklan</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal2" class="form-control" value="<?php echo $tanggalakhir; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			</div>
			<div class="clearfix"></div>
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">	 
			
		<div class="filterd">			
			<div class="form-group">
            <label>Tampil pada Mobile Version</label> 
		<?php if ($raw['mobile']=='Y'){?>
			<div class="radio"> <label> <input type="radio" name="mobile" id="aktifradios1" value="Y" checked>Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="mobile" id="aktifradios2" value="N">Tidak </label> </div> 
		<?php } else {?>
			<div class="radio"> <label> <input type="radio" name="mobile" id="aktifradios1" value="Y">Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="mobile" id="aktifradios2" value="N" checked>Tidak </label> </div> 
		<?php } ?> 
            </div>
                                        
				</div>	
				
				<div class="filterd">			
				<div class="form-group">
					<label>Urutan pada Mobile version</label> 
					<input  class="form-control" type="text" name="urutan_mobile" value="<?php echo $raw['urutan_mobile']; ?>"> 
				</div>
				</div>	
				
<div class="clearfix"></div>				
 </div>
	<div class="form-group">
		<label>Pilih Halaman Iklan</label> 
			<select class="form-control"  name="halaman" id="halaman">
				<?php
				$dataa = $this->M_dataadmin->pilihhalamaniklan(); 
				if ($raw['id_halamaniklan']==0){
				echo "<option value=0 selected>- Pilih Halaman Iklan -</option>";
				}   
				foreach($dataa->result_array() as $raaw) { 
				if ($raw['id_halamaniklan']==$raaw['id_halamaniklan']){ ?>
					<option  value="<?php echo $raaw['id_halamaniklan'];?>" selected><?php echo $raaw['nama_halamaniklan'];?></option>
				<?php } else {?>
					<option  value="<?php echo $raaw['id_halamaniklan'];?>"><?php echo $raaw['nama_halamaniklan'];?></option>
				<?php }
				}
				?>
			</select>
		</div>
							
		<!-- POSISI IKLAN TAMPIL -->

		 <div id="isian" style="margin:20px 0;"></div> 
		 <div class="clearfix"></div>
		<!-- POSISI IKLAN TAMPIL -->
		<div class="form-group">
			<label>Pilih Posisi Iklan</label> 
			<select class="form-control"  name="posisi" id="posisi">
			<?php
				$dataa = $this->M_dataadmin->pilihposisiiklan(); 
				if ($raw['id_posisiiklan']==0){
				echo "<option value=0 selected>- Pilih Posisi Iklan -</option>";
				}   
				foreach($dataa->result_array() as $r) { 
				if ($raw['id_posisiiklan']==$r['id_posisiiklan']){ ?>
					<option  value="<?php echo $r['id_posisiiklan'];?>" selected><?php echo $r['nama_posisiiklan'];?></option>
				<?php } else {?>
					<option  value="<?php echo $r['id_posisiiklan'];?>"><?php echo $r['nama_posisiiklan'];?></option>
				<?php }
				}
				?> 		
            </select>
		</div>
						 
							<div class="form-group">
								<label>Link Iklan</label> 
								<input  class="form-control" type="text" name="link" value="<?php echo $raw['link']; ?>"> 
							</div>
		<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">					
						<div class="form-group">
								<label>Materi Iklan</label> 
								<br>
								<? 
								if ($raw['gambar']!=''){
									$pathi=$raw['tanggal_modif'];
									$pathi=str_replace("-","/",$pathi); ?> 
									<img src="<?php echo base_url(); ?>../materi_iklan/<?php echo $pathi; ?>/small_<?php echo $raw['gambar']; ?>" width="400">
								<?php } ?> <br> <br>
								<input type="file" name="imagefile"> 
								<br><br> 
							</div>
							</div>
							<div class="form-group">
								<label>Keterangan </label> 
								<textarea class="form-control" rows="6"  name="keterangan" ><?php echo $raw['keterangan']; ?></textarea> 
							</div> 
							<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>iklan" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						</div>  
					 
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						 
						  <?php } ?>	
						<?php echo form_close(); ?> 
						</div> 
                    </div> 
               
            </div> 	
		<? 
} 
?>
 