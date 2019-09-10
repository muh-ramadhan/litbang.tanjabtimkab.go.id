<?php
function rupiah($s) {
    $d = array ('Rp.','.',',','-');
	$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
     return $s;
}
?>
