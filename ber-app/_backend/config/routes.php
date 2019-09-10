<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
$route['default_controller'] = 'login';
$route['404_override'] = 'my404';
//$route['translate_uri_dashes'] = FALSE;

$route['filemanager'] = "fil3manag3r";
$route['berita/page/(:any)'] = "berita/index/$1";


//$route['filemanager'] = "ngadmin/fm";
