<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('seo_link'))
{
	function seo_link($judul)
	{
		$d = array (',','-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
		$judul = str_replace($d, '', $judul);
		$judul=strtolower(str_replace(' ','-',$judul));
		return $judul;
	}
}



