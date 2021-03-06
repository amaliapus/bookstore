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
		$site 				= $this->konfigurasi_model->listing();
		$listing_kategori	= $this->buku_model->listing_kategori();
		// Ambil data total
		$total 				= $this->buku_model->total_buku();
		// Paginasi start
		$this->load->library('pagination');
		
		$config['base_url'] 		= base_url().'/buku/index/';
		$config['total_rows'] 		= $total->total;
		$config['use_page_number']	= TRUE;
		$config['per_page'] 		= 18;
		$config['uri_segment'] 		= 3;
		$config['num_links'] 		= 5;
		$config['full_tag_open']	= '<ul class="pagination">';
		$config['full_tag_close'] 	= '</ul>';
		$config['first_link'] 		= 'First';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_link'] 		= 'Last';
		$config['last_tag_open'] 	= '<li class="disabled"><li class="active"><a href="#">';
		$config['last_tag_close'] 	= '<span class="sr-only"></a></li></li>';
		$config['next_link'] 		= '&gt;';
		$config['next_tag_open'] 	= '<div>';
		$config['next_tag_close'] 	= '</div>';
		$config['prev_link'] 		= '&lt;';
		$config['prev_tag_open'] 	= '<div>';
		$config['prev_tag_close'] 	= '</div>';
		$config['cur_tag_open'] 	= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$config['first_url']		= base_url().'/buku/';
		
		$this->pagination->initialize($config);
		// Ambil data buku
		$page  		= ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) * $config['per_page']:0;
		$buku  		= $this->buku_model->buku($config['per_page'],$page);
		// Paginasi end
 
		$data 	= array(	'title'				=> 'Buku '.$site->namaweb,
							'site' 				=> $site,
							'listing_kategori'	=> $listing_kategori,
							'buku' 				=> $buku,
							'pagin' 			=> $this->pagination->create_links(),
							'isi'				=> 'buku/list'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Detail buku
	public function detail($slug_buku)
	{
		$site 		= $this->konfigurasi_model->listing();
		$buku 		= $this->buku_model->read($slug_buku);
		$id_buku 	= $buku->id_buku;
		$gambar 	= $this->buku_model->gambar($id_buku);
		$buku_related = $this->buku_model->home();

		$data 	= array(	'title'				=> $buku->judul_buku,
							'site' 				=> $site,
							'buku' 				=> $buku,
							'buku_related' 		=> $buku_related,
							'gambar' 			=> $gambar,	
							'isi'				=> 'buku/detail'
						);
		$this->load->view('layout/wrapper', $data, FALSE);

	}

	// Listing data kategori produk (buku)
	public function kategori($slug_kategori)
	{
		// kategori detail
		$kategori 			= $this->kategori_model->read($slug_kategori);
		$id_kategori 		= $kategori->id_kategori;
		// Data global
		$site 				= $this->konfigurasi_model->listing();
		$listing_kategori	= $this->buku_model->listing_kategori();
		// Ambil data total
		$total 				= $this->buku_model->total_kategori($id_kategori);
		// Paginasi start
		$this->load->library('pagination');
		
		$config['base_url'] 		= base_url().'/buku/kategori/'.$slug_kategori. '/index/';
		$config['total_rows'] 		= $total->total;
		$config['use_page_number']	= TRUE;
		$config['per_page'] 		= 9;
		$config['uri_segment'] 		= 5;
		$config['num_links'] 		= 5;
		$config['full_tag_open']	= '<ul class="pagination">';
		$config['full_tag_close'] 	= '</ul>';
		$config['first_link'] 		= 'First';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_link'] 		= 'Last';
		$config['last_tag_open'] 	= '<li class="disabled"><li class="active"><a href="#">';
		$config['last_tag_close'] 	= '<span class="sr-only"></a></li></li>';
		$config['next_link'] 		= '&gt;';
		$config['next_tag_open'] 	= '<div>';
		$config['next_tag_close'] 	= '</div>';
		$config['prev_link'] 		= '&lt;';
		$config['prev_tag_open'] 	= '<div>';
		$config['prev_tag_close'] 	= '</div>';
		$config['cur_tag_open'] 	= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$config['first_url']		= base_url().'/buku/kategori/'.$slug_kategori;
		
		$this->pagination->initialize($config);
		// Ambil data buku
		$page  		= ($this->uri->segment(5)) ? ($this->uri->segment(5)-1) * $config['per_page']:0;
		$buku  		= $this->buku_model->kategori($id_kategori, $config['per_page'], $page);
		// Paginasi end
 
		$data 	= array(	'title'				=> $kategori->nama_kategori,
							'site' 				=> $site,
							'listing_kategori'	=> $listing_kategori,
							'buku' 				=> $buku,
							'pagin' 			=> $this->pagination->create_links(),
							'isi'				=> 'buku/list'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

}

/* End of file Buku.php */
/* Location: ./application/controllers/Buku.php */