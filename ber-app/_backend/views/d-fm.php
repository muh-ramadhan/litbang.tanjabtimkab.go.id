<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title> <?php echo $judulapp; ?>  </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>style/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url()?>style/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

 
	
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>style/css/sb-admin-2.css" rel="stylesheet">
<link href="<?php echo base_url()?>style/css/elfinder.css" rel="stylesheet">
 
	
    <!-- Custom Fonts -->
    <link href="<?php echo base_url()?>style/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


	
<!-- S: FILE MANAGER SUPPORTING FILE -->	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/forms/autogrowtextarea.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/forms/jquery.dualListBox.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/forms/chosen.jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/forms/jquery.maskedinput.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/forms/jquery.inputlimiter.min.js"></script>



<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/forms/jquery.tagsinput.min.js"></script>



<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/other/elfinder.min.js"></script>



<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/uploader/jquery.plupload.queue.js"></script>



<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/ui/jquery.alerts.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/wizards/jquery.validate.js"></script>



<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>style/js/plugins/ui/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>style/js/custom.js"></script>

<!-- E: FILE MANAGER SUPPORTING FILE -->
 

</head>

<body>

    <div id="wrapper">

<?php $this->load->view($vnavigasi); ?>
	
        <div id="page-wrapper">
	 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">File Manager</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
		<div class="row">
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-files-o fa-fw"></i> File Manager 
                        </div>
                        <!-- /.panel-heading -->
                         
                           <div id="fileManager"></div>
                       
                        <!-- /.panel-body -->
                    </div> 
                </div> 
		</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
 

  
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>style/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>style/bower_components/metisMenu/dist/metisMenu.min.js"></script>
 
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>style/js/sb-admin-2.js"></script>
 
</body>

</html>
