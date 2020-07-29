<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CV_Controller extends CI_Controller {
	public $baseurl;
	public function __construct()
	{
		parent::__construct();
		$this->document->loadRenderer('head');
		$this->baseurl = $this->config->item('base_url');
	}
}