<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?>
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Tag Berita</h1>
                </div>
            </div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Tag Berita Terbaru
                        </div>
                        <div class="panel-body">
						<br>
					 <center>
						<a class="btn btn-app btn-light btn-xs radius-4">
							<i class="ace-icon fa fa-home bigger-160"></i> Home
						</a>

						<a href="<?php echo base_url(); ?>tag/add" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-plus-circle bigger-160"></i> Add
						</a>

						<a href="<?php echo base_url(); ?>tag" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                                            <th>Nama Tag</th>
                                            <th>Trending Topic</th>
                                            <th>Jumlah Berita</th>
											<th>Publish</th>
											<th>Operator</th>
											<th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

	<?php
	$no=1;
	foreach($artikel as $key => $row){
		$judul=seo_link($row['nama_tag']);
	?>
	   <tr class="odd">
			<td><?php echo $no; ?></td>
            <td><center><input type="checkbox" name="cek[]" class="case" value="<?php echo $row['id_tag']; ?>" id="id<?php echo $no; ?>" rel="ck" title="Pilih"></center></td>
            <td><a class="bold" href="<?php echo base_url(); ?>tag/edit/<?php echo $row['id_tag']."/".$judul."/";?>"> <?php echo $row['nama_tag']; ?> </a></td>
			<td>
			<center>
			<?php if ($row['trending']=='Y') {?>
				<a href="<?php echo base_url(); ?>tag/nontrending/<?php echo $row['id_tag']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>tag/trending/<?php echo $row['id_tag']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?>
			</center>
			</td>
			<td class="center"><center> </center></td>
			<td>
			<?php if ($row['jangkrik']=='Y') {?>
				<a href="<?php echo base_url(); ?>tag/nonaktif/<?php echo $row['id_tag']."/".$judul."/";?>" class="btn btn-info btn-circle btn-lg"><i class="fa fa-check"></i> </a>
			<?php } else {?>
				<a href="<?php echo base_url(); ?>tag/aktif/<?php echo $row['id_tag']."/".$judul."/";?>" 	class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </a>
			<?php } ?>
			</td>

            <td class="center"><?php echo $row['nama_lengkap']; ?></td>
            <td class="center">
				<a href="<?php echo base_url(); ?>tag/edit/<?php echo $row['id_tag']."/".$judul."/";?>" class="btn btn-block btn-social btn-dropbox">
					<i class="fa fa-pencil"></i> Edit
                </a>

				<a href="<?php echo base_url(); ?>tag/delete/<?php echo $row['id_tag']."/".$judul."/";?>" class="btn btn-block btn-social btn-pinterest" onclick="return confirm('Apakah Anda benar-benar mau menghapusnya?')">
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
else if ($this->uri->segment(2,0)=='add') {
        ?>
<?php
	$tanggal=date('d-m-Y');
?>


 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Tag Berita</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Tag Berita
                        </div>
                        <div class="panel-body">
							<?php echo form_open_multipart('tag/a_simpan'); ?>
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>tag" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>

							<div class="form-group">
								<label>Nama Tag Berita</label>
								<input  class="form-control" type="text" name="nama_tag" value="">
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
                                            <label>Trending Topic</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="trending" id="trendingRadios1" value="Y" checked>Ya
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="trending" id="trendingRadios2" value="N">Tidak
                                                </label>
                                            </div>
                            </div>


						 <div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>tag" class="btn btn-app btn-warning  btn-xs  radius-4">
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
 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Tag Berita</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Tag Berita
                        </div>
                        <div class="panel-body">
					<?php echo form_open_multipart('tag/a_edit'); ?>

		<?php
		$edit = $this->M_dataadmin->edittag($this->uri->segment(3,0));
		foreach($edit->result_array() as $raw)
		{
		?>
						<input type="hidden" name="id" value="<?php echo $raw['id_tag']; ?>">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>tag" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>

							<div class="form-group">
								<label>Nama Tag</label>
								<input  class="form-control" type="text" name="nama_tag" value="<?php echo $raw['nama_tag']; ?>">
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
            <label>Trending Topic</label>
		<?php if ($raw['aktif']=='Y'){?>
			<div class="radio"> <label> <input type="radio" name="trending" id="trendingradios1" value="Y" checked>Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="trending" id="trendingradios2" value="N">Tidak </label> </div>
		<?php } else {?>
			<div class="radio"> <label> <input type="radio" name="trending" id="trendingradios1" value="Y">Ya </label> </div>
			<div class="radio"> <label> <input type="radio" name="trending" id="trendingradios2" value="N" checked>Tidak </label> </div>
		<?php } ?>
            </div>
			<?php } ?>
						<div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>tag" class="btn btn-app btn-warning  btn-xs  radius-4">
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
