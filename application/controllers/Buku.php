<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('buku_model');
		$this->load->model('kategori_model');
	}

	// Listing data produk (buku)
	public function index()
	{
		$site 	= $this->konfigurasi_model->listing();

		$data 	= array(	'title'		=> 'Buku '.$site->namaweb,
							'isi'		=> 'buku/list'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

}

/* End of file Buku.php */
/* Location: ./application/controllers/Buku.php */