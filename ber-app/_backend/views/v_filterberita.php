<?php
if ($this->uri->segment(2,0)==null or $this->uri->segment(2,0)=="index") {
?>
 <!-- Social Buttons CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css'>

<script src='http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js'></script>

    <script src="<?php echo base_url()?>style/js/datepick.js"></script>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Filter Berita</h1>
			</div>
		</div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							<i class="fa fa-th-list fa-fw"></i> Filter Berita
                        </div>
                        <div class="panel-body">

						<br>

 <form  id="filterberita" action="" method="POST">
		<?php // echo form_open_multipart('filterberita/filter'); ?>
	<div class="filterc">
			<div class="form-group">
						<label>Tanggal Awal</label>
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal1" class="form-control" value="<?php //echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			</div>
			<div class="filterc">
			<div class="form-group">
						<label>Tanggal Akhir</label>
                <div class="input-group date" id="datetimepicker1" style="width:180px;" >
                    <input type="text" name="tanggal2" class="form-control" value="<?php //echo $tanggal; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			</div>

			<div class="filterc" style="margin-right:8px;">
			<div class="form-group">
				<label>Pilih Kategori</label>
                <select class="form-control"   name="kategori" id="kategori" id="indeks-tgl" >
					<option value="0" selected>- Pilih Kategori -</option>
					<?php
					$dataa = $this->M_dataadmin->pilihkategori();
					foreach($dataa->result_array() as $raw) {
					?>
					<option  value="<?php echo $raw['id_kategori'];?>"><?php echo $raw['nama_kategori'];?></option>
					<?php } ?>
                </select>
            </div>
			</div>

			<div class="filterc" style="margin-right:8px;">
			<div class="form-group">
				<label>Pilih Daerah</label>
				<select class="form-control"  name="daerah" id="daerah">
					<option value="0" selected>- Pilih Daerah -</option>
					<?php
					$dataa = $this->M_dataadmin->pilihdaerah();
					foreach($dataa->result_array() as $raw) {
					?>
					<option  value="<?php echo $raw['id_daerah'];?>"><?php echo $raw['nama_daerah'];?></option>
					<?php } ?>
                </select>
            </div>
			</div>
			<div style="float:left;">
			<div class="form-group">
				<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
					<i class="ace-icon fa fa-refresh bigger-160"></i> Filter
				</button>
            </div>
			</div>
		  <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>

<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pencarian Berita</h1>
			</div>
		</div>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
							<i class="fa fa-search fa-fw"></i> Pencarian Berita
                        </div>
                        <div class="panel-body">

<!-- <form  id="filterberita" action="" method="POST">-->


<div class="form-group">
	<label>Pencarian</label>
		<?php echo form_open_multipart('filterberita/cari'); ?>
			<div class="input-group custom-search-form">
				<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
                    <button class="btn btn-default" type="button">
						<i class="fa fa-search"></i>
					</button>
			</span>
		</div>
	<?php echo form_close(); ?>
</div>
			<!--
			<div style="float:left;">
			<div class="form-group">
				<button type="submit" class="btn btn-app btn-success btn-xs radius-4">
					<i class="ace-icon fa fa-search bigger-160"></i> Cari
				</button>
            </div>
			</div>
			-->

                        </div>
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
                    <h1 class="page-header">Tambah Kategori Berita</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i> Tambah Kategori Berita
                        </div>
                        <div class="panel-body">
							<?php echo form_open_multipart('kategori/a_simpan'); ?>
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>kategori" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>

							<div class="form-group">
								<label>Nama Kategori</label>
								<input  class="form-control" type="text" name="nama_kategori" value="">
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


						 <div class="clearfix"></div>
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>kategori" class="btn btn-app btn-warning  btn-xs  radius-4">
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
                    <h1 class="page-header">Edit Kategori Berita</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Kategori Berita
                        </div>
                        <div class="panel-body">
					<?php echo form_open_multipart('kategori/a_edit'); ?>

		<?php
		$edit = $this->M_dataadmin->editkategori($this->uri->segment(3,0));
		foreach($edit->result_array() as $raw)
		{
		?>
						<input type="hidden" name="id" value="<?php echo $raw['id_kategori']; ?>">
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>kategori" class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						</center>
						<div class="clearfix"></div>
						</div>

							<div class="form-group">
								<label>Nama Kategori</label>
								<input  class="form-control" type="text" name="nama_kategori" value="<?php echo $raw['nama_kategori']; ?>">
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
						<div class="aksi" style="border-top:1px solid #ccc; margin-top:20px; ">
						<div class="clearfix"></div>
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>

						<a href="<?php echo base_url(); ?>kategori" class="btn btn-app btn-warning  btn-xs  radius-4">
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
