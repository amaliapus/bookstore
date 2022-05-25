<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	// Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
		// Proteksi halaman
		$this->simple_login->cek_login();
	}

	// Data produk
	public function index()
	{
		$produk = $this->produk_model->listing();

		$data = array (	'title'		=> 'Data Produk',
						'produk'	=> $produk,
						'isi'		=> 'admin/produk/list'
					);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah produk
	public function tambah()
	{
		// Ambil dari kategori
		$kategori = $this->kategori_model->listing();

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama','Nama lengkap','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('email','Email','required|valid_email',
			array(	'required' 		=> '%s harus diisi',
				  	'valid_email' 	=> '%s tidak valid'));

		$valid->set_rules('produkname','Produkname','required|min_length[6]|max_length[32]|is_unique[produk.produkname]',
			array(	'required' 		=> '%s harus diisi',
				    'min_length' 	=> '%s minimal 6 karakter',
				    'max_length'	=> '%s maksimal 32 karakter',
				    'is_unique' 	=> '%s sudah ada. Buat produkname baru.'));

		$valid->set_rules('password','Password','required',
			array('required' => '%s harus diisi'));


		if($valid->run()===FALSE) {
		// End validasi

		$data = array(	'title' 	=> 'Tambah Produk',
						'kategori'  => $kategori,
					  	'isi'	  	=> 'admin/produk/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'nama' 			=> $i->post('nama'),
						  	'email' 		=> $i->post('email'),
							'produkname' 		=> $i->post('produkname'),
							'password' 		=> SHA1($i->post('password')),
							'akses_level' 	=> $i->post('akses_level')
									);
			$this->produk_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/produk'),'refresh');
		}
		// End database
	}


	// Edit produk
	public function edit($id_produk)
	{
		$produk = $this->produk_model->detail($id_produk);

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama','Nama lengkap','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('email','Email','required|valid_email',
			array(	'required' 		=> '%s harus diisi',
				  	'valid_email' 	=> '%s tidak valid'));

		$valid->set_rules('password','Password','required',
			array('required' => '%s harus diisi'));


		if($valid->run()===FALSE) {
		// End validasi

		$data = array(	'title' 	=> 'Tambah Produk',
						'produk' 		=> $produk,
					  	'isi'	  	=> 'admin/produk/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'id_produk'		=> $id_produk,
							'nama' 			=> $i->post('nama'),
						  	'email' 		=> $i->post('email'),
							'produkname' 		=> $i->post('produkname'),
							'password' 		=> SHA1($i->post('password')),
							'akses_level' 	=> $i->post('akses_level')
									);
			$this->produk_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/produk'),'refresh');
		}
		// End database
	}


	// Delete produk
	public function delete($id_produk)
	{
		$data = array('id_produk' => $id_produk);
		$this->produk_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/produk'),'refresh');
	}
}

/* End of file Produk.php */
/* Location: ./application/controllers/admin/Produk.php */