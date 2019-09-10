<?php 
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?> 
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet"> 
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Halaman Profil</h1>
                </div> 
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Halaman Profil Terbaru
                        </div> 
                        <div class="panel-body">
<!--		 <form action="<?php echo base_url(); ?>halamanprofil/a_deleteall" method="POST">	-->	
	<?php echo form_open_multipart('halamanprofil/deleteall'); ?> 		 
						<br> 
					 <center> 
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>
						
						<a href="<?php echo base_url(); ?>halamanprofil/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
						</a>
						
						<a href="<?php echo base_url(); ?>halamanprofil" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                                            <th>Judul Halaman Profil</th> 
                                            <th>Dibaca</th>
											<th>Publish</th>
											<!--<th>Daerah</th>-->
											<th>Tanggal</th>
											<th>Operator</th>
											<th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	
	<?php
	$no=1; 
	foreach($artikel as $key => $row){ 
		$judul=seo_link($row['judul']); 	
		$a=substr($row['tanggal'], 0,4);
		$b=substr($row['tanggal'], 5,2);
		$c=substr($row['tanggal'], 8,9);
		$tanggal=$c.'/'.$b.'/'.$a; 
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_halamanprofil']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
            <td><a class="bold" href="<?php echo base_url(); ?>halamanprofil/edit/<?php echo $row['id_halamanprofil']."/".$judul."/";?>"> <?php echo $row['judul']; ?> </a></td>
			 
			<td class="center"><center><?php echo $row['dibaca']; ?></center></td>
			<td>
			<?php if ($row['jangkrik']=='Y') {?>
				<a href="<?php echo base_url(); ?>halamanprofil/nonaktif/<?php echo $row['id_halamanprofil']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>halamanprofil/aktif/<?php echo $row['id_halamanprofil']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?> 
			</td>
			<!--<td></td>-->
			<td><?php echo $row['hari']; ?>, <?php echo $tanggal; ?></td>
            <td class="center"><?php echo $row['nama_lengkap']; ?></td>
            <td class="center">
				<a href="<?php echo base_url(); ?>halamanprofil/edit/<?php echo $row['id_halamanprofil']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
                </a> 
				
				<a href="<?php echo base_url(); ?>halamanprofil/delete/<?php echo $row['id_halamanprofil']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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
                    <h1 class="page-header">Tambah Halaman Profil</h1>
                </div> 
            </div>
			
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Halaman Profil 
                        </div> 
                        <div class="panel-body"> 
							<?php echo form_open_multipart('halamanprofil/a_simpan'); ?> 
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>halamanprofil" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>  
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">	 
						<div class="form-group">
						<label>Tanggal Halaman Profil</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
                                            <label>Publish Halaman Profil</label>
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
								<label>Judul Halaman Profil</label> 
								<input  class="form-control" type="text" name="judul" value="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
							</div>
							
						 
							
						  
							<div class="form-group">
								<label>Isi Halaman Profil</label> 
								<textarea name="isi_halamanprofil" id="loko" rows="15" ></textarea>
 
							</div>
			 <div class="form-group">
								<label>Foto Halaman Profil</label> 
								<input type="file" name="imagefile"> 
							</div>
							<div class="form-group">
								<label>Text Foto</label> 
								<textarea class="form-control" rows="3"  name="text_foto" ></textarea>
							</div>
					
					<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>halamanprofil" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						</div>  
						<?php echo form_close(); ?> 
					
						</div> 
                    </div> 
                </div>  
				 
               
            </div> 
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
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Halaman Profil</h1>
                </div> 
            </div>
			
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Halaman Profil 
                        </div> 
                        <div class="panel-body"> 
					<?php echo form_open_multipart('halamanprofil/a_edit'); ?> 
					
		<?php
		$edit = $this->M_dataadmin->edithalamanprofil($this->uri->segment(3,0)); 
		foreach($edit->result_array() as $raw)
		{
		$photopath = str_replace('-', '/', $raw['tanggal_modif']);   
		$a=substr($raw['tanggal'], 0,4);
		$b=substr($raw['tanggal'], 5,2);
		$c=substr($raw['tanggal'], 8,9);
		$tanggal=$c.'-'.$b.'-'.$a;
		?>
						<input type="hidden" name="id" value="<?php echo $raw['id_halamanprofil']; ?>">  
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>halamanprofil" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>  
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">	 
						<div class="form-group">
						<label>Tanggal Halaman Profil</label> 
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
            <label>Publish Halaman Profil</label>
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
								<label>Judul Halaman Profil</label> 
								<input  class="form-control" type="text" name="judul" value="<?php echo $raw['judul']; ?>">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
							</div>
						 
							
						 
						 
							<div class="form-group">
								<label>Isi Halaman Profil</label> 
								<textarea name="isi_halamanprofil" id="loko" rows="15" ><?php echo $raw['isi_halaman']; ?></textarea>
 
							</div>
		 
						  <div class="form-group">
						  <br>
								<label>Foto Halaman Profil</label> 
								
								<? 
								if ($raw['gambar']!=''){
								?>
								<div style="background:#efefef;padding:20px;">
								<?php
									$pathi=$raw['tanggal_modif'];
									$pathi=str_replace("-","/",$pathi); ?> 
									<img src="<?php echo base_url(); ?>../foto_halamanprofil/<?php echo $pathi; ?>/<?php echo $raw['gambar']; ?>" width="100%">
								</div>
								<?php } ?> 
								
								<br> <br>
								<input type="file" name="imagefile"> 
								<br><br>
							</div>
							<div class="form-group">
								<label>Text Foto</label> 
								<textarea class="form-control" rows="6"  name="text_foto" ><?php echo $raw['text_foto']; ?></textarea>
							</div>
							
									<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						
						<a href="<?php echo base_url(); ?>halamanprofil" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						</div>  
					<?php } ?>	
						<?php echo form_close(); ?> 
							
						</div> 
                    </div>
                   
               
                </div>
				 
               
            </div> 	
		<? 
} 
?>
 