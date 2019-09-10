<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?>
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Weblink</h1>
                </div>
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Weblink Terbaru
                        </div>
                        <div class="panel-body">
<!--		 <form action="<?php echo base_url(); ?>weblink/a_deleteall" method="POST">	-->
	<?php echo form_open_multipart('weblink/deleteall'); ?>
						<br>
					 <center>
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>

						<a href="<?php echo base_url(); ?>weblink/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
						</a>

						<a href="<?php echo base_url(); ?>weblink" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                                            <th>Nama Link</th>
                                            <th>Link</th>
                                            <th>Gambar</th>
											<th>Aktif</th>
											<th>Operator</th>
											<th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

	<?php
	$no=1;
	foreach($artikel as $key => $row){
		$judul=seo_link($row['nama_weblink']);
		$a=substr($row['tgl_upload'], 0,4);
		$b=substr($row['tgl_upload'], 5,2);
		$c=substr($row['tgl_upload'], 8,9);
		$tanggal=$c.'/'.$b.'/'.$a;
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_weblink']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
            <td><a class="bold" href="<?php echo base_url(); ?>weblink/edit/<?php echo $row['id_weblink']."/".$judul."/";?>"> <?php echo $row['nama_weblink']; ?> </a></td>
			<td class="center"><?php echo $row['link']; ?></td>
			<td>
			<?php
			if ($row['gambar']!='') {
			?>
				<img src="../foto_weblink/<?php echo $photopath;?>/small_<?php echo $row['gambar']; ?>" width="300">
			<?php
			}
			else {
				echo "Gambar Belum Ada";
			}
			?>
			</td>
			<td>
			<?php if ($row['jangkrik']=='Y') {?>
				<a href="<?php echo base_url(); ?>weblink/nonaktif/<?php echo $row['id_weblink']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>weblink/aktif/<?php echo $row['id_weblink']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?>
			</td>
			<td class="center"><?php echo $row['nama_lengkap']; ?></td>
            <td class="center">
				<a href="<?php echo base_url(); ?>weblink/edit/<?php echo $row['id_weblink']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
                </a>

				<a href="<?php echo base_url(); ?>weblink/delete/<?php echo $row['id_weblink']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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
                    <h1 class="page-header">Tambah Weblink</h1>
                </div>
            </div>
<?php echo form_open_multipart('weblink/a_simpan'); ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Weblink
                        </div>
                        <div class="panel-body">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>weblink" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
						<div class="form-group">
						<label>Tanggal Weblink</label>
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
                                            <label>Publish Weblink</label>
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
		<label>Judul Weblink</label>
		<input  class="form-control" type="text" name="nama" value="">
    </div>
	<div class="form-group">
		<label>Link</label>
		<input  class="form-control" type="text" name="link" value="">
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
								<label>Logo Web</label>
								<input type="file" name="imagefile">
							</div>
						<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>weblink" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                    <h1 class="page-header">Edit Weblink</h1>
                </div>
            </div>
	<?php echo form_open_multipart('weblink/a_edit'); ?>
<?php
		$edit = $this->M_dataadmin->editweblink($this->uri->segment(3,0));
		foreach($edit->result_array() as $raw)
		{
		$a=substr($raw['tgl_upload'], 0,4);
		$b=substr($raw['tgl_upload'], 5,2);
		$c=substr($raw['tgl_upload'], 8,9);
		$tanggal=$c.'-'.$b.'-'.$a;
		?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Weblink
                        </div>
                        <div class="panel-body">

						<input type="hidden" name="id" value="<?php echo $raw['id_weblink']; ?>">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>weblink" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
						<div class="form-group">
						<label>Tanggal Weblink</label>
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
            <label>Publish Weblink</label>
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
		<label>Judul Weblink</label>
		<input  class="form-control" type="text" name="nama" value="<?php echo $raw['nama_weblink']; ?>">
	</div>
	<div class="form-group">
		<label>Link</label>
		<input  class="form-control" type="text" name="link" value="<?php echo $raw['link']; ?>">
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
								<label>Foto Weblink</label>
								<?
								if ($raw['gambar']!=''){
									$pathi=$raw['tgl_modif'];
									$pathi=str_replace("-","/",$pathi); ?>
									<img src="<?php echo base_url(); ?>../foto_weblink/<?php echo $pathi; ?>/small_<?php echo $raw['gambar']; ?>" width="100%">
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

						<a href="<?php echo base_url(); ?>weblink" class="btn btn-app btn-warning  btn-xs  radius-4">
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