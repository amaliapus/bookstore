<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	// Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('buku_model');
		$this->load->model('kategori_model');
		$this->load->model('konfigurasi_model');
	}

	// Halaman Utama Website - Homepage
	public function index()
	{
		$site = $this->konfigurasi_model->listing();
		$kategori = $this->konfigurasi_model->nav_buku();
		$buku = $this->buku_model->home();

		$data = array( 		'title'		=> $site->namaweb.' | '.$site->tagline,
							'keywords'	=> $site->keywords,
							'deskripsi'	=> $site->deskripsi,
							'site'		=> $site,
							'kategori'	=> $kategori,
							'buku'		=> $buku,
							'isi'		=> 'home/list'
						);
		$this->load->view('layout/wrapper', $data, FALSE ); 
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */