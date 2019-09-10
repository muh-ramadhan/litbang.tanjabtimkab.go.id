<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title> <?php echo $judulapp; ?>  </title>
	<link href="<?php echo base_url()?>style/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/css/fonts.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/css/sb-admin-2.css" rel="stylesheet">
	<link href="<?php echo base_url()?>style/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url()?>style/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url()?>style/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>style/bower_components/metisMenu/dist/metisMenu.min.js"></script>
	<script language="javascript">
		$(document).ready(function(){
			$("#selectall").click(function () {
				$('.case').attr('checked', this.checked);
			});
			$(".case").click(function(){

				if($(".case").length == $(".case:checked").length) {
					$("#selectall").attr("checked", "checked");
				} else {
					$("#selectall").removeAttr("checked");
				}

			});
		});
	</script>
	<script src="<?php echo base_url()?>style/js/sb-admin-2.js"></script>
	<script src="<?php echo base_url(); ?>../tinymcpuk/jscripts/tiny_mce/tiny_mce---.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia--.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia2--.js" type="text/javascript"></script>

</head>
<body>
	<div id="wrapper">
		<?php $this->load->view($vnavigasi); ?>
		<div id="page-wrapper">
			<?php $this->load->view($vdata); ?>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#dataTables-example').DataTable({
				responsive: true
			});
		});
	</script>
</body>

</html>
