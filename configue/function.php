<?php 
define("Upload","Upload Gagal, Pastikan gambar bertipe *.PNG");
define("UploadSUkses","Upload dan Update data Sukses");
define("UpdateSUkses","Update data Sukses");
define("DeletSukses","Hapus gambar Sukses");
define("Gagal","Hapus gambar gagal");
//status informasi pada saat eksekusi database
function alert($type,$text = null){
	if($type=='info'){
		echo "<font color='white'><div class='infofly go-front' id='status'>$text</div></font>";
	}
	else if($type=='error')	{
		echo "<font color='white'><div class='errorfly go-front' id='status'>$text</div></font>";
	}
	else if($type=='download')	{
		echo "<font color='black'><center>$text</center></font>";
	}
	else if($type=='loading')		
		echo "<div id='loading'><center>$text</center></div>";
	
}
function alert2($type,$text = null){
	if($type=='info'){
		echo "<font color='black'><div class='infofly go-front' id='status'>$text</div></font>";
	}
	else if($type=='error')	{
		echo "<font color='black'><div class='errorfly go-front' id='status'>$text</div></font>";
	}
	else if($type=='loading')		
		echo "<div id='loading'><center>$text</center></div>";
}
//fungsi redirect menggunakan php
function redirect($url) {
	header("location:".$url);
}

//fungsi redirect menggunakan html
function htmlRedirect($link,$time = null) {
	if($time) $time = $time; else $time = 1;
	echo "<meta http-equiv='REFRESH' content='$time; url=$link'>";
}
//fungsi redirect menggunakan html
function dlRedirect($link,$time = null) {
	if($time) $time = $time; else $time = 5;
	echo "<meta http-equiv='REFRESH' content='$time; url=$link'>";
}

function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}
?>