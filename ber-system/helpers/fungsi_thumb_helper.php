<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('uploadlamp'))
{
 
function UploadFoto($imagefile_name,$path,$lebar,$inputname){
   
  //$vdir_upload = "../../../produk/$path/";
  $vdir_upload = "$path";
  $vfile_upload = $vdir_upload . $imagefile_name;
  $imageType = $_FILES["".$inputname.""]["type"];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["$inputname"]["tmp_name"], $vfile_upload);

  //identitas file asli
  switch($imageType) {
		case "image/gif":
			$im_src=imagecreatefromgif($vfile_upload); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$im_src=imagecreatefromjpeg($vfile_upload); 
			break;
	    case "image/png":
		case "image/x-png":
			$im_src=imagecreatefrompng($vfile_upload); 
			break;
  }
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi besar 660 pixel
  //Set ukuran gambar hasil perubahan
  if($src_width>=$lebar){
  $dst_width = $lebar;
  } else {
  $dst_width = $src_width;
  }
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
   
  //Simpan gambar
  switch($imageType) {
		case "image/gif":
  			imagegif($im,$vdir_upload.$imagefile_name,100);
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
  			imagejpeg($im,$vdir_upload.$imagefile_name,100);
			break;
	    case "image/png":
		case "image/x-png":
  			imagepng($im,$vdir_upload.$imagefile_name,100);
			break;
  }


  //Simpan dalam versi small 200 pixel
  //Set ukuran gambar hasil perubahan

  $dst_width2 = 300;
  $dst_height2 = ($dst_width2/$src_width)*$src_height;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  switch($imageType) {
		case "image/gif":
  			imagegif($im2,$vdir_upload . "small_" . $imagefile_name,90);
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
  			imagejpeg($im2,$vdir_upload . "small_" . $imagefile_name,90);
			break;
	    case "image/png":
		case "image/x-png":
  			imagepng($im2,$vdir_upload . "small_" . $imagefile_name,90);
			break;
  }
  
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im2);
  //imagedestroy($im3);
} 

// Upload gambar untuk favicon
function UploadLogo($imagefile_name,$path,$lebar,$inputname){ 
	$vdir_upload = "$path";
	$vfile_upload = $vdir_upload . $imagefile_name;
	$imageType = $_FILES["".$inputname.""]["type"]; 
	move_uploaded_file($_FILES["$inputname"]["tmp_name"], $vfile_upload);
} 

// Upload lampiran
function UploadLampiran($imagefile_name,$path,$lebar,$inputname){ 
	$vdir_upload = "$path";
	$vfile_upload = $vdir_upload . $imagefile_name;
	$imageType = $_FILES["".$inputname.""]["type"]; 
	move_uploaded_file($_FILES["$inputname"]["tmp_name"], $vfile_upload);
} 

}

 

