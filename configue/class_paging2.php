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
	$link_halaman .= "<a href=halkat-$_GET[kat]-1.html class='nextprev'>Awal</a>
                    <a href=halkat-$_GET[kat]-$prev.html class='nextprev'>Kembali</a>";
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
	  $angka .= "<a href=halkat-$_GET[kat]-$i.html>$i</a>";
  }
	 $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halkat-$_GET[kat]-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<span class='nextprev'>...</span><a href=halkat-$seo-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halkat-$_GET[kat]-$next.html class='nextprev' >Lanjut</a>
                     <a href=halkat-$_GET[kat]-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}





// KATEGORI BERITA////////////////////////////////////////////////////////////////////////////////////
class Paging8{
function cariPosisi($batas){
if(empty($_GET['halsubkat'])){
	$posisi=0;
	$_GET['halsubkat']=1;
}
else{
	$posisi = ($_GET['halsubkat']-1) * $batas;
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
	$link_halaman .= "<a href=halsubkat-$_GET[subkat]-1.html class='nextprev'>Awal</a>
                    <a href=halsubkat-$_GET[subkat]-$prev.html class='nextprev'>Kembali</a>";
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
	  $angka .= "<a href=halsubkat-$_GET[subkat]-$i.html>$i</a>";
  }
	 $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halsubkat-$_GET[subkat]-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<span class='nextprev'>...</span><a href=halsubkat-$seo-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halsubkat-$_GET[subkat]-$next.html class='nextprev' >Lanjut</a>
                     <a href=halsubkat-$_GET[subkat]-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}



// AGENDA /////////////////////////////////////////////////////////////////////////////
class Paging4{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halagenda'])){
	$posisi=0;
	$_GET['halagenda']=1;
}
else{
	$posisi = ($_GET['halagenda']-1) * $batas;
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
	$link_halaman .= "<a href=halagenda-1.html class='nextprev'>Awal</a> 
                    <a href=halagenda-$prev.html class='nextprev'>Kembali</a>";
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
	  $angka .= "<a href=halagenda-$i.html>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halagenda-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class='nextprev'>...</span><a href=halagenda-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halagenda-$next.html class='nextprev' >Lanjut</a>
                     <a href=halagenda-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}



// DOWNLOAD///////////////////////////////////////////////////////////////////////////
class Paging5{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['haldownload'])){
	$posisi=0;
	$_GET['haldownload']=1;
}
else{
	$posisi = ($_GET['haldownload']-1) * $batas;
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
	$link_halaman .= "<a href=haldownload-1.html class='nextprev'>Awal</a> 
                    <a href=haldownload-$prev.html class='nextprev'>Kembali</a>";
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
	  $angka .= "<a href=haldownload-$i.html>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=haldownload-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class='nextprev'>...</span><a href=haldownload-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=haldownload-$next.html class='nextprev' >Lanjut</a>
                     <a href=haldownload-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}






//GALERI ///////////////////////////////////////////////////////////////////////
class Paging6{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halgaleri'])){
	$posisi=0;
	$_GET['halgaleri']=1;
}
else{
	$posisi = ($_GET['halgaleri']-1) * $batas;
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
	$link_halaman .= "<a href=halgaleri-1.html class='nextprev'>Awal</a> 
                    <a href=halgaleri-$prev.html class='nextprev'>Kembali</a>";
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
	  $angka .= "<a href=halgaleri-$i.html>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halgaleri-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class='nextprev'>...</span><a href=halgaleri-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halgaleri-$next.html class='nextprev' >Lanjut</a>
                     <a href=halgaleri-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}


