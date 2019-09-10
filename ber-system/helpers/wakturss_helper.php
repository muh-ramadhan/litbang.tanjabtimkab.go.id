<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
if ( ! function_exists('waktur_rss'))
{
function waktur_rss($date, $time = '00:00') {
    list($y, $m, $d) = explode('-', $date);
    list($h, $i) = explode(':', $time);

    return date('r', mktime($h,$i,0,$m,$d,$y));
}
}


