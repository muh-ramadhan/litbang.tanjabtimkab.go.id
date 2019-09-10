<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
	?>
	<!-- Social Buttons CSS -->
	<link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Data Berita Foto</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-th-list fa-fw"></i> Berita Foto Terbaru
				</div>
				<div class="panel-body">
					<!--		 <form action="<?php echo base_url(); ?>fotoberita/a_deleteall" method="POST">	-->
						<?php echo form_open_multipart('fotoberita/deleteall'); ?>
						<br>
						<center>
							<a class="btn btn-app btn-light btn-xs radius-4">
								<i class="ace-icon fa fa-home bigger-160"></i> Home
							</a>
							<a href="<?php echo base_url(); ?>fotoberita/add" class="btn btn-app btn-primary btn-xs radius-4">
								<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
							</a>
							<a href="<?php echo base_url(); ?>fotoberita" class="btn btn-app btn-warning  btn-xs  radius-4">
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
											<th class="no" colspan="0" id="ck" title="Pilih Semua"><input type="checkbox" id="selectall"></th>
											<th>Judul Berita Foto</th>
											<th>Jumlah Foto</th>
											<th>Dibaca</th>
											<th>Publish</th>
											<th>Tanggal Upload</th>
											<th>Operator</th>
											<th>Edit</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no=1;
										foreach($artikel as $key => $row){
											$judul=seo_link($row['judul_fotoberita']);
											$a=substr($row['tgl_posting'], 0,4);
											$b=substr($row['tgl_posting'], 5,2);
											$c=substr($row['tgl_posting'], 8,9);
											$tanggal=$c.'/'.$b.'/'.$a;
											?>
											<tr class="odd">
												<td><?php echo $no; ?></td>
												<td>
													<center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_fotoberita']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center>
												</td>
												<td>
													<a class="bold" href="<?php echo base_url(); ?>fotoberita/edit/<?php echo $row['id_fotoberita']."/".$judul."/";?>"> <?php echo $row['judul_fotoberita']; ?> </a>
												</td>
												<td><?php //echo $row['nama_halamanfotoberita']; ?></td>
												<td><?php echo $row['dibaca']; ?> </td>
												<td>
													<?php if ($row['aktif']=='Y') {?>
														<a href="<?php echo base_url(); ?>fotoberita/nonaktif/<?php echo $row['id_fotoberita']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
													<?php } else {?>
														<a href="<?php echo base_url(); ?>fotoberita/aktif/<?php echo $row['id_fotoberita']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
													<?php } ?>
												</td>
												<!--<td></td>-->
												<td><?php echo tgl_indo($row['tgl_posting']); ?></td>
												<td class="center"><?php echo $row['nama_lengkap']; ?></td>
												<td class="center">
													<a href="<?php echo base_url(); ?>fotoberita/edit/<?php echo $row['id_fotoberita']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
														<i class="fa fa-pencil"></i> Edit
													</a>

													<a href="<?php echo base_url(); ?>fotoberita/delete/<?php echo $row['id_fotoberita']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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

		$tanggal=date('d-m-Y');
	//ACAK ID BERITAFOTO
		$acak = rand(1,500);
		$id=$tanggal.$acak;
		?>

		<!--------------------------- S: JAVASCRIPT ----------------------->
		<script language="javascript">
			function validasi(form){
				if (form.halaman.value == 0){
					alert("Anda belum memilih Halaman Berita Foto.");
					form.halaman.focus();
					return (false);
				}
				if (form.posisi.value == 0){
					alert("Anda belum memilih Posisi Berita Foto.");
					form.posisi.focus();
					return (false);
				}
				return (true);
			}
		</script>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#inputdt").change(function(){
					var prop = $("#inputdt").val();
					$.ajax({
						url: "<?php echo base_url()?>fotoberita/inputfoto",
						type: 'POST',
						data:  $("#iklan").serialize(),
						cache: false,
						success: function(msg){
							$("#isian").html(msg);
						}
					});
				});
			});
		</script>
		<!----------------------- E: JAVASCRIPT ---------------------------->


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
       		<h1 class="page-header">Tambah Berita Foto</h1>
       	</div>
       </div>

       <div class="row">
       	<div class="col-lg-10">
       		<div class="panel panel-default">
       			<div class="panel-heading">
       				<i class="fa fa-wrench fa-fw"></i> Tambah Berita Foto
       			</div>
       			<div class="panel-body">

       				<form method="POST" id="iklan" name="iklan" action="<?php echo base_url(); ?>fotoberita/a_simpan"  enctype="multipart/form-data" onsubmit="return validasi(this)">
       					<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
       						<center>
       							<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
       								<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
       							</button>

       							<a href="<?php echo base_url(); ?>fotoberita" class="btn btn-app btn-warning  btn-xs  radius-4">
       								<i class="ace-icon fa fa-times bigger-160"></i> Cancel
       							</a>
       						</center>
       						<div class="clearfix"></div>
       					</div>

       					<input type="hidden" name="id" value="<?php echo seo_link($id); ?>">

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
       						<label>Publish Berita Foto</label>
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
       					<label>Judul Berita Foto</label>
       					<input  class="form-control" type="text" name="judul" value="">
       					<!-- <p class="help-block">Example block-level help text here.</p> -->
       				</div>
	<!--
			<div class="form-group">
			<label>Foto Besar (Default Foto) <span style="color:#ff0000;"><i>* Jika Ada</i></span></label>
				<input type="file" name="imagefile">
			</div>
		-->

		<div class="form-group">
			<label>Jumlah Foto Beritaa</label>
			<select  class="form-control" name="inputdt" id="inputdt" style="width:100px;">
				<option value="1" selected="">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
		</div>
		<div class="clearfix"></div>
		<div id="isian" style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
		</div>

		<div class="form-group">
			<label>Keterangan </label>
			<textarea class="form-control" id="loko" rows="10"  name="keterangan" ></textarea>
		</div>

		<div class="clearfix"></div>
		<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
			<div class="clearfix"></div>
			<center>
				<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
					<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
				</button>

				<a href="<?php echo base_url(); ?>fotoberita" class="btn btn-app btn-warning  btn-xs  radius-4">
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
				alert("Anda belum memilih Halaman Berita Foto.");
				form.halaman.focus();
				return (false);
			}
			if (form.posisi.value == 0){
				alert("Anda belum memilih Posisi Berita Foto.");
				form.posisi.focus();
				return (false);
			}
			return (true);
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#inputdt").change(function(){
				var prop = $("#inputdt").val();
				$.ajax({
					url: "<?php echo base_url()?>fotoberita/inputfoto",
					type: 'POST',
					data:  $("#iklan").serialize(),
					cache: false,
					success: function(msg){
						$("#isian").html(msg);
					}
				});
			});
		});
	</script>
	<!----------------------- E: JAVASCRIPT ---------------------------->

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
       		<h1 class="page-header">Edit Berita Foto</h1>
       	</div>
       </div>

       <div class="row">
       	<div class="col-lg-10">
       		<div class="panel panel-default">
       			<div class="panel-heading">
       				<i class="fa fa-wrench fa-fw"></i>Edit Berita Foto
       			</div>
       			<div class="panel-body">

       				<!--	<form method="POST" id="fotoberita" name="fotoberita" action="<?php echo base_url(); ?>fotoberita/a_edit"  enctype="multipart/form-data" onsubmit="return validasi(this)"> -->

       					<form method="POST" id="iklan" name="iklan" action="<?php echo base_url(); ?>fotoberita/a_edit"  enctype="multipart/form-data" onsubmit="return validasi(this)">

       						<?php
       						$edit = $this->M_dataadmin->editfotoberita($this->uri->segment(3,0));
       						foreach($edit->result_array() as $raw)
       						{
       							$photopath = str_replace('-', '/', $raw['tanggal']);
       							$a=substr($raw['tanggal'], 0,4);
       							$b=substr($raw['tanggal'], 5,2);
       							$c=substr($raw['tanggal'], 8,9);
       							$tanggal=$c.'-'.$b.'-'.$a;
       							?>
       							<input type="hidden" name="id" value="<?php echo $raw['id_fotoberita']; ?>">
       							<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
       								<center>
       									<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
       										<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
       									</button>
       									<a href="<?php echo base_url(); ?>fotoberita" class="btn btn-app btn-warning  btn-xs  radius-4">
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
       								<label>Publish Berita Foto</label>
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
       							<label>Judul Berita Foto</label>
       							<input  class="form-control" type="text" name="judul" value="<?php echo $raw['judul_fotoberita']; ?>">
       						</div>

       						<div class="row">
       							<?php
       							$edit = $this->M_dataadmin->selectgallery($this->uri->segment(3,0));
       							$no=1;
       							foreach($edit->result_array() as $row)
       							{
       								?>
       								<div class="col-lg-4">
       									<div class="panel panel-primary">
       										<div class="panel-heading">
       											Foto <?php echo $no; ?>
       										</div>
       										<div class="panel-body">
       											<?
       											if ($row['gbr_gallery']!=''){
       												$pathi=$row['tanggal_modif'];
       												$pathi=str_replace("-","/",$pathi); ?>
       												<img src="<?php echo base_url(); ?>../foto_galeri/<?php echo $pathi; ?>/small_<?php echo $row['gbr_gallery']; ?>" width="100%">
       											<?php } ?>
       											<br>
       											<p><?php echo $row['keterangan']; ?></p>
       										</div>
       										<div class="panel-footer">
       											<!-- Panel Footer -->
       											<a href="<?php echo base_url(); ?>fotoberita/hapusgallery/<?php echo $row['id_gallery'];?>/<?php echo $raw['id_fotoberita'];?>" class="btn btn-block btn-social btn-pinterest" style="display:inline;margin-right:10px;" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')"> <i class="fa fa-trash-o"></i> Hapus </a>

       											<?php if ($row['aktif']=='Y') { ?>
       												<a href="<?php echo base_url(); ?>fotoberita/nonaktifgallery/<?php echo $row['id_gallery'];?>/<?php echo $raw['id_fotoberita'];?>"  style="display:inline;" class="btn btn-block btn-social btn-dropbox" onclick="return confirm('Non Aktifkan Pilihan?')"> <i class="fa fa-check"></i> Aktif </a>
       											<?php }
       											else { ?>
       												<a href="<?php echo base_url(); ?>fotoberita/aktifgallery/<?php echo $row['id_gallery'];?>/<?php echo $raw['id_fotoberita'];?>"  style="display:inline;" class="btn btn-block btn-social btn-dropbox" onclick="return confirm('Aktifkan Pilihan?')"> <i class="fa fa-times"></i> Non Aktif </a>
       											<?php } ?>
       										</div>
       									</div>
       								</div>
       								<?php
       								$no++;
       							}
       							?>
       						</div>
       						<br><br>
       						<div class="form-group">
       							<label>Tambah Foto Berita</label>
       							<select  class="form-control" name="inputdt" id="inputdt" style="width:100px;">
       								<option value="1" selected="">1</option>
       								<option value="2">2</option>
       								<option value="3">3</option>
       								<option value="4">4</option>
       								<option value="5">5</option>
       								<option value="6">6</option>
       								<option value="7">7</option>
       								<option value="8">8</option>
       								<option value="9">9</option>
       								<option value="10">10</option>
       							</select>
       						</div>
       						<div class="clearfix"></div>
       						<div id="isian" style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
       						</div>


       						<div class="form-group">
       							<label>Keterangan </label>
       							<textarea class="form-control" rows="10" id="loko"  name="keterangan" ><?php echo $raw['keterangan']; ?></textarea>
       						</div>
       						<div class="clearfix"></div>
       						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
       							<div class="clearfix"></div>
       							<center>
       								<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
       									<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
       								</button>

       								<a href="<?php echo base_url(); ?>fotoberita" class="btn btn-app btn-warning  btn-xs  radius-4">
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