//KOMENTAR///////////////////////////////////////////////////////////////////////
class Paging77{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halkomentar'])){
	$posisi=0;
	$_GET['halkomentar']=1;
}
else{
	$posisi = ($_GET['halkomentar']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman,$id){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a class='nextprev' href=javascript:move('1','$id')>First</a> | 
	
	<a class='nextprev' href=javascript:move('$prev','$id')> Prev</a> | ";
//                    <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<span class='nextprev'>First</span><span class='nextprev'>Prev</span>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=javascript:move('$i','$id')>$i</a> | ";
	  // $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=javascript:move('$i','$id')>$i</a> | ";
	  //$angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=javascript:move('$jmlhalaman','$id')>$jmlhalaman</a> | " : " ");
	  // $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=javascript:move('$next','$id')>Next ></a> | 
                     <a href=javascript:move('$jmlhalaman','$id')>Last >></a> ";
					 
					// $link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next>Next ></a> | 
                   //  <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}









//KOMENTAR///////////////////////////////////////////////////////////////////////
class Paging7{
function cariPosisi($batas){
if(empty($_GET['halkomentar'])){
	$posisi=0;
	$_GET['halkomentar']=1;
}
else{
	$posisi = ($_GET['halkomentar']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman,$id){
$link_halaman = "";

// Link ke halaman pertama (Awal) dan sebelumnya (Kembali)
if($halaman_aktif > 1){
	$Kembali = $halaman_aktif-1;
	$link_halaman .= "<a href=javascript:move('1','$id') class='nextprev'>Awal</a>
                    <a href=javascript:move('$prev','$id') class='nextprev'>Kembali</a>";
}
else{ 
	$link_halaman .= "<span class='nextprev'>Awal</span><span class='nextprev'>Kembali</span>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? "<span class='nextprev'>...</span>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=javascript:move('$i','$id')>$i</a>";
  }
	  $angka .= "<span class='current'>$halaman_aktif</span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=javascript:move('$i','$id')>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<span class='nextprev'>...</span>
	  <a href=javascript:move('$jmlhalaman','$id')>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$Lanjut = $halaman_aktif+1;
	$link_halaman .= " <a href=javascript:move('$Lanjut','$id') class='nextprev'>Lanjut</a>
                     <a href=javascript:move('$jmlhalaman','$id') class='nextprev'>Akhir</a> ";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span><span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}













//SEMUA VIDEO///////////////////////////////////////////////////////////////////////
class Paging10{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halplaylist'])){
	$posisi=0;
	$_GET['halplaylist']=1;
}
else{
	$posisi = ($_GET['halplaylist']-1) * $batas;
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
	$link_halaman .= "<a href=halplaylist-1.html class='nextprev'>Awal</a> 
                    <a href=halplaylist-$prev.html class='nextprev'>Kembali</a>";
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
	  $angka .= "<a href=halplaylist-$i.html>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halplaylist-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class='nextprev'>...</span><a href=halplaylist-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halplaylist-$next.html class='nextprev' >Lanjut</a>
                     <a href=halplaylist-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}










// class paging untuk halaman video
class Paging11{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halvideo'])){
	$posisi=0;
	$_GET['halvideo']=1;
}
else{
	$posisi = ($_GET['halvideo']-1) * $batas;
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
	$link_halaman .= "<a href=halvideo-1.html class='nextprev'>Awal</a> 
                    <a href=halvideo-$prev.html class='nextprev'>Kembali</a>";
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
	  $angka .= "<a href=halvideo-$i.html>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halvideo-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class='nextprev'>...</span><a href=halvideo-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halvideo-$next.html class='nextprev' >Lanjut</a>
                     <a href=halvideo-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}







class Paging12{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halkomentarvideo'])){
	$posisi=0;
	$_GET['halkomentarvideo']=1;
}
else{
	$posisi = ($_GET['halkomentarvideo']-1) * $batas;
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
	$link_halaman .= "<a href=halkomentarvideo-1.html class='nextprev'>Awal</a> 
                    <a href=halkomentarvideo-$prev.html class='nextprev'>Kembali</a>";
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
	  $angka .= "<a href=halkomentarvideo-$i.html>$i</a>";
  }
	  $angka .= " <span class='current'><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halkomentarvideo-$i.html>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class='nextprev'>...</span><a href=halkomentarvideo-$jmlhalaman.html>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halkomentarvideo-$next.html class='nextprev' >Lanjut</a>
                     <a href=halkomentarvideo-$jmlhalaman.html class='nextprev'>Akhir</a>";
}
else{
	$link_halaman .= "<span class='nextprev'>Lanjut</span>
	<span class='nextprev'>Akhir</span>";
}
return $link_halaman;
}
}




?>
