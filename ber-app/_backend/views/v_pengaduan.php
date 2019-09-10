<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?>
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Pengaduan Online</h1>
                </div>
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Pengaduan Online Terbaru
                        </div>
                        <div class="panel-body">
						<br>
					 <center>
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>
						<!--
						<a href="<?php echo base_url(); ?>pengaduan/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
						</a>
						-->
						<a href="<?php echo base_url(); ?>pengaduan" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-refresh bigger-160"></i> Refresh
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
                                            <th>Judul Pengaduan</th>
                                            <th>Dikirim</th>
											<th>Tgl. Posting</th>
											<th>Publish</th>
											<th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

	<?php
	$no=1;
	foreach($artikel as $key => $row){
		$judul=seo_link($row['judulpengaduan']);
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_pengaduan']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
            <td><a class="bold" href="<?php echo base_url(); ?>pengaduan/edit/<?php echo $row['id_pengaduan']."/".$judul."/";?>"> <?php echo $row['judulpengaduan']; ?> </a></td>
			<td><?php echo $row['nama']; ?><br><?php echo $row['email']; ?></td>
			<td><?php echo tgl_indo($row['tanggal']); ?></td>
			<td>
			<?php if ($row['jangkrik']=='Y') {?>
				<a href="<?php echo base_url(); ?>pengaduan/nonaktif/<?php echo $row['id_pengaduan']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>pengaduan/aktif/<?php echo $row['id_pengaduan']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?>
			</td>
            <td class="center">
				<a href="<?php echo base_url(); ?>pengaduan/edit/<?php echo $row['id_pengaduan']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
                </a>

				<a href="<?php echo base_url(); ?>pengaduan/delete/<?php echo $row['id_pengaduan']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>

		<?php
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
                    <h1 class="page-header">Edit Pengaduan Online</h1>
                </div>
            </div>
	<?php echo form_open_multipart('pengaduan/a_edit'); ?>

		<?php
		$edit = $this->M_dataadmin->editpengaduan($this->uri->segment(3,0));
		foreach($edit->result_array() as $raw)
		{
		$a=substr($raw['tanggal'], 0,4);
		$b=substr($raw['tanggal'], 5,2);
		$c=substr($raw['tanggal'], 8,9);
		$tanggal=$c.'-'.$b.'-'.$a;
		?>
		<input type="hidden" name="id" value="<?php echo $raw['id_pengaduan']; ?>">
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Pengaduan Online
                        </div>
                        <div class="panel-body">

						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>pengaduan" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>


							<div class="form-group">
								<label>Judul Pengaduan</label>
								<input  class="form-control" type="text" name="judulpengaduan" value="<?php echo $raw['judulpengaduan']; ?>">
							</div>
							<div class="form-group">
								<label>Nama Pengirim</label>
								<input  class="form-control" type="text" name="nama" value="<?php echo $raw['nama']; ?>">
							</div>
			<div class="form-group">
								<label>Email Pengirim</label>
								<input  class="form-control" type="text" name="email" value="<?php echo $raw['email']; ?>">
							</div>
			<div class="form-group">
								<label>Alamat Pengirim</label>
								<input  class="form-control" type="text" name="alamat" value="<?php echo $raw['alamat']; ?>">
							</div>
<div class="form-group">
								<label>Lembaga yang Diadukan</label>
								<input  class="form-control" type="text" name="lembaga" value="<?php echo $raw['lembaga']; ?>">
							</div>

		<div class="form-group">
						<label>Tanggal Pengaduan</label>
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
							<div class="form-group">
								<label>Jam Pengaduan</label>
								<input  class="form-control" type="text" name="jam" value="<?php echo $raw['jam']; ?>" style="width:100px;">
							</div>

		<div class="form-group">
            <label>Publish Pengaduan</label>
		<?php if ($raw['aktif']=='Y'){?>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios1" value="Y" checked>Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios2" value="N">Tidak </label> </div>
		<?php } else {?>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios1" value="Y">Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios2" value="N" checked>Tidak </label> </div>
		<?php } ?>
        </div>
	<div class="dwarn">
		<div class="form-group">
			<label>Isi Pengaduan</label>
			<textarea class="form-control" rows="6"  name="pesan" ><?php echo $raw['pesan']; ?></textarea>
		</div>
	</div>
	<div class="dwarn">
		<div class="form-group">
			<label>Jawaban/Respon</label>
			<textarea class="form-control" rows="6"  name="jawaban" ><?php echo $raw['jawaban']; ?></textarea>
		</div>
	</div>

<div class="form-group">
	<label>Keterangan</label>
	<textarea class="form-control" rows="4"  name="keterangan" ><?php echo $raw['keterangan']; ?></textarea>
</div>


						<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>pengaduan" class="btn btn-app btn-warning  btn-xs  radius-4">
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
