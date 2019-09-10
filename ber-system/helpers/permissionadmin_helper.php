<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('permissionadmin'))
{
	function permissionadmin($controller,$id_session) {
	
		$ci =& get_instance(); 
		$query = $ci->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='".$id_session."' AND modul.link='".$controller."'");
		$cek = $query->num_rows(); 
		return $cek;  
	} 
} 