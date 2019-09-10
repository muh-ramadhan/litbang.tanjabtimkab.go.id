<?php
// ADMINISTARTIOR /////////////////////////////////////////////////////////////////////////////////
class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=1 class='nextprev'>Awal</a>
                    <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$prev class='nextprev'>Kembali</a>";
}
else{ 
	$link_halaman .=  "<span class='nextprev'>Awal</span> 
	<span class='nextprev'>Kembali</span>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif >  3 ? " <span class='nextprev'>...</span>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "  <span class='nextprev'>...</span><a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next class='nextprev'>Lanjut</a>
                     <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman class='nextprev'>Akhir</a> ";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}

class Paging99{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['page'])){
	$posisi=0;
	$_GET['page']=1;
}
else{
	$posisi = ($_GET['page']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=halaman-1.html class='nextprev'>Awal</a> 
                    <a href=halaman-$prev.html class='nextprev'>Kembali</a>";
}
else{ 
	$link_halaman .= "<span class='nextprev'>Awal</span> 
	<span class='nextprev'>Kembali</span>  ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <span class='nextprev'>...</span>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halaman-$i.html>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halaman-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class='nextprev'>...</span><a href=halaman-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halaman-$next.html class='nextprev' >Lanjut</a>
                     <a href=halaman-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}

// CARI BERITA/////////////////////////////////////////////////////////////////////////////////
class Paging9{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=halaman-1.html class='nextprev'>Awal</a> 
                    <a href=halaman-$prev.html class='nextprev'>Kembali</a>";
}
else{ 
	$link_halaman .= "<span class='nextprev'>Awal</span> 
	<span class='nextprev'>Kembali</span>  ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <span class='nextprev'>...</span>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halaman-$i.html>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halaman-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class='nextprev'>...</span><a href=halaman-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halaman-$next.html class='nextprev' >Lanjut</a>
                     <a href=halaman-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}


// SEMUA BERITA/////////////////////////////////////////////////////////////////////////////////
class Paging2{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halberita'])){
	$posisi=0;
	$_GET['halberita']=1;
}
else{
	$posisi = ($_GET['halberita']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=halberita-1.html class='nextprev'>Awal</a> 
                    <a href=halberita-$prev.html class='nextprev'>Kembali</a>";
}
else{ 
	$link_halaman .= "<span class='nextprev'>Awal</span> 
	<span class='nextprev'>Kembali</span>  ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <span class='nextprev'>...</span>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halberita-$i.html>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halberita-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class='nextprev'>...</span><a href=halberita-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halberita-$next.html class='nextprev' >Lanjut</a>
                     <a href=halberita-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}






// KATEGORI BERITA////////////////////////////////////////////////////////////////////////////////////
class Paging3{
function cariPosisi($batas){
if(empty($_GET['halkat'])){
	$posisi=0;
	$_GET['halkat']=1;
}
else{
	$posisi = ($_GET['halkat']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas, $seo){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=halkat-$_GET[id]-1.html class='nextprev'>Awal</a>
                    <a href=halkat-$_GET[id]-$prev.html class='nextprev'>Kembali</a>";
}
else{ 
$link_halaman .= "<span class='nextprev'>Awal</span>
<span class='nextprev'>Kembali</span>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halkat-$_GET[id]-$i.html>$i</a>";
  }
	 $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halkat-$_GET[id]-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<span class='nextprev'>...</span><a href=halkat-$_GET[id]-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halkat-$_GET[id]-$next.html class='nextprev' >Lanjut</a>
                     <a href=halkat-$_GET[id]-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}
 

?>
