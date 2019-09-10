<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?>
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data polling Online</h1>
                </div>
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> polling Online Terbaru
                        </div>
                        <div class="panel-body">
						<br>
					 <center>
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>

						<a href="<?php echo base_url(); ?>polling/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
						</a>

						<a href="<?php echo base_url(); ?>polling" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                                            <th>Pertanyaan polling Online</th>
                                            <th>Tanggal polling Online</th>
											<th>Aktif</th>
											<th>Operator</th>
											<th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

	<?php
	$no=1;
	foreach($artikel as $key => $row){
		$judul=seo_link($row['pertanyaan']);
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_polling']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
            <td><a class="bold" href="<?php echo base_url(); ?>polling/edit/<?php echo $row['id_polling']."/".$judul."/";?>"> <?php echo $row['pertanyaan']; ?> </a><br><br>
			<?php
		$edit = $this->M_dataadmin->custom_query("SELECT * from pollingpilihan where id_polling='".$row['id_polling']."' order by id_polling desc");
		foreach($edit->result_array() as $raw)
		{
		?>
			<i class="fa fa-check fa-fw"></i> <?php echo $raw['pilihan'];?> <br>
		<?php
		}
			?>

			</td>
			<td><?php echo tgl_indo($row['tgl_posting']); ?></td>

			<td>
			<?php if ($row['jangkrik']=='Y') {?>
				<a href="<?php echo base_url(); ?>polling/nonaktif/<?php echo $row['id_polling']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>polling/aktif/<?php echo $row['id_polling']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?>
			</td>

            <td class="center"><?php echo $row['nama_lengkap']; ?></td>
            <td class="center">
				<a href="<?php echo base_url(); ?>polling/edit/<?php echo $row['id_polling']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
                </a>

				<a href="<?php echo base_url(); ?>polling/delete/<?php echo $row['id_polling']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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
else if ($this->uri->segment(2,0)=='add') {  ?>
<?php
	$tanggal=date('d-m-Y');
	//ACAK ID POLLING
	$acak = rand(1,500);
?>


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
$("#inputdt").change(function(){
var prop = $("#inputdt").val();
$.ajax({
url: "<?php echo base_url()?>polling/pilihanpolling",
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


 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah polling Online</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah polling Online
                        </div>
                        <div class="panel-body">

<form method="POST" id="iklan" name="iklan" action="<?php echo base_url(); ?>polling/a_simpan"  enctype="multipart/form-data" onsubmit="return validasi(this)">

						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>polling" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>
<input type="hidden" name="id" value="<?php echo $acak; ?>">
							<div class="form-group">
								<label>Pertanyaan Polling</label>
								<input  class="form-control" type="text" name="pertanyaan" value="">
							</div>

							<div class="form-group">
                                            <label>Publish Polling</label>
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
			<label>Jumlah Pilihan/Jawaban</label>
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


						 <div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>polling" class="btn btn-app btn-warning  btn-xs  radius-4">
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
	 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit polling Online</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit polling Online
                        </div>
                        <div class="panel-body">
					<?php echo form_open_multipart('polling/a_edit'); ?>

		<?php
		$edit = $this->M_dataadmin->editpolling($this->uri->segment(3,0));
		foreach($edit->result_array() as $raw)
		{
		?>
						<input type="hidden" name="id" value="<?php echo $raw['id_polling']; ?>">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>polling" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>

							<div class="form-group">
								<label>Pertanyaan Polling</label>
								<input  class="form-control" type="text" name="pertanyaan" value="<?php echo $raw['pertanyaan']; ?>">
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
			<?php } ?>

	<div class="clearfix"></div>
		<div id="isian" style="border:1px solid #ec8585;background:#f2f2f2;border-radius:5px;padding:20px;margin-bottom:20px;">
		<label>Polling Pilihan</label>
		<table>
		<?php
		$edit = $this->M_dataadmin->custom_query("SELECT * from pollingpilihan where id_polling='".$raw['id_polling']."' order by id_polling desc");
		$na=1;
		foreach($edit->result_array() as $row)
		{
		?>
		<tr>
			<td width="135">Pilihan </td>
			<td><input value="<?php echo $row['pilihan']; ?>"  class="form-control" type="text" name="pilihan<?php echo $na; ?>" size="10" style="width:200px;margin-right:20px;margin-bottom:5px;"> <td width="75"> Rating</td><td>  <input value="<?php echo $row['rating']; ?>"  class="form-control" type="text" name="rating<?php echo $na; ?>" size="5"  style=" width:100px;margin-right:20px;">
			</td><td >
			<a href="<?php echo base_url(); ?>polling/hapuspilihan/<?php echo $row['id_pollingpilihan'];?>/<?php echo $raw['id_polling'];?>" class="btn btn-block btn-social btn-pinterest" style="display:inline;" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')"> <i class="fa fa-trash-o"></i> Hapus </a>
			</td><td>
				<?php if ($row['aktif']=='Y') { ?>
					<a href="<?php echo base_url(); ?>polling/nonaktifpilihan/<?php echo $row['id_pollingpilihan'];?>/<?php echo $raw['id_polling'];?>" class="btn btn-block btn-social btn-dropbox" onclick="return confirm('Non Aktifkan Pilihan?')"> <i class="fa fa-check"></i> Aktif </a>
				<?php }
				else { ?>
					<a href="<?php echo base_url(); ?>polling/aktifpilihan/<?php echo $row['id_pollingpilihan'];?>/<?php echo $raw['id_polling'];?>" class="btn btn-block btn-social btn-dropbox" onclick="return confirm('Aktifkan Pilihan?')"> <i class="fa fa-times"></i> Non Aktif </a>
				<?php } ?>
			</td>
		</tr>
		<?php
		$na++;
		}
			?>
		</table>
		</div>
	<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>polling" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						</div>
				<?php echo form_close(); ?>
						</div>
                    </div>
                </div>
            </div>
		<?php
}
?>
