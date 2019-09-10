<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
	?>
	<!-- Social Buttons CSS -->
	<link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Data Pengumuman</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-th-list fa-fw"></i> Pengumuman Terbaru
				</div>
				<div class="panel-body">
					<!--		 <form action="<?php echo base_url(); ?>pengumuman/a_deleteall" method="POST">	-->
						<?php echo form_open_multipart('pengumuman/deleteall'); ?>
						<br>
						<center>
							<a class="btn btn-app btn-light btn-xs radius-4">
								<i class="ace-icon fa fa-home bigger-160"></i> Home
							</a>

							<a href="<?php echo base_url(); ?>pengumuman/add" class="btn btn-app btn-primary btn-xs radius-4">
								<i class="ace-icon fa fa-plus-circle bigger-160"></i> Tambah
							</a>

							<a href="<?php echo base_url(); ?>pengumuman" class="btn btn-app btn-warning  btn-xs  radius-4">
								<i class="ace-icon fa fa-refresh bigger-160"></i> Segarkan
							</a>

							<button type="submit" class="btn btn-app btn-inverse btn-xs radius-4" style="width:140px;">
								<i class="ace-icon fa  fa-trash-o bigger-160"></i> Hapus Pilihan
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
												<th>Judul Pengumuman</th>
												<th>Dibaca</th>
												<th>Publish</th>
												<th>Tanggal Posting</th>
												<th>Operator</th>
												<th>Edit</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no=1;
											foreach($artikel as $key => $row){
												$judul=seo_link($row['judul']);
												?>
												<tr class="odd">
													<td><?php echo $no; ?></td>
													<td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_pengumuman']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
													<td><a class="bold" href="<?php echo base_url(); ?>pengumuman/edit/<?php echo $row['id_pengumuman']."/".$judul."/";?>"> <?php echo $row['judul']; ?> </a></td>
													<td class="center"><center><?php echo $row['dibaca']; ?></center></td>
													<td>
														<?php if ($row['jangkrik']=='Y') {?>
															<a href="<?php echo base_url(); ?>pengumuman/nonaktif/<?php echo $row['id_pengumuman']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
														<?php } else {?>
															<a href="<?php echo base_url(); ?>pengumuman/aktif/<?php echo $row['id_pengumuman']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
														<?php } ?>
													</td>
													<td> <?php echo tgl_indo($row['tanggal_pengumuman']); ?></td>
													<td class="center"><?php echo $row['nama_lengkap']; ?></td>
													<td class="center">
														<a href="<?php echo base_url(); ?>pengumuman/edit/<?php echo $row['id_pengumuman']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
															<i class="fa fa-pencil"></i> Edit
														</a>

														<a href="<?php echo base_url(); ?>pengumuman/delete/<?php echo $row['id_pengumuman']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
															<i class="fa fa-times"></i> Delete
														</a>
													</td>
												</tr>
												<?php $no=$no+1; } ?>
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
								<?php } else { ?>
									Maaf, Data Belum Tersedia
								<?php } ?>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			<?php }
			else if ($this->uri->segment(2,0)=='add') { ?>
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
       		<h1 class="page-header">Tambah Pengumuman</h1>
       	</div>
       </div>
       <div class="row">
       	<div class="col-lg-8">
       		<div class="panel panel-default">
       			<div class="panel-heading">
       				<i class="fa fa-wrench fa-fw"></i> Tambah Pengumuman
       			</div>
       			<div class="panel-body">
       				<?php echo form_open_multipart('pengumuman/a_simpan'); ?>
       				<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
       					<center>
       						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
       							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Simpan
       						</button>

       						<a href="<?php echo base_url(); ?>pengumuman" class="btn btn-app btn-warning  btn-xs  radius-4">
       							<i class="ace-icon fa fa-times bigger-160"></i> Batal
       						</a>
       					</center>
       					<div class="clearfix"></div>
       				</div>
       				<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
       					<div class="form-group">
       						<label>Tanggal Pengumuman</label>
       						<div class="input-group date" id="datetimepicker1" style="width:180px;" >
       							<input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
       							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
       						</span>
       					</div>
       				</div>
       				<div class="form-group">
       					<label>Publish Pengumuman</label>
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
       				<label>Judul Pengumuman</label>
       				<input  class="form-control" type="text" name="judul" value="">
       			</div>
       			<div class="form-group">
       				<label>Sumber</label>
       				<input  class="form-control" type="text" name="sumber" value="">
       			</div>
       			<div class="form-group">
       				<label>Isi Pengumuman</label>
       				<textarea name="isi_pengumuman" id="loko" rows="18" ></textarea>

       			</div>
       			<div class="dwarn">
       				<div class="form-group">
       					<label>File Pendukung 1</label>
       					<select class="form-control"  name="file1" id="file1">
       						<option value="0" selected>- Pilih -</option>
       						<?php
       						$dataa = $this->M_dataadmin->pilihdownload();
       						foreach($dataa->result_array() as $raw) {
       							?>
       							<option  value="<?php echo $raw['id_download'];?>"><?php echo $raw['judul'];?></option>
       						<?php } ?>
       					</select>
       				</div>
       				<div class="form-group">
       					<label>File Pendukung 2</label>
       					<select class="form-control"  name="file2" id="file2">
       						<option value="0" selected> - Pilih - </option>
       						<?php
       						$dataa = $this->M_dataadmin->pilihdownload();
       						foreach($dataa->result_array() as $raw) {
       							?>
       							<option  value="<?php echo $raw['id_download'];?>"><?php echo $raw['judul'];?></option>
       						<?php } ?>
       					</select>
       				</div>
       				<div class="form-group">
       					<label>File Pendukung 3</label>
       					<select class="form-control"  name="file3" id="file3">
       						<option value="0" selected>- Pilih -</option>
       						<?php
       						$dataa = $this->M_dataadmin->pilihdownload();
       						foreach($dataa->result_array() as $raw) {
       							?>
       							<option  value="<?php echo $raw['id_download'];?>"><?php echo $raw['judul'];?></option>
       						<?php } ?>
       					</select>
       				</div>
       			</div>
       		</div>
       	</div>
       </div>
       <div class="col-lg-4">
       	<div class="panel panel-default">
       		<div class="panel-heading">
       			<i class="fa fa-bell fa-fw"></i> Gambar Pengumuman
       		</div>
       		<div class="panel-body">
       			<div class="form-group">
       				<label>Foto Pengumuman</label>
       				<input type="file" name="imagefile">
       			</div>

       			<div class="form-group">
       				<label>Keterangan</label>
       				<textarea class="form-control" name="keterangan"  rows="3"></textarea>
       			</div>
       			<div class="clearfix"></div>
       			<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
       				<div class="clearfix"></div>
       				<center>
       					<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
       						<i class="ace-icon fa fa-floppy-o bigger-160"></i> Simpan
       					</button>

       					<a href="<?php echo base_url(); ?>pengumuman" class="btn btn-app btn-warning  btn-xs  radius-4">
       						<i class="ace-icon fa fa-times bigger-160"></i> Batal
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
       		<h1 class="page-header">Edit Pengumuman</h1>
       	</div>
       </div>

       <div class="row">
       	<div class="col-lg-8">
       		<div class="panel panel-default">
       			<div class="panel-heading">
       				<i class="fa fa-wrench fa-fw"></i>Edit Pengumuman
       			</div>
       			<div class="panel-body">
       				<?php echo form_open_multipart('pengumuman/a_edit'); ?>

       				<?php
       				$edit = $this->M_dataadmin->editpengumuman($this->uri->segment(3,0));
       				foreach($edit->result_array() as $raw)
       				{
       					$a=substr($raw['tanggal_pengumuman'], 0,4);
       					$b=substr($raw['tanggal_pengumuman'], 5,2);
       					$c=substr($raw['tanggal_pengumuman'], 8,9);
       					$tanggal=$c.'-'.$b.'-'.$a;
       					?>
       					<input type="hidden" name="id" value="<?php echo $raw['id_pengumuman']; ?>">
       					<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
       						<center>
       							<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
       								<i class="ace-icon fa fa-floppy-o bigger-160"></i> Simpan
       							</button>

       							<a href="<?php echo base_url(); ?>pengumuman" class="btn btn-app btn-warning  btn-xs  radius-4">
       								<i class="ace-icon fa fa-times bigger-160"></i> Batal
       							</a>
       						</center>
       						<div class="clearfix"></div>
       					</div>
       					<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
       						<div class="form-group">
       							<label>Tanggal Pengumuman</label>
       							<div class="input-group date" id="datetimepicker1" style="width:180px;" >
       								<input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
       								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
       							</span>
       						</div>
       					</div>
       					<div class="form-group">
       						<label>Publish Pengumuman</label>
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
       					<label>Judul Pengumuman</label>
       					<input  class="form-control" type="text" name="judul" value="<?php echo $raw['judul']; ?>">
       					<!-- <p class="help-block">Example block-level help text here.</p> -->
       				</div>


       				<div class="form-group">
       					<label>Sumber</label>
       					<input  class="form-control" type="text" name="sumber" value="<?php echo $raw['sumber']; ?>">
       				</div>
       				<div class="form-group">
       					<label>Isi Pengumuman</label>
       					<textarea name="isi_pengumuman" id="loko" rows="18" ><?php echo $raw['isi_pengumuman']; ?></textarea>

       				</div>

       				<div class="dwarn">
       					<div class="form-group">
       						<label>File Pendukung 1</label>
       						<select class="form-control"  name="file1" id="file1">
       							<?php
       							$dataa = $this->M_dataadmin->pilihdownload();
       							if ($raw['file1']==0){
       								echo "<option value=0 selected>- Pilih -</option>";
       								foreach($dataa->result_array() as $w) {
       									if ($raw['file1']==$w['id_download']){
       										?>
       										<option value="<?php echo $w['id_download'];?>" selected><?php echo $w['judul'];?></option>
       										<?php
       									}else{
       										?>
       										<option value="<?php echo $w['id_download'];?>"><?php echo $w['judul'];?></option>
       										<?php
       									}
       								}
       							}
       							else {
       								echo "<option value=0 >- Pilih -</option>";
       								foreach($dataa->result_array() as $w) {
       									if ($raw['file1']==$w['id_download']){
       										?>
       										<option value="<?php echo $w['id_download'];?>" selected><?php echo $w['judul'];?></option>
       										<?php
       									}else{
       										?>
       										<option value="<?php echo $w['id_download'];?>"><?php echo $w['judul'];?></option>
       										<?php
       									}
       								}
       							}
       							?>
       						</select>
       					</div>

       					<div class="form-group">
       						<label>File Pendukung 2</label>
       						<select class="form-control"  name="file2" id="file2">
       							<?php
       							$dataa = $this->M_dataadmin->pilihdownload();
       							if ($raw['file2']==0){
       								echo "<option value=0 selected>- Pilih -</option>";
       								foreach($dataa->result_array() as $w) {
       									if ($raw['file2']==$w['id_download']){
       										?>
       										<option value="<?php echo $w['id_download'];?>" selected><?php echo $w['judul'];?></option>
       										<?php
       									}else{
       										?>
       										<option value="<?php echo $w['id_download'];?>"><?php echo $w['judul'];?></option>
       										<?php
       									}
       								}
       							}
       							else {
       								echo "<option value=0 >- Pilih -</option>";
       								foreach($dataa->result_array() as $w) {
       									if ($raw['file2']==$w['id_download']){
       										?>
       										<option value="<?php echo $w['id_download'];?>" selected><?php echo $w['judul'];?></option>
       										<?php
       									}else{
       										?>
       										<option value="<?php echo $w['id_download'];?>"><?php echo $w['judul'];?></option>
       										<?php
       									}
       								}
       							}
       							?>
       						</select>
       					</div>

       					<div class="form-group">
       						<label>File Pendukung 3</label>
       						<select class="form-control"  name="file3" id="file3">
       							<?php
       							$dataa = $this->M_dataadmin->pilihdownload();
       							if ($raw['file3']==0){
       								echo "<option value=0 selected>- Pilih -</option>";
       								foreach($dataa->result_array() as $w) {
       									if ($raw['file3']==$w['id_download']){
       										?>
       										<option value="<?php echo $w['id_download'];?>" selected><?php echo $w['judul'];?></option>
       										<?php
       									}else{
       										?>
       										<option value="<?php echo $w['id_download'];?>"><?php echo $w['judul'];?></option>
       										<?php
       									}
       								}
       							}
       							else {
       								echo "<option value=0 >- Pilih -</option>";
       								foreach($dataa->result_array() as $w) {
       									if ($raw['file3']==$w['id_download']){
       										?>
       										<option value="<?php echo $w['id_download'];?>" selected><?php echo $w['judul'];?></option>
       										<?php
       									}else{
       										?>
       										<option value="<?php echo $w['id_download'];?>"><?php echo $w['judul'];?></option>
       										<?php
       									}
       								}
       							}
       							?>
       						</select>
       					</div>

       				</div>
       			</div>
       		</div>


       	</div>

       	<div class="col-lg-4">
       		<div class="panel panel-default">
       			<div class="panel-heading">
       				<i class="fa fa-bell fa-fw"></i> Gambar
       			</div>
       			<div class="panel-body">
       				<div class="form-group">
       					<label>Foto Pengumuman</label>
       					<?
       					if ($raw['gambar']!=''){
       						$pathi=$raw['tanggal_pengumuman'];
       						$pathi=str_replace("-","/",$pathi); ?>
       						<img src="<?php echo base_url(); ?>../foto_pengumuman/<?php echo $pathi; ?>/small_<?php echo $raw['gambar']; ?>" width="100%">
       						<?php } ?> <br> <br>
       						<input type="file" name="imagefile">
       						<br><br>
       					</div>

       					<div class="form-group">
       						<label>Keterangan</label>
       						<textarea class="form-control" name="keterangan"  rows="4"><?php echo $raw['keterangan']; ?></textarea>
       					</div>
       					<div class="clearfix"></div>
       					<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
       						<div class="clearfix"></div>
       						<center>
       							<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
       								<i class="ace-icon fa fa-floppy-o bigger-160"></i> Simpan
       							</button>

       							<a href="<?php echo base_url(); ?>pengumuman" class="btn btn-app btn-warning  btn-xs  radius-4">
       								<i class="ace-icon fa fa-times bigger-160"></i> Batal
       							</a>
       						</center>
       					</div>
       				</div>
       			</div>
       		</div>
       	</div>
       <?php } ?>
       <?php echo form_close(); ?>
   <?  }  ?>
