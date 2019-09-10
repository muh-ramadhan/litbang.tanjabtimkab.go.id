<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
	?>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#buttonurut').click(function(){
				$('.case').attr("checked", "checked");
				$('#deleturut').attr('action', '<?php echo base_url(); ?>menu/urutall');
			});

			$('#buttondelet').click(function(){
				$('#deleturut').attr('action', '<?php echo base_url(); ?>menu/deleteall');
			});

		});
	</script>
	<link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Data Menu Front-End</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-th-list fa-fw"></i> Menu Front-End Terbaru
				</div>
				<div class="panel-body">
					<!--		 <form action="<?php echo base_url(); ?>menu/a_deleteall" method="POST">	-->
						<?php //echo form_open_multipart('menu/deleteall'); ?>
						<form id="deleturut" action="" method="POST">
							<br>
							<center>
								<a class="btn btn-app btn-light btn-xs radius-4">
									<i class="ace-icon fa fa-home bigger-160"></i> Home
								</a>

								<a href="<?php echo base_url(); ?>menu/add" class="btn btn-app btn-primary btn-xs radius-4">
									<i class="ace-icon fa fa-plus-circle bigger-160"></i> Tambah
								</a>

								<a href="<?php echo base_url(); ?>menu" class="btn btn-app btn-warning  btn-xs  radius-4">
									<i class="ace-icon fa fa-refresh bigger-160"></i> Segarkan
								</a>
								<button type="submit"  id="buttondelet" class="btn btn-app btn-inverse btn-xs radius-4" style="width:140px;">
									<i class="ace-icon fa  fa-trash-o bigger-160"></i> Hapus Pilihan
								</button>
								<button type="submit" id="buttonurut" name="submit" class="btn btn-app btn-xs radius-4" style="width:140px; color:#4CAF50; ">
									<i class="ace-icon fa fa-list bigger-160"></i> Simpan Urutan
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
													<th width="30%">Nama Menu</th>
													<th>Posisi</th>
													<th>CSS Custom</th>
													<th>Urutan</th>
													<th>Link</th>
													<th>Aktif</th>
													<th>Operator</th>
													<th>Edit</th>
												</tr>
											</thead>
											<tbody>

												<?php
												$no=1;
												foreach($artikel as $key => $row){
													$judul=seo_link($row['nama_menu']);
													$a=substr($row['tgl_posting'], 0,4);
													$b=substr($row['tgl_posting'], 5,2);
													$c=substr($row['tgl_posting'], 8,9);
													$tanggal=$c.'/'.$b.'/'.$a;
													?>
													<tr class="odd">
														<td><?php echo $no; ?></td>
														<td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_menu']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
														<td><a class="bold" href="<?php echo base_url(); ?>menu/edit/<?php echo $row['id_menu']."/".$judul."/";?>"> <?php echo $row['nama_menu']; ?> </a></td>
			<!--
			<td>
			<?php if ($row['metode_link']=='1') {?>
				<a href="<?php echo base_url(); ?>../file/<?php echo $row['nama_file'];?>" >Download </a>
			<?php } else {?>
				<a href="<?php echo $row['link_file'];?>" >Download </a>
			<?php } ?>
			</td>
		-->
		<td> <?php echo $row['nama_posisi']; ?> </td>
		<td> <?php echo $row['css']; ?> </td>
		<td><input value="<?php echo $row['urutan']; ?>" type="text" name="urutan[]" size="5" style="width:25px;text-align:center;"> </td>
		<td><?php echo $row['link']; ?></td>
		<td>
			<?php if ($row['aktif']=='Y') {?>
				<a href="<?php echo base_url(); ?>menu/nonaktif/<?php echo $row['id_menu']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>menu/aktif/<?php echo $row['id_menu']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?>
		</td>
		<td class="center"><?php echo $row['nama_lengkap']; ?></td>
		<td class="center">
			<a href="<?php echo base_url(); ?>menu/edit/<?php echo $row['id_menu']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
				<i class="fa fa-pencil"></i> Edit
			</a>

			<a href="<?php echo base_url(); ?>menu/delete/<?php echo $row['id_menu']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
				<i class="fa fa-times"></i> Hapus
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

<?php } else if ($this->uri->segment(2,0)=='add') { ?>
	<?php $tanggal=date('d-m-Y'); ?>
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
			$("#metode").change(function(){
				var prop = $("#metode").val();
				$.ajax({
					url: "<?php echo base_url()?>menu/linkmenu",
					type: 'POST',
					data:  $("#menu").serialize(),
					cache: false,
					success: function(msg){
						$("#isian").html(msg);
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
			<h1 class="page-header">Tambah Menu Front-End</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-wrench fa-fw"></i> Tambah Menu Front-End
				</div>
				<div class="panel-body">


					<form method="POST" id="menu" name="menu" action="<?php echo base_url(); ?>menu/a_simpan"  enctype="multipart/form-data" onsubmit="return validasi(this)">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
							<center>
								<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
									<i class="ace-icon fa fa-floppy-o bigger-160"></i> Simpan
								</button>

								<a href="<?php echo base_url(); ?>menu" class="btn btn-app btn-warning  btn-xs  radius-4">
									<i class="ace-icon fa fa-times bigger-160"></i> Batal
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
							<label>Publish Menu Front-End</label>
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
						<label>Nama Menu</label>
						<input  class="form-control" type="text" name="nama_menu" value="">
					</div>
					<div class="clearfix"></div>
					<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;width:300px;">
						<div class="form-group">
							<label>CSS Custom Prefix</label>
							<input  class="form-control" type="text" name="css" value="">
							<p class="help-block"><b>Font Awesome Icons </b><i>Ex:  fa-th-list, fa-glass, fa-search</i></p>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label>Pilih Posisi Menu</label>
						<select class="form-control"  name="posisi" id="posisi">
							<option value="0" selected>- Pilih Posisi Menu -</option>
							<?php
							$dataa = $this->M_dataadmin->pilihposisimenu();
							foreach($dataa->result_array() as $raw) {
								?>
								<option  value="<?php echo $raw['id_posisi'];?>"><?php echo $raw['nama_posisi'];?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Pilih Link Menu</label>
						<select class="form-control" name="metode" id="metode">
							<option value="0" selected>- Pilih Link Menu -</option>
							<?php
							$dataa = $this->M_dataadmin->pilihlinkmenu();
							foreach($dataa->result_array() as $rew) {
								?>
								<option  value="<?php echo $rew['id_link'];?>"><?php echo $rew['nama_link'];?></option>
							<?php } ?>
						</select>
					</div>
					<div class="clearfix"></div>
					<div id="isian" style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
					</div>
					<div class="clearfix"></div>
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

							<a href="<?php echo base_url(); ?>menu" class="btn btn-app btn-warning  btn-xs  radius-4">
								<i class="ace-icon fa fa-times bigger-160"></i> Cancel
							</a>
						</center>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	<? } else if ($this->uri->segment(2,0)=='edit') { ?>
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
				$("#metode").change(function(){
					var prop = $("#metode").val();
					$.ajax({
						url: "<?php echo base_url()?>menu/linkmenu",
						type: 'POST',
						data:  $("#menu").serialize(),
						cache: false,
						success: function(msg){
							$("#isian").html(msg);
						}
					});
				});
			});
		</script>
		<!----------------------- E: JAVASCRIPT ---------------------------->
		<!-- Social Buttons CSS -->
		<link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
		<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>
		<script src="<?php echo base_url()?>style/js/datepick.js"></script>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit Menu Front-End</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-wrench fa-fw"></i>Edit Menu Front-End
					</div>
					<div class="panel-body">

						<form method="POST" id="menu" name="menu" action="<?php echo base_url(); ?>menu/a_edit"  enctype="multipart/form-data" onsubmit="return validasi(this)">
							<?php
							$edit = $this->M_dataadmin->editmenu($this->uri->segment(3,0));
							foreach($edit->result_array() as $raw)
							{
								$a=substr($raw['tgl_posting'], 0,4);
								$b=substr($raw['tgl_posting'], 5,2);
								$c=substr($raw['tgl_posting'], 8,9);
								$tanggal=$c.'-'.$b.'-'.$a;

								?>
								<input type="hidden" name="id" value="<?php echo $raw['id_menu']; ?>">
								<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
									<center>
										<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
											<i class="ace-icon fa fa-floppy-o bigger-160"></i> Simpan
										</button>

										<a href="<?php echo base_url(); ?>menu" class="btn btn-app btn-warning  btn-xs  radius-4">
											<i class="ace-icon fa fa-times bigger-160"></i> Batal
										</a>
									</center>
									<div class="clearfix"></div>
								</div>
								<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
									<div class="form-group">
										<label>Tanggal Posting</label>
										<div class="input-group date" id="datetimepicker1" style="width:180px;" >
											<input id="disabledInput" type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" disabled>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label>Publish Menu Front-End</label>
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
								<label>Nama Menu</label>
								<input  class="form-control" type="text" name="nama_menu" value="<?php echo $raw['nama_menu']; ?>">
							</div>
							<div class="clearfix"></div>
							<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;width:300px;">
								<div class="form-group">
									<label>CSS Custom Prefix</label>
									<input  class="form-control" type="text" name="css" value="<?php echo $raw['css']; ?>">
									<p class="help-block"><b>Font Awesome Icons </b><i>Ex:  fa-th-list, fa-glass, fa-search</i></p>
								</div>
							</div>
							<div class="clearfix"></div>

							<div class="form-group">
								<label>Pilih Posisi Menu</label>
								<select class="form-control"  name="posisi" id="posisi">
									<?php
									$dataa = $this->M_dataadmin->pilihposisimenu();
									if ($raw['id_position']==0){
										echo "<option value=0 selected>- Pilih Posisi Menu -</option>";
									}
									foreach($dataa->result_array() as $raaw) {
										if ($raw['id_position']==$raaw['id_posisi']){ ?>
											<option  value="<?php echo $raaw['id_posisi'];?>" selected><?php echo $raaw['nama_posisi'];?></option>
										<?php } else {?>
											<option  value="<?php echo $raaw['id_posisi'];?>"><?php echo $raaw['nama_posisi'];?></option>
										<?php }
									}
									?>
								</select>
							</div>
							<?php
							if ($raw['link']!=''){  ?>
								<label>Link Menu</label>
								<input value="<?php echo $raw['link']; ?>" class="form-control"  type="text" name="link" >
								<div class="clearfix"></div>
								<div style="*font-weight:bold;font-size:12px;color:red;font-style:italic;margin:10px 0;">
								[Untuk Mengganti Link Hapus Link Sebelumnya]</div>
								<div class="clearfix"></div>
								<a href="<?php echo base_url(); ?>menu/hapuslink/<?php echo $raw['id_menu'];?>" class="btn btn-block btn-social btn-pinterest" style="display:inline;" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')"> <i class="fa fa-trash-o"></i> Hapus Link </a>
								<div class="clearfix"></div><br>
							<?php }
							else {
								?>
								<div class="form-group">
									<label>Pilih Link Menu</label>
									<select class="form-control" name="metode" id="metode">
										<option value="0" selected>- Pilih Link Menu -</option>
										<?php
										$dataa = $this->M_dataadmin->pilihlinkmenu();
										foreach($dataa->result_array() as $rew) {
											?>
											<option  value="<?php echo $rew['id_link'];?>"><?php echo $rew['nama_link'];?></option>
										<?php } ?>
									</select>
								</div>
								<div class="clearfix"></div>
								<div id="isian" style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
								</div>
							<?php } ?>
							<div class="form-group">
								<label>Keterangan </label>
								<textarea class="form-control" rows="6"  name="keterangan" ><?php echo $raw['keterangan']; ?></textarea>
							</div>
							<div class="clearfix"></div>
							<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
								<div class="clearfix"></div>
								<center>
									<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
										<i class="ace-icon fa fa-floppy-o bigger-160"></i> Simpan
									</button>
									<a href="<?php echo base_url(); ?>menu" class="btn btn-app btn-warning  btn-xs  radius-4">
										<i class="ace-icon fa fa-times bigger-160"></i> Batal
									</a>
								</center>
							</div>
						<?php } ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		<?php } ?>
