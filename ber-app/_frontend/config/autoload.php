<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array(APPPATH.'third_party');

$autoload['libraries'] = array('session','database','cart','form_validation','table');

$autoload['drivers'] = array();

$autoload['helper'] = array('url','captcha','form');

$autoload['config'] = array('general');

$autoload['language'] = array();

$autoload['model'] = array();
