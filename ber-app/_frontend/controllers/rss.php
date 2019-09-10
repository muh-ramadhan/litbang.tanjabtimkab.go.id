<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rss extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('xml','text','url'));
		$this->load->model("mdl_rss");
    }
	
	public function index()
	{

		$data = array(
			'encoding' 			=> 'utf-8',
			'feed_name' 		=> 'Tutorial-webdesign.com',
			'feed_url' 			=> 'http://www.tutorial-webdesign.com/feed/',
			'page_description' 	=> 'Web Design & Development + Graphic Design Indonesia',
			'page_language' 	=> 'en-ca',
			'creator_email' 	=> 'tut.webdesign@gmail.com',
			//'posts' 			=> $this->mdl_rss->get_posts(10)
		);
$data["posts"]=$this->mdl_rss->get_posts(10);

		header("Content-Type: application/rss+xml");
		$this->load->vars($data);
		$this->load->view('rss');
	}
}

