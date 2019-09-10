 <div class="row">
 	<div class="col-lg-12">
 		<h1 class="page-header">Identitas Website</h1>
 	</div>
 </div>
 <div class="row">
 	<div class="col-lg-8">
 		<div class="panel panel-default">
 			<div class="panel-heading">
 				<i class="fa fa-wrench fa-fw"></i> Identitas Website
 			</div>
 			<div class="panel-body">
						<!--
						<div class="aksi" style="*border-bottom:1px solid #ccc; margin-bottom:20px; ">
						<center>
						<button type="submit" class="btn btn-app btn-grey btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						<a class="btn btn-app btn-warning  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</a>
						<button class="btn btn-app btn-grey btn-xs radius-4">
							<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
						</button>
						<button class="btn btn-app btn-purple  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</button>
						<button class="btn btn-app btn-success  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</button>
						<button class="btn btn-app btn-danger  btn-xs  radius-4">
							<i class="ace-icon fa fa-times bigger-160"></i> Cancel
						</button>
						<a href="#" class="btn btn-app btn-yellow btn-xs radius-4">
							<i class="ace-icon fa fa-shopping-cart bigger-160"></i> Shop
						</a>
						</center>
						</div>
						<div class="clearfix"></div>
					-->
					<?php echo form_open_multipart('identitas/a_simpan'); ?>
					<?php
					$dataa = $this->M_dataadmin->identitas();
					foreach($dataa->result_array() as $raw) {
						?>
						<div class="aksi" style="border-bottom:1px solid #ccc; margin-bottom:20px; ">
							<center>
								<a class="btn btn-app btn-light btn-xs radius-4">
									<i class="ace-icon fa fa-home bigger-160"></i> Home
								</a>
								<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
									<i class="ace-icon fa fa-floppy-o bigger-160"></i> Simpan
								</button>
								<a href="<?php echo base_url(); ?>identitas" class="btn btn-app btn-warning  btn-xs  radius-4">
									<i class="ace-icon fa fa-refresh bigger-160"></i> Refresh
								</a>
							</center>
							<div class="clearfix"></div>
						</div>
						<input type="hidden" name="id" value="<?php echo $raw['id_identitas']; ?>">
						<div class="form-group">
							<label>Nama Website</label>
							<input  class="form-control" type="text" name="nama_website" value="<?php echo $raw['nama_website'];?>">
						</div>
						<div class="form-group">
							<label>Domain Website</label>
							<input  class="form-control" type="text" name="alamat_website" value="<?php echo $raw['url'];?>">
						</div>
						<div class="form-group">
							<label>Meta Deskripsi</label>
							<textarea class="form-control"  name="meta_deskripsi"  rows="3"><?php echo $raw['meta_deskripsi'];?></textarea>
						</div>
						<div class="form-group">
							<label>Meta Keyword</label>
							<textarea class="form-control"  name="meta_keyword"  rows="3"><?php echo $raw['meta_keyword'];?></textarea>
						</div>
						<div class="form-group">
							<label>Kantor</label>
							<input  class="form-control" type="text" name="kantor" value="<?php echo $raw['kantor'];?>">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input  class="form-control" type="text" name="alamat" value="<?php echo $raw['alamat'];?>">
						</div>
						<div class="form-group">
							<label>e-Mail</label>
							<input  class="form-control" type="text" name="email" value="<?php echo $raw['email'];?>">
						</div>
						<div class="form-group">
							<label>Telpon / Fax</label>
							<input  class="form-control" type="text" name="telpweb" value="<?php echo $raw['no_telp'];?>">
						</div>
						<div class="form-group">
							<label>Copyright</label>
							<input  class="form-control" type="text" name="copyright" value="<?php echo $raw['copyright'];?>">
						</div>
						<div class="form-group">
							<label>Title Bottom</label>
							<input  class="form-control" type="text" name="title_bottom" value="<?php echo $raw['title_bottom'];?>">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bell fa-fw"></i> Social Media
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Facebook</label>
							<input  class="form-control" type="text" name="facebook" value="<?php echo $raw['facebook'];?>">
						</div>
						<div class="form-group">
							<label>Twitter</label>
							<input  class="form-control" type="text" name="twitter" value="<?php echo $raw['twiter'];?>">
						</div>
						<div class="form-group">
							<label>Youtube</label>
							<input  class="form-control" type="text" name="youtube" value="<?php echo $raw['youtube'];?>">
						</div>
						<div class="form-group">
							<label>Foursqare</label>
							<input  class="form-control" type="text" name="foursquare" value="<?php echo $raw['foursquare'];?>">
						</div>
						<div class="form-group">
							<label>Instagram</label>
							<input  class="form-control" type="text" name="instagram" value="<?php echo $raw['instagram'];?>">
						</div>
						<div class="form-group">
							<label>Google+</label>
							<input  class="form-control" type="text" name="googleplus" value="<?php echo $raw['googleplus'];?>">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bell fa-fw"></i> Logo
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Logo Website</label>
							<?
							if ($raw['logo']!=''){ ?>
								<img src="<?php echo base_url(); ?>../style/images/<?php echo $raw['logo']; ?>" width="100%">
								<?php } ?> <br> <br>
								<input type="file" name="imagefile">
							</div>
							<!--
							<div class="form-group">
								<label>Logo Favicon</label>
								<input type="file" name="imagefile">
							</div>
						-->
						<!-- e:simpan -->
						<center>
						<?php } ?>
						<div class="aksi" style="border-top:1px solid #ccc; margin-bottom:20px; ">
							<br>
							<button type="submit" class="btn btn-app btn-primary btn-xs radius-4">
								<i class="ace-icon fa fa-floppy-o bigger-160"></i> Simpan
							</button>
						</div>
					</center>
					<!-- e:simpan -->
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>