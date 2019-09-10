<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function desa_ku($deso){
			$prova = substr($deso,0,2);
			$kaba = substr($deso,3,2);
			$keca = substr($deso,6,2);
			$desaa = substr($deso,9,4);
			return $prova.''.$kaba.''.$keca.''.$desaa;

	
	}	
	
		function desa_nya($deso){
			$provi = substr($deso,0,2);
			$kabi = substr($deso,2,2);
			$keci = substr($deso,5,2);
			$desai = substr($deso,8,4);
			return $provi.'.'.$kabi.'.'.$keci.'.'.$desai;

	
	}	
			function desa_lagi($deso){
			$provia = substr($deso,0,2);
			$kabia = substr($deso,2,2);
			$kecia = substr($deso,4,2);
			$desaia = substr($deso,6,4);
			return $provia.'.'.$kabia.'.'.$kecia.'.'.$desaia;

	
	}
	
	function keca($deso){
			$provii = substr($deso,0,2);
			$kabii = substr($deso,3,2);
			$kecii = substr($deso,6,2);
			//$desai = substr($deso,8,4);
			return $provii.'.'.$kabii.'.'.$kecii;

	
	}	
	
	function kecaa($deso){
			$proviii = substr($deso,0,2);
			$kabiii = substr($deso,2,2);
			$keciii = substr($deso,4,2);
			//$desai = substr($deso,8,4);
			return $proviii.'.'.$kabiii.'.'.$keciii;

	
	}



