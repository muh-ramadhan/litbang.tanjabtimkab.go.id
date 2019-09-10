<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {


function __construct() {
parent::__construct();
$this->load->helper('xml');
$this->load->helper('text');
$this->load->helper('url');
$this->load->model('m_data','posts');
$this->load->helper('wakturss');
}

function index() {
$data['feed_name'] = 'Official Website Kab. Tanjung Jabung Timur'; // your website
$data['encoding'] = 'utf-8'; // the encoding
$data['feed_url'] = 'http://www.tanjabtimkab.go.id/feed'; // the url to your feed
$data['page_description'] = 'Portal Website Kab. Tanjung Jabung Timur sebagai Media Informasi dan Publikasi tentang Kab. Tanjab Timur.'; // some description
$data['page_language'] = 'en-en'; // the language
$data['creator_email'] = 'bermultimedia@gmail.com'; // your email
$data['posts'] = $this->posts->getPosts(10);
header("Content-Type: application/rss+xml"); // important!
$this->load->view('rss', $data);
}


     
}