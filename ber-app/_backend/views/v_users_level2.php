
<link rel="stylesheet" href="<?php echo base_url()?>style/css/tag.css">	
<!-- Social Buttons CSS -->
<link href="<?php echo base_url()?>style/bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">	 
 
	
 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Users / Pengguna</h1>
                </div> 
            </div>
			
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<i class="fa fa-wrench fa-fw"></i>Edit Users / Pengguna <?php //echo $this->session->userdata('session_id'); ?> 
                        </div> 
                        <div class="panel-body"> 
	<?php  echo form_open_multipart('users/a_edit'); ?>	  
	<?php
	$edit = $this->M_dataadmin->editusers($this->session->userdata('session_id')); 
	foreach($edit->result_array() as $raw)
	{
	?>
	<input type="hidden" name="id" value="<?php echo $this->session->userdata('session_id'); ?>">  
	<input type="hidden" name="level" value="<?php echo $raw['level']; ?>">   
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						 
						</center>
			<div class="clearfix"></div>
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
		<div class="form-group">
		<label>Level Pengguna</label>  
			: <?php echo $raw['level'];?>
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
			<?php echo $t['nama_modul']; ?></div>
		<?php
			$noo=$noo+1;
		} ?>			
	</div>
	 
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
	</center>
	</div>  
<?php } ?>	
<?php echo form_close(); ?> 
</div>
</div>
</div>						
		</div>	 