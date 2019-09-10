<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('seo_link'))
{
	function seo_link($s)
	{
		$c = array (' ');
		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

		$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
		
		$s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
		return $s;
	}
}


if ( ! function_exists('seo_image'))
{
	function seo_image($s) {
		$c = array (' ');
		$d = array ('-','/','\\',',','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

		$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
		
		$s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
		return $s;
	}
}



