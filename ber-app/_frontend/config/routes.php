<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['kategori/(:any)'] = "berita/kategori/$1";
$route['kategori/(:any)/(:any)'] = "berita/kategori/$1";
$route['cariberita'] = "berita/cariberita";
$route['filemanager2'] = "ngadmin/fm";
