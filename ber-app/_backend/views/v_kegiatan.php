<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
	?>
	<!-- Social Buttons CSS -->
	<link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Data Jadwal Kegiatan</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-th-list fa-fw"></i> Jadwal Kegiatan Terbaru
				</div>
				<div class="panel-body">
					<br>
					<center>
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>
						<a href="<?php echo base_url(); ?>kegiatan/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Tambah
						</a>
						<a href="<?php echo base_url(); ?>kegiatan" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-refresh bigger-160"></i> Segarkan
						</a>
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
											<th>Nama Kegiatan</th>
											<th>Tgl. Kegiatan</th>
											<th>Perihal</th>
											<th>Tempat</th>
											<th>Publish</th>
											<th>Operator</th>
											<th>Edit</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no=1;
										foreach($artikel as $key => $row){
											$judul=seo_link($row['namakegiatan']);
											?>
											<tr class="odd">
												<td><?php echo $no; ?></td>
												<td>
													<center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_kegiatan']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center>
												</td>
												<td><a class="bold" href="<?php echo base_url(); ?>kegiatan/edit/<?php echo $row['id_kegiatan']."/".$judul."/";?>"><?php echo $row['namakegiatan']; ?></a></td>
												<td><?php echo tgl_indo($row['tgl_kegiatan']); ?></td>
												<td><?php echo $row['perihal']; ?></td>
												<td class="center"><?php echo $row['tempat']; ?></td>
												<td>
													<?php if ($row['jangkrik']=='Y') {?>
														<a href="<?php echo base_url(); ?>kegiatan/nonaktif/<?php echo $row['id_kegiatan']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
													<?php } else {?>
														<a href="<?php echo base_url(); ?>kegiatan/aktif/<?php echo $row['id_kegiatan']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
													<?php } ?>
												</td>
												<td class="center"><?php echo $row['nama_lengkap']; ?></td>
												<td class="center">
													<a href="<?php echo base_url(); ?>kegiatan/edit/<?php echo $row['id_kegiatan']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
														<i class="fa fa-pencil"></i> Edit
													</a>

													<a href="<?php echo base_url(); ?>kegiatan/delete/<?php echo $row['id_kegiatan']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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
						</div>
					</div>
				</div>
			</div>

		<?php } else if ($this->uri->segment(2,0)=='add') { ?>
			<?php $tanggal=date('d-m-Y'); ?>
			<link rel="stylesheet" href="<?php echo base_url()?>style/css/tag.css">

			<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

			<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
			<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

			<script src="<?php echo base_url()?>style/js/datepick.js"></script>

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Tambah Jadwal Kegiatan</h1>
				</div>
			</div>
			<?php echo form_open_multipart('kegiatan/a_simpan'); ?>
			<div class="row">
				<div class="col-lg-10">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Jadwal Kegiatan
						</div>
						<div class="panel-body">
							<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
								<center>
									<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
										<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
									</button>

									<a href="<?php echo base_url(); ?>kegiatan" class="btn btn-app btn-warning  btn-xs  radius-4">
										<i class="ace-icon fa fa-times bigger-160"></i> Cancel
									</a>
								</center>
								<div class="clearfix"></div>
							</div>

							<div class="form-group">
								<label>Nama Kegiatan</label>
								<input  class="form-control" type="text" name="judul" value="">
							</div>
							<div class="form-group">
								<label>Perihal</label>
								<input  class="form-control" type="text" name="perihal" value="">
							</div>
							<div class="form-group">
								<label>Tempat</label>
								<input  class="form-control" type="text" name="tempat" value="">
							</div>

							<div class="form-group">
								<label>Tanggal Kegiatan</label>
								<div class="input-group date" id="datetimepicker1" style="width:180px;" >
									<input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label>Jam Kegiatan</label>
							<input  class="form-control" type="text" name="waktu" value="" style="width:100px;">
						</div>

						<div class="form-group">
							<label>Aktif</label>
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

						<div class="form-group">
							<label>Keterangan</label>
							<textarea class="form-control" rows="3"  name="keterangan" > </textarea>
						</div>
						<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
							<div class="clearfix"></div>
							<center>
								<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
									<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
								</button>

								<a href="<?php echo base_url(); ?>kegiatan" class="btn btn-app btn-warning  btn-xs  radius-4">
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
		<link rel="stylesheet" href="<?php echo base_url()?>style/css/tag.css">

		<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

		<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

		<script src="<?php echo base_url()?>style/js/datepick.js"></script>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit Jadwal Kegiatan</h1>
			</div>
		</div>
		<?php echo form_open_multipart('kegiatan/a_edit'); ?>

		<?php
		$edit = $this->M_dataadmin->editkegiatan($this->uri->segment(3,0));
		foreach($edit->result_array() as $raw)
		{
			$a=substr($raw['tgl_kegiatan'], 0,4);
			$b=substr($raw['tgl_kegiatan'], 5,2);
			$c=substr($raw['tgl_kegiatan'], 8,9);
			$tanggal=$c.'-'.$b.'-'.$a;
			?>
			<input type="hidden" name="id" value="<?php echo $raw['id_kegiatan']; ?>">
			<div class="row">
				<div class="col-lg-10">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Jadwal Kegiatan
						</div>
						<div class="panel-body">

							<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
								<center>
									<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
										<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
									</button>

									<a href="<?php echo base_url(); ?>kegiatan" class="btn btn-app btn-warning  btn-xs  radius-4">
										<i class="ace-icon fa fa-times bigger-160"></i> Cancel
									</a>
								</center>
								<div class="clearfix"></div>
							</div>


							<div class="form-group">
								<label>Nama Kegiatan</label>
								<input  class="form-control" type="text" name="judul" value="<?php echo $raw['namakegiatan']; ?>">
							</div>
							<div class="form-group">
								<label>Perihal</label>
								<input  class="form-control" type="text" name="perihal" value="<?php echo $raw['perihal']; ?>">
							</div>
							<div class="form-group">
								<label>Tempat</label>
								<input  class="form-control" type="text" name="tempat" value="<?php echo $raw['tempat']; ?>">
							</div>

							<div class="form-group">
								<label>Tanggal Kegiatan</label>
								<div class="input-group date" id="datetimepicker1" style="width:180px;" >
									<input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label>Jam Kegiatan</label>
							<input  class="form-control" type="text" name="waktu" value="<?php echo $raw['waktu']; ?>" style="width:100px;">
						</div>

						<div class="form-group">
							<label>Aktif</label>
							<?php if ($raw['aktif']=='Y'){?>
								<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios1" value="Y" checked>Ya </label> </div>
								<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios2" value="N">Tidak </label> </div>
							<?php } else {?>
								<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios1" value="Y">Ya </label> </div>
								<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios2" value="N" checked>Tidak </label> </div>
							<?php } ?>
						</div>

						<div class="form-group">
							<label>Keterangan</label>
							<textarea class="form-control" rows="3"  name="keterangan" ><?php echo $raw['jadwalkegiatan']; ?></textarea>
						</div>


						<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
							<div class="clearfix"></div>
							<center>
								<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
									<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
								</button>

								<a href="<?php echo base_url(); ?>kegiatan" class="btn btn-app btn-warning  btn-xs  radius-4">
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
	<?php
}
?>
