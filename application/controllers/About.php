<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('buku_model');
		$this->load->model('kategori_model');
	}

	// Halaman Utama Website - Homepage
	public function index()
	{
		$site = $this->konfigurasi_model->listing();
		$kategori = $this->konfigurasi_model->nav_buku();

		$data = array( 		'title'		=> $site->namaweb.' | '.$site->tagline,
							'keywords'	=> $site->keywords,
							'deskripsi'	=> $site->deskripsi,
							'site'		=> $site,
							'kategori'	=> $kategori,
							// 'buku'		=> $buku,
							'isi'		=> 'about/list'
						);
		$this->load->view('layout/wrapper', $data, FALSE ); 
	}
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */