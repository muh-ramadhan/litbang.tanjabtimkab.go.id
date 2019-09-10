<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?>
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Image Slide</h1>
                </div>
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Image Slide Terbaru
                        </div>
                        <div class="panel-body">
<!--		 <form action="<?php echo base_url(); ?>imageslide/a_deleteall" method="POST">	-->
	<?php echo form_open_multipart('imageslide/deleteall'); ?>
						<br>
					 <center>
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>

						<a href="<?php echo base_url(); ?>imageslide/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
						</a>

						<a href="<?php echo base_url(); ?>imageslide" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                                            <th>Judul Image Slide</th>
                                            <th>Gambar</th>
                                            <th>Keterangan</th>
											<th>Urutan</th>
											<th>Aktif</th>
											<th>Tgl. Posting</th>
											<th>Operator</th>
											<th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

	<?php
	$no=1;
	foreach($artikel as $key => $row){
		$judul=seo_link($row['judul']);
		$a=substr($row['tgl_upload'], 0,4);
		$b=substr($row['tgl_upload'], 5,2);
		$c=substr($row['tgl_upload'], 8,9);
		$tanggal=$c.'/'.$b.'/'.$a;
		$photopath = str_replace('-', '/', $row['tgl_modif']);
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_imageslide']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
            <td><a class="bold" href="<?php echo base_url(); ?>imageslide/edit/<?php echo $row['id_imageslide']."/".$judul."/";?>"> <?php echo $row['judul']; ?> </a></td>
			<td>
			<?php
			if ($row['gambar']!='') {
			?>
				<img src="../foto_imageslide/<?php echo $photopath;?>/small_<?php echo $row['gambar']; ?>" width="300">
			<?php
			}
			else {
				echo "Gambar Belum Ada";
			}
			?>
			</td>
			<td class="center"><?php echo $row['keterangan']; ?></td>
			<td class="center"><center><input value="<?php echo $row['urutan']; ?>" type="text" name="urutan[]" style="width:25px;text-align:center;"></center></td>
			<td>
			<?php if ($row['jangkrik']=='Y') {?>
				<a href="<?php echo base_url(); ?>imageslide/nonaktif/<?php echo $row['id_imageslide']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>imageslide/aktif/<?php echo $row['id_imageslide']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?>
			</td>
			<!--<td></td>-->
			<td> <?php echo tgl_indo($row['tgl_upload']); ?></td>

            <td class="center"><?php echo $row['nama_lengkap']; ?></td>
            <td class="center">
				<a href="<?php echo base_url(); ?>imageslide/edit/<?php echo $row['id_imageslide']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
                </a>

				<a href="<?php echo base_url(); ?>imageslide/delete/<?php echo $row['id_imageslide']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>

 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Image Slide</h1>
                </div>
            </div>
<?php echo form_open_multipart('imageslide/a_simpan'); ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Image Slide
                        </div>
                        <div class="panel-body">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>imageslide" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
						<div class="form-group">
						<label>Tanggal Image Slide</label>
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
                                            <label>Publish Image Slide</label>
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
		<label>Judul Image Slide</label>
		<input  class="form-control" type="text" name="judul" value="">
    </div>
	<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control" rows="3"  name="keterangan" > </textarea>
							</div>
</div>
                    </div>
                </div>
				<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Penulis & Foto
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
								<label>Foto Image Slide</label>
								<input type="file" name="imagefile">
							</div>
						<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>imageslide" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                    <h1 class="page-header">Edit Image Slide</h1>
                </div>
            </div>
	<?php echo form_open_multipart('imageslide/a_edit'); ?>
<?php
		$edit = $this->M_dataadmin->editimageslide($this->uri->segment(3,0));
		foreach($edit->result_array() as $raw)
		{
		$photopath = str_replace('-', '/', $raw['tgl_modif']);
		$a=substr($raw['tgl_upload'], 0,4);
		$b=substr($raw['tgl_upload'], 5,2);
		$c=substr($raw['tgl_upload'], 8,9);
		$tanggal=$c.'-'.$b.'-'.$a;
		?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Image Slide
                        </div>
                        <div class="panel-body">

						<input type="hidden" name="id" value="<?php echo $raw['id_imageslide']; ?>">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>imageslide" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
						<div class="form-group">
						<label>Tanggal Image Slide</label>
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
            <label>Publish Image Slide</label>
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
								<label>Judul Image Slide</label>
								<input  class="form-control" type="text" name="judul" value="<?php echo $raw['judul']; ?>">
							</div>
				<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control" rows="3"  name="keterangan" ><?php echo $raw['keterangan']; ?></textarea>
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
								<label>Foto Image Slide</label>
								<?
								if ($raw['gambar']!=''){
									$pathi=$raw['tgl_modif'];
									$pathi=str_replace("-","/",$pathi); ?>
									<img src="<?php echo base_url(); ?>../foto_imageslide/<?php echo $pathi; ?>/small_<?php echo $raw['gambar']; ?>" width="100%">
								<?php } ?> <br> <br>
								<input type="file" name="imagefile">
								<br><br>
							</div>
							<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>imageslide" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						</div>

                        </div>
                    </div>
                </div>
            </div>
		<?  } ?>
	<?php echo form_close(); ?>
<?php  } ?>