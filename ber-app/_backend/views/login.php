<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Administrator Login</title>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url()?>style/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>style/css/normalize.min.css">

  <link rel="stylesheet" href="<?php echo base_url()?>style/css/custom-style.css">

 
	  <!-- jQuery -->
    <script src="<?php echo base_url()?>style/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>style/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>style/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>style/js/sb-admin-2.js"></script>

	
	
</head>

<body>
  <div class="wrapper">
  <div class="login"> 
<center>
<?php 
$identitas = $this->M_dataadmin->identitas();
foreach($identitas->result() as $idd) {
?>  
<?php } ?>
<img src="<?php echo base_url()?>../style/images/<?php echo $idd->logo; ?>" width="100%" style="margin:20px 0;"> 
</center>
    <p class="title">Log in</p>
<div id="report2"></div>
<div class="label label-danger" style="color:#ff0000;"> <?=validation_errors()?> </div> 
<div class="label label-danger" style="color:#ff0000;"> <?php if (isset($error)){ echo $error; } ?> </div> <br> 
<form action="<?php echo base_url(); ?>login" enctype="multipart/form-data" method="post" accept-charset="utf-8"> 	
    <input type="text" name="username" id="user" placeholder="Username" required autofocus/>
    <i class="fa fa-user"></i>
    <input type="password"  name="password"  placeholder="Password"  required /> 
    <i class="fa fa-key"></i>
	
	
	<!--
	<br>
		<center><?php echo $gbr_captcha; ?></center><br>
	<div class="form-group">
                                    <input class="form-control" placeholder="Captcha" name="captcha"  id="pass"  type="password" value="">
                                </div>
	-->				
<center>
  <?php  echo $recaptcha_html;?> 
  <span style="color:#ff0000;"><?php echo form_error('g-recaptcha-response');?></span>
 
 </center>	
<!--    <a href="#">Forgot your password?</a> --> 
	
    <!--
	<button  type="submit"  id="submit"   name="submit" >
      <i class="spinner"></i>
      <span class="state">Log in</span>
    </button>
	-->
	<input type="submit"  id="submit"  class="btn btn-lg btn-success btn-block" name="submit" value="Login" />
	
  </div>
  <?php echo form_close(); ?> 
  
  <footer>Developed by <a target="blank" href="http://bermultimedia.com/">Bermultimedia.com</a></footer>
  </p>
</div>
<?php /* ?>   
<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function(){
//var working = false;
//$('.login').on('submit', function(e) {
			
			$("#login_form").submit(function()
			{	//nge-cek user ada a/ tidak dg ajak $.post()
				//alert($("#login_form").serialize());
				$.post($(this).attr("action"),$(this).serialize(),
				function(data)
				{
					if(data==1){
						//alert(data);
						//$("#report").html(data).fadeTo(900,1);
						document.location="<?php echo base_url(); ?>dashboard";
					}
					else
					{ //tampilan pesan jika salah
						$("#report2").fadeTo(200,0.1,function(){	
								$(this).html('<div id="report">User atau Password anda salah...</div>').fadeTo(900,1); });
					}
				});
				return false;
			});
			
			$("#user").focus();
		});
		//]]>
	</script>
<?php */ ?>  
</body>
</html>
