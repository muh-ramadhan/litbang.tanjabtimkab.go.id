<?php 
$root = "http://".$_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>Halaman Tidak Ditemukan</title>
<link rel="shortcut icon" href="<?php echo $root; ?>style/images/favicon.png">
<link type="text/css" rel="stylesheet" href="<?php echo $root; ?>style/css/notfound.css">
<link href='https://fonts.googleapis.com/css?family=Lato:100,300|Roboto:300' rel='stylesheet' type='text/css'>

 

</head>
<body>

<div class="wrapper">
	<div class="error">
		<div class="error__404">
			4<span>0</span>4
		</div>
		<div class="error__notfound">PAGE NOT FOUND</div>
		<div class="error__lead">Maaf, Halaman yang Anda cari tidak ditemukan. <br />Kemungkinan karena URL tersebut salah <br />atau tidak tersedia.</div>
		<div class="error__logo">
			<a href="<?php echo $root; ?>"><img src="<?php echo $root; ?>style/images/logo.png" alt=""></a>
		</div>
	</div>
</div>
</body>
</html>