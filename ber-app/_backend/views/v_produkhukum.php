<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?>
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Produk Hukum</h1>
                </div>
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Produk Hukum Terbaru
                        </div>
                        <div class="panel-body">
<!--		 <form action="<?php echo base_url(); ?>produkhukum/a_deleteall" method="POST">	-->
	<?php echo form_open_multipart('produkhukum/deleteall'); ?>
						<br>
					 <center>
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>

						<a href="<?php echo base_url(); ?>produkhukum/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
						</a>

						<a href="<?php echo base_url(); ?>produkhukum" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                                            <th width="30%">Judul</th>
                                            <th>Tentang</th>
											<th>Kategori</th>
											<th>Tahun</th>
											<th>Publish</th>
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
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_produkhukum']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
            <td><a class="bold" href="<?php echo base_url(); ?>produkhukum/edit/<?php echo $row['id_produkhukum']."/".$judul."/";?>"> <?php echo $row['judul']; ?> </a></td>
			<td>
			<?php if ($row['metode_link']=='1') {?>
				<a href="<?php echo base_url(); ?>../file/<?php echo $row['nama_file'];?>" >Download </a>
			<?php } else {?>
				<a href="<?php echo $row['link_file'];?>" >Download </a>
			<?php } ?>
			</td>
			<td><?php echo $row['nama_katprodukhukum']; ?></td>
			<td><?php echo $row['tahun']; ?></td>
			<td><?php if ($row['jangkrik']=='Y') {?>
				<a href="<?php echo base_url(); ?>produkhukum/nonaktif/<?php echo $row['id_produkhukum']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>produkhukum/aktif/<?php echo $row['id_produkhukum']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?> </td>
            <td class="center"><?php echo $row['nama_lengkap']; ?></td>
            <td class="center">
				<a href="<?php echo base_url(); ?>produkhukum/edit/<?php echo $row['id_produkhukum']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
                </a>

				<a href="<?php echo base_url(); ?>produkhukum/delete/<?php echo $row['id_produkhukum']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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


<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>

 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Produk Hukum</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Produk Hukum
                        </div>
                        <div class="panel-body">


<form method="POST" id="produkhukum" name="produkhukum" action="<?php echo base_url(); ?>produkhukum/a_simpan"  enctype="multipart/form-data" onsubmit="return validasi(this)">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>produkhukum" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                                            <label>Publish Produk Hukum</label>
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
								<label>Judul Produk Hukum</label>
								<input  class="form-control" type="text" name="judul" value="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
							</div>
					 <div class="form-group">
								<label>Kategori</label>
								<select class="form-control"  name="kategori" id="kategori">
								<option value="0" selected>- Pilih -</option>
						<?php
						$dataa = $this->M_dataadmin->pilihkatprodukhukum();
						foreach($dataa->result_array() as $r) {
						?>
<option  value="<?php echo $r['id_katprodukhukum'];?>"><?php echo $r['nama_katprodukhukum'];?></option>
						<?php } ?>
                                </select>
							</div>
							<div class="form-group">
								<label>Tahun</label> <br>
								<?php
								$thn_sekarang = date("Y");
								combothn2(2005,$thn_sekarang,'tahun',$thn_sekarang);
								?>

							</div>
			<div class="clearfix"></div>

			<div class="form-group">
                                            <label>Metode Link</label>
                                           <select  class="form-control" name="metode" id="drop">
					<option value=0 Selected> -- Pilih Metode Link--
    <option value='1' >Upload File</option>
    <option value='2' >Share File</option>

</select>
                                        </div>


		<!-- POSISI IKLAN TAMPIL -->
		 <div id="linkmethod"></div>
		 <div class="clearfix"></div>
		<!-- POSISI IKLAN TAMPIL -->

		<script type='text/javascript'>
$('#drop').change(function() {
    if ($(this).val() == '1') {
$('#linkmethod').load('<?php echo base_url()?>produkhukum/inputfile');
    }
    else if ($(this).val() == '2') {
$('#linkmethod').load('<?php echo base_url()?>produkhukum/custom');
    }
    else {
$('#linkmethod').load('<?php echo base_url()?>produkhukum/custom');
    }
});
</script>



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

						<a href="<?php echo base_url(); ?>produkhukum" class="btn btn-app btn-warning  btn-xs  radius-4">
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

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>

 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Produk Hukum</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Produk Hukum
                        </div>
                        <div class="panel-body">

	<form method="POST" id="produkhukum" name="produkhukum" action="<?php echo base_url(); ?>produkhukum/a_edit"  enctype="multipart/form-data" onsubmit="return validasi(this)">
		<?php
		$edit = $this->M_dataadmin->editprodukhukum($this->uri->segment(3,0));
		foreach($edit->result_array() as $raw)
		{
		$photopath = str_replace('-', '/', $raw['tanggal_modif']);
		$a=substr($raw['tgl_upload'], 0,4);
		$b=substr($raw['tgl_upload'], 5,2);
		$c=substr($raw['tgl_upload'], 8,9);
		$tanggal=$c.'-'.$b.'-'.$a;

		?>
						<input type="hidden" name="id" value="<?php echo $raw['id_produkhukum']; ?>">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>produkhukum" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
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
            <label>Publish Produk Hukum</label>
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
				<label>Judul Produk Hukum</label>
				<input  class="form-control" type="text" name="judul" value="<?php echo $raw['judul']; ?>">
			</div>

	<div class="form-group">
								<label>Kategori</label>
								<select class="form-control"  name="kategori" id="kategori">
						<?php
						$dataa = $this->M_dataadmin->pilihkatprodukhukum();
						if ($raw['id_katprodukhukum']==0){
						echo "<option value=0 selected>- Pilih -</option>";
						}
						foreach($dataa->result_array() as $raaw) {
						if ($raw['id_katprodukhukum']==$raaw['id_katprodukhukum']){ ?>
							<option  value="<?php echo $raaw['id_katprodukhukum'];?>" selected><?php echo $raaw['nama_katprodukhukum'];?></option>
						<?php } else {?>
							<option  value="<?php echo $raaw['id_katprodukhukum'];?>"><?php echo $raaw['nama_katprodukhukum'];?></option>
						<?php }
						}
						?>
                                </select>
							</div>

<div class="form-group">
				<label>Tahun</label> <br>
				<?php
								$thn_sekarang = date("Y");
								combothn2(2005,$thn_sekarang,'tahun',$raw['tahun']);
								//combothn2($thn_sekarang-70,$thn_sekarang+2,'thn_lahir',$get_thn2);
								?>
			</div>

	<div class="form-group">
		<label>Pilih Metode Link</label>
			<select class="form-control"  name="metode" id="drop">
			<?php
				if ($raw['metode_link']==1){
					echo "<option value='0'>- Pilih Metode Link -</option>
					<option value='1' selected>Upload File</option>
					<option value='2' >Share Link</option>";
				}
				elseif ($raw['metode_link']==2){
					echo "<option value='0'>- Pilih Metode Link -</option>
					<option value='1' >Upload File</option>
					<option value='2' selected>Share Link</option>";
				}
				else {
					echo "<option value='0' selected>- Pilih Metode Link -</option>
					<option value='1' >Upload File</option>
					<option value='2' >Share Link</option>";
				}
	?>
			</select>
		</div>


	<div id="linkmethod" style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
<label>Link Produk Hukum</label>
		<?php
		if ($raw['metode_link']==1){
			if ($raw['nama_file']!='') {
			$pathdelete=str_replace("-","/",$raw['tanggal_modif']);
			?><br>
			<a target="_blank" href="<?php echo base_url(); ?>../file/<?php echo $pathdelete?>/<?php echo $raw['nama_file']; ?>"><?php echo $raw['nama_file']; ?> </a>
			<div class="clearfix"></div>
			<a href="<?php echo base_url(); ?>produkhukum/hapusfile/<?php echo $this->uri->segment(3,0); ?>" class="btn btn-danger"  onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus File</a>
			<?php
			}
			else {
			?>
			<input type="file" name="imagefile" />
			<?php
			}
		}
		else {
			if ($raw['link_file']!='') {
			?>
				<input type="text"  class="form-control" name="link_sub" value="<?php echo $raw['link_file']; ?>" /><br>

				<a href="<?php echo base_url(); ?>produkhukum/hapuslink/<?php echo $this->uri->segment(3,0); ?>"  class="btn btn-danger" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus Link</a>

			<?php
			}
			else {
			?>
				<input type="text" name="link_sub"  class="form-control" />
			<?php
			}
		}
	?>
		</div>

	<script type='text/javascript'>
$('#drop').change(function() {
    if ($(this).val() == '1') {
$('#linkmethod').load('<?php echo base_url()?>produkhukum/inputfile');
    }
    else if ($(this).val() == '2') {
$('#linkmethod').load('<?php echo base_url()?>produkhukum/custom');
    }
    else {
$('#linkmethod').load('<?php echo base_url()?>produkhukum/custom');
    }
});
</script>

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

						<a href="<?php echo base_url(); ?>produkhukum" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						</div>




















						  <?php } ?>
						<?php echo form_close(); ?>
						</div>
                    </div>

            </div>
		<?php
}
?>
