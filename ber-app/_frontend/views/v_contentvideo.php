<?php  if ($this->uri->segment(2,0)=='index') { ?>
	<div class="box-single-content clearfix" id="pagehead">

		<div class="pagehead-action-bar clearfix">
			<ul class="action-buttons clearfix">
				<li><a href="#" class="share">Share</a></li>
				<li><a href="#" class="print">Print</a></li>
			</ul>
			<ul class="cookie-crumbs">
				<li> <a href="<?php echo base_url(); ?>">Home</a></li>
				<li> <a href="<?php echo base_url(); ?>video">Video Kegiatan</a> </li>
			</ul>
		</div>
		<br>
		<h1 ><?php echo $judulan; ?> Kegiatan</h1>
		<p class="rs post-by"><?php echo $postingby; ?></p>
		<?php
		if (count($artikel)) {
			foreach($artikel  as $row){
				$link=str_replace('watch?v=','embed/', $row['link']);
				?>
				<div class="videoWrapper">
					<!-- Copy & Pasted from YouTube -->
					<iframe width="560" height="349" src="<?php  echo $link;?>" frameborder="0" allowfullscreen></iframe>

				</div>
				<div style="background:#efefef;color:000;padding:10px 15px;border-bottom:2px solid #d4a216;"><?php echo $row['judul']; ?> </div>

				<?php
			}
			?>
			<div class="clearfix"></div>
			<br><br>
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
			<h4 >Maaf, Data Belum Tersedia !</h4>
			<?php
		}
		?>
	</div>
	<?php } ?>