<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	// Load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('buku_model');
		$this->load->model('kategori_model');
		// Proteksi halaman
		$this->simple_login->cek_login();
	}

	// Data buku
	public function index()
	{
		$buku = $this->buku_model->listing();

		$data = array (	'title'		=> 'Data Buku',
						'buku'		=> $buku,
						'isi'		=> 'admin/buku/list'
					);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah buku
	public function tambah()
	{
		// Ambil dari kategori
		$kategori = $this->kategori_model->listing();

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('judul_buku','Judul Buku','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('kode_buku','Kode Buku','required|is_unique[buku.kode_buku]',
			array('required' 	=> '%s harus diisi',
					'is_unique' => '%s sudah ada. Buat kode baru!'));

		$valid->set_rules('penulis','Penulis','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('penerbit','Penerbit','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('harga','Harga','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('stock','Stock','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('berat','Berat','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('ukuran','Ukuran','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('keterangan','Keterangan','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('keywords','Keywords','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('status_buku','Status_buku','required',
			array('required' => '%s harus diisi'));


		if($valid->run()) {
			$config['upload_path']		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '5000';  // Dalam kb
			$config['max_width']  		= '5000';
			$config['max_height']  		= '5000';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar')){


		// End validasi

		$data = array(	'title' 	=> 'Tambah Buku',
						'kategori'  => $kategori,
						'error'  	=> $this->upload->display_errors(),
					  	'isi'	  	=> 'admin/buku/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			// Create thumbnail gambar
			$config['image_library']	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			// Lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250; // Pixel
			$config['height']       	= 250; // Pixel

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// End thumbnail gambar

			$i = $this->input;
			// Slug Buku
			$slug_buku = url_title($this->input->post('judul_buku').'-'.$this->input->post('kode_buku'), 'dash', TRUE);

			$data = array(	'id_user'			=> $this->session->userdata('id_user'),
							'id_kategori' 		=> $i->post('id_kategori'),
							'kode_buku' 		=> $i->post('kode_buku'),
						  	'judul_buku' 		=> $i->post('judul_buku'),
						  	'penulis' 			=> $i->post('penulis'),
						  	'penerbit' 			=> $i->post('penerbit'),
							'slug_buku' 		=> $slug_buku,
							'keterangan' 		=> $i->post('keterangan'),
							'keywords' 			=> $i->post('keywords'),
							'harga' 			=> $i->post('harga'),
							'stock' 			=> $i->post('stock'),
							// Disimpan judul file gambar
							'gambar' 			=> $upload_gambar['upload_data']['file_name'],
							'berat' 			=> $i->post('berat'),
							'ukuran' 			=> $i->post('ukuran'),
							'status_buku' 	=> $i->post('status_buku'),
							'tgl_post' 			=> date('Y-m-d H:i:s')
									);

			$this->buku_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/buku'),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 	=> 'Tambah Buku',
						'kategori'  => $kategori,
					  	'isi'	  	=> 'admin/buku/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Edit buku
	public function edit($id_buku)
	{
		// Ambil dari kategori
		$kategori = $this->kategori_model->listing();
		
		$buku = $this->buku_model->detail($id_buku);

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('judul_buku','Judul Buku','required',
			array('required' => '%s harus diisi'));

		$valid->set_rules('email','Email','required|valid_email',
			array(	'required' 		=> '%s harus diisi',
				  	'valid_email' 	=> '%s tidak valid'));

		$valid->set_rules('password','Password','required',
			array('required' => '%s harus diisi'));


		if($valid->run()===FALSE) {
		// End validasi

		$data = array(	'title' 	=> 'Tambah Buku',
						'buku' 		=> $buku,
					  	'isi'	  	=> 'admin/buku/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'id_buku'		=> $id_buku,
							'judul' 			=> $i->post('judul'),
						  	'email' 		=> $i->post('email'),
							'bukuname' 		=> $i->post('bukuname'),
							'password' 		=> SHA1($i->post('password')),
							'akses_level' 	=> $i->post('akses_level')
									);
			$this->buku_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/buku'),'refresh');
		}
		// End database
	}


	// Delete buku
	public function delete($id_buku)
	{
		$data = array('id_buku' => $id_buku);
		$this->buku_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/buku'),'refresh');
	}
}

/* End of file Buku.php */
/* Location: ./application/controllers/admin/Buku.php */