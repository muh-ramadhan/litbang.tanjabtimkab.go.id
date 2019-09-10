<?php
function waktu($w){
$jml = strlen($w);
if($jml==8){
$jam = substr($w,0,2);
$menit = substr($w,3,2);
$detik = substr($w,6,2);
$menits=ceil($menit);
$detiks=ceil($detik);
$jams=ceil($jam);
$hari=floor($jams/24);
if(empty($jams)){
if(empty($menits)){
return '('.$detiks.' detik yg lalu)';
}else
{return '('.$menits.' menit ' .$detiks.' detik yg lalu)';}
}elseif(!empty($jams) && $jams<=24){
return '('.$jams.' jam ' .$menits.' menit ' .$detiks.' detik yg lalu)';}
elseif(!empty($hari)){
return '('.$hari.' hari yg lalu)';}
}
}
?>