<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function index()
	{
		parent::__construct();
		$this->load->model('buku_model');
		$this->load->model('kategori_model');
	}

}

/* End of file About.php */
/* Location: ./application/controllers/About.php */