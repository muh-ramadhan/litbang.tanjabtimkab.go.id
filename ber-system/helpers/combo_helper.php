<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('combonamabln'))
{
function combonamabln($awal, $akhir, $var, $terpilih){
  $nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                      "Juni", "Juli", "Agustus", "September", 
                      "Oktober", "November", "Desember");
  echo "<select name='$var' class='form-control' id='$var' style='width: 190px;  display:inline;margin-right:15px;'>";
  for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
  }
  echo "</select> ";
}
}


if ( ! function_exists('combotgl'))
{
function combotgl($awal, $akhir, $var, $terpilih){
  echo "<select name='$var'  id='$var'  class='form-control' style='width: 70px;  ;margin-right:15px;display:inline'>";
  for ($i=$awal; $i<=$akhir; $i++){
    $lebar=strlen($i);
    switch($lebar){
      case 1:
      {
        $g="0".$i;
        break;     
      }
      case 2:
      {
        $g=$i;
        break;     
      }      
    }  
    if ($i==$terpilih)
      echo "<option value=$g selected>$g</option>";
    else
      echo "<option value=$g>$g</option>";
  }
  echo "</select> ";
}
}


if ( ! function_exists('combothn'))
{
function combothn($awal, $akhir, $var, $terpilih){
  echo "<select name='$var'  id='$var'  class='form-control' style='width: 90px;  ;margin-right:15px;display:inline'>";
  for ($i=$awal; $i<=$akhir; $i++){
    if ($i==$terpilih)
      echo "<option value=$i selected>$i</option>";
    else
      echo "<option value=$i>$i</option>";
  }
  echo "</select> ";
} 
}

if ( ! function_exists('combothn2'))
{
function combothn2($awal, $akhir, $var, $terpilih){
  echo "<select name='$var' id='$var' class='form-control' style='width: 90px;  ;margin-right:15px;display:inline'>";
  // echo "<option value='0' selected>-</option>";
  for ($i=$awal; $i<=$akhir; $i++){
    if ($i==$terpilih)
      echo "<option value='$i' selected>$i</option>";
    else
      echo "<option value='$i'>$i</option>";
  }
  echo "</select> ";
}
}
