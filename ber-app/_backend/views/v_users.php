<?php if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") { ?>
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Users / Pengguna</h1>
                </div>
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Users / Pengguna Terbaru
                        </div>
                        <div class="panel-body">
	<?php // echo form_open_multipart('users/deleteall'); ?>

	<br>
					 <center>
						<a href="<?php echo base_url(); ?>" id="buttondelet" class="btn btn-app btn-inverse btn-xs radius-4"  >
							<i class="ace-icon fa  fa-trash-o bigger-160"></i> Home
						</a>

						<a href="<?php echo base_url(); ?>users/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Tambah
						</a>

						<a href="<?php echo base_url(); ?>users" class="btn btn-app btn-warning  btn-xs  radius-4">
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

                                            <th width="30%">Username / Nama Lengkap</th>
											<th>Jabatan</th>
											<th>Level</th>
											<th>Tanggal Register</th>
											<th>Blokir</th>
											<th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

	<?php
	$no=1;
	foreach($artikel as $key => $row){
		$judul=seo_link($row['nama_lengkap']);
		$a=substr($row['tanggal'], 0,4);
		$b=substr($row['tanggal'], 5,2);
		$c=substr($row['tanggal'], 8,9);
		$tanggal=$c.'/'.$b.'/'.$a;
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td>Username: <?php echo $row['username']; ?><br><a class="bold" href="<?php echo base_url(); ?>users/edit/<?php echo $row['id_session'];?>"> <?php echo $row['nama_lengkap']; ?> </a></td>
			<td> <?php echo $row['jabatan']; ?>  </td>
			<td><?php echo $row['level']; ?></td>
			<td class="center"><?php echo $tanggal; ?></td>
			<td>
			<?php if ($row['blokir']=='Y') {?>
				<a href="<?php echo base_url(); ?>users/nonaktif/<?php echo $row['username']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>users/aktif/<?php echo $row['username']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?>
			</td>
			<td class="center">
				<a href="<?php echo base_url(); ?>users/edit/<?php echo $row['id_session'];?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
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
	<?php // echo form_close(); ?>
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
  if (form.username.value == 0){
    alert("Anda belum Mengisi Username.");
    form.username.focus();
    return (false);
  }
  if (form.password.value == 0){
    alert("Anda belum memilih Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>

<!----------------------- E: JAVASCRIPT ---------------------------->
<link rel="stylesheet" href="<?php echo base_url()?>style/css/tag.css">

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>

 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Users / Pengguna</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Users / Pengguna
                        </div>
                        <div class="panel-body">

<span style="color:#ff0000;text-align:center;"> <?=validation_errors()?> </span>
<?php echo form_open_multipart('users/add'); ?>
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>users" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>
			<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
						<div class="form-group">
						<label>Tanggal</label>
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<div class="form-group">
                                            <label>Blokir Users / Pengguna</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="blokir" id="optionsRadios1" value="Y" checked>Ya
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="blokir" id="optionsRadios2" value="N">Tidak
                                                </label>
                                            </div>
                                        </div>
			</div>


		<div class="clearfix"></div>
	<div style="border:1px solid #ec8585;background:#cc3333;color:#fff;border-radius:5px; padding:20px;margin-bottom:20px;">
		<div class="form-group">
			<label>Username</label>
			<input  class="form-control" type="text" id="username" name="username" value="<?php echo set_value('username'); ?>"  required="required" placeholder="Username">
			<span style="color:#d5ec14;font-style:italic;"><?php echo form_error('username'); ?> </span>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input  class="form-control" type="text" name="password" id="password" value="<?php echo set_value('password'); ?>"  required="required" placeholder="Password">
			<span style="color:#d5ec14;font-style:italic;"><?php echo form_error('password'); ?> </span>
		</div>
		<div class="form-group" style="width:260px;">
		<label>Level Pengguna</label>
		<select class="form-control"  name="level" id="level" required>
			<option value="" selected>- Level Pengguna -</option>
			<?php
			$dataa = $this->M_dataadmin->pilihlevel();
			foreach($dataa->result_array() as $raw) {
			?>
			<option  value="<?php echo $raw['namalevel'];?>"><?php echo $raw['namalevel'];?></option>
		<?php } ?>
		</select>
		<br><span style="color:#d5ec14;font-style:italic;"><?php echo form_error('level'); ?> </span>
		</div>
	</div>
		<div class="clearfix"></div>

	<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
		<div class="form-group">
		<label>Modul yang Diizinkan:</label> <div class="clearfix"></div>
		<?php
			$noo=1;
			$dataa = $this->M_dataadmin->pilihmodul();
			foreach($dataa->result_array() as $t) {
		?>
			<div style="
    padding: 1px 5px;
    margin: 0 8px 5px 0;">
			<input name="modul[]" id="d<?php echo $noo; ?>" type='checkbox' value="<?php echo $t['id_modul']; ?>" />
			<label for='d<?php echo $noo; ?>'><span></span><?php echo $t['nama_modul']; ?></label> </div>
		<?php
			$noo=$noo+1;
		} ?>
	</div>
	<div class="clearfix"></div>
	</div>

	<div class="form-group">
		<label>Nama Lengkap</label>
		<input  class="form-control" type="text" name="nama_lengkap" value="<?php echo set_value('nama_lengkap'); ?>">
		<span style="color:#ff0000;"><?php echo form_error('nama_lengkap'); ?> </span>
	</div>

	<div class="form-group">
		<label>Jabatan</label>
		<input  class="form-control" type="text" name="jabatan" value="<?php echo set_value('jabatan'); ?>">
		<span style="color:#ff0000;"><?php echo form_error('jabatan'); ?>
	</div>

	<div class="form-group">
		<label>Alamat</label>
		<input  class="form-control" type="text" name="alamat" value="<?php echo set_value('alamat'); ?>">
		<span style="color:#ff0000;"><?php echo form_error('alamat'); ?>
	</div>

	<div class="form-group">
		<label>E-Mail</label>
		<input  class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>">
		<span style="color:#ff0000;"><?php echo form_error('email'); ?>
	</div>

	<div class="form-group">
		<label>Kontak HP/Telpon</label>
		<input  class="form-control" type="text" name="kontak" value="<?php echo set_value('kontak'); ?>">
		<span style="color:#ff0000;"><?php echo form_error('kontak'); ?>
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
			<a href="<?php echo base_url(); ?>users" class="btn btn-app btn-warning  btn-xs  radius-4">
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

<link rel="stylesheet" href="<?php echo base_url()?>style/css/tag.css">
<!-- Social Buttons CSS -->
<link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">


<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>

 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Users / Pengguna</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Users / Pengguna
                        </div>
                        <div class="panel-body">
	<?php  echo form_open_multipart('users/a_edit'); ?>
	<?php
		$edit = $this->M_dataadmin->editusers($this->uri->segment(3,0));
		foreach($edit->result_array() as $raw)
		{
		$a=substr($raw['tanggal'], 0,4);
		$b=substr($raw['tanggal'], 5,2);
		$c=substr($raw['tanggal'], 8,9);
		$tanggal=$c.'-'.$b.'-'.$a;

		?>
						<input type="hidden" name="id" value="<?php echo $raw['id_session']; ?>">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>users" class="btn btn-app btn-warning  btn-xs  radius-4">
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
            <label>Blokir Users / Pengguna</label>
		<?php if ($raw['blokir']=='Y'){?>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios1" value="Y" checked>Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios2" value="N">Tidak </label> </div>
		<?php } else {?>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios1" value="Y">Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="aktif" id="aktifradios2" value="N" checked>Tidak </label> </div>
		<?php } ?>
            </div>
			</div>

			<div class="clearfix"></div>
	<div style="border:1px solid #ec8585;background:#cc3333;color:#fff;border-radius:5px; padding:20px;margin-bottom:20px;">
		<div class="form-group">
			<label>Username</label>
			<input  class="form-control" type="text" id="username" name="username" value="<?php echo $raw['username']; ?>"  disabled>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input  class="form-control" type="text" name="password" value="">
		</div>
		<div class="form-group" style="width:260px;">
		<label>Level Pengguna</label>
		<select class="form-control"  name="level" id="level">
			<?php
			$dataa = $this->M_dataadmin->pilihlevel();
			if ($raw['level']==0){
			echo "<option value='' selected>- Level Pengguna -</option>";
			}
				foreach($dataa->result_array() as $raaw) {
				if ($raw['level']==$raaw['namalevel']){ ?>
				<option  value="<?php echo $raaw['namalevel'];?>" selected><?php echo $raaw['namalevel'];?></option>
				<?php } else {?>
				<option  value="<?php echo $raaw['namalevel'];?>"><?php echo $raaw['namalevel'];?></option>
				<?php }
				}
			?>
           </select>
		</div>
	</div>
		<div class="clearfix"></div>

	<div style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
	<div class="form-group">
		<label>Modul yang Diizinkan:</label> <div class="clearfix"></div>
		<?php
			$noo=1;
			$dataa = $this->M_dataadmin->hakakses($raw['id_session']);
			foreach($dataa->result_array() as $t) {
		?>
			<div style="clear:both;padding: 1px 5px; margin: 15px 8px 15px 0;">
			<a style="display:inline;margin-right:8px;" href="<?php echo base_url(); ?>users/hapusakses/<?php echo $t['id_umod'];?>/<?php echo $raw['id_session'];?>" class="btn btn-success btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
					<i class="fa fa-times"></i> Hapus
				</a>
			 - <?php echo $t['nama_modul']; ?></div>
		<?php
			$noo=$noo+1;
		} ?>
	</div>

	<br><br>
		<div class="form-group">
		<label>Tambahkan Hak Akses:</label> <div class="clearfix"></div>
		<?php
			$noo=1;
			$dataa = $this->M_dataadmin->tambahakses($raw['id_session']);
			foreach($dataa->result_array() as $t) {
		?>
			<div style="
    padding: 1px 5px;
    margin: 0 8px 5px 0;">
			<input name="modul[]" id="d<?php echo $noo; ?>" type='checkbox' value="<?php echo $t['id_modul']; ?>" />
			<label for='d<?php echo $noo; ?>'><span></span><?php echo $t['nama_modul']; ?></label> </div>
		<?php
			$noo=$noo+1;
		} ?>
	</div>
	<div class="clearfix"></div>
	</div>

						</div>
                    </div>

            </div>

<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Users / Pengguna
                        </div>
                        <div class="panel-body">

	<div class="form-group">
		<label>Nama Lengkap</label>
		<input  class="form-control" type="text" name="nama_lengkap" value="<?php echo $raw['nama_lengkap']; ?>">
	</div>

	<div class="form-group">
		<label>Jabatan</label>
		<input  class="form-control" type="text" name="jabatan" value="<?php echo $raw['jabatan']; ?>">
	</div>

	<div class="form-group">
		<label>Alamat</label>
		<input  class="form-control" type="text" name="alamat" value="<?php echo $raw['alamat']; ?>">
	</div>

	<div class="form-group">
		<label>E-Mail</label>
		<input  class="form-control" type="text" name="email" value="<?php echo $raw['email']; ?>">
	</div>

	<div class="form-group">
		<label>Kontak HP/Telpon</label>
		<input  class="form-control" type="text" name="kontak" value="<?php echo $raw['kontak']; ?>">
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

						<a href="<?php echo base_url(); ?>users" class="btn btn-app btn-warning  btn-xs  radius-4">
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
		<?php } ?>
