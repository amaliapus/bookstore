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

	// Gambar
	public function gambar($id_buku)
	{
		$buku = $this->buku_model->detail($id_buku);
		$gambar = $this->buku_model->gambar($id_buku);

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('judul_gambar','Judul/Nama Gambar','required',
			array('required' => '%s harus diisi'));

		if($valid->run()) {
			$config['upload_path']		= './assets/upload/image';
			$config['allowed_types'] 	= 'gif|jpg|png|JPG|jpeg';
			$config['max_size']  		= '5000';  // Dalam kb
			$config['max_width']  		= '5000';
			$config['max_height']  		= '5000';
			
			$this->load->library('upload', $config);
				
			if ( ! $this->upload->do_upload('gambar')){
			// End validasi

			$data = array(	'title' 	=> 'Tambah Gambar Buku: ' .$buku->judul_buku,
							'buku'  	=> $buku,
							'gambar'  	=> $gambar,
							'error'  	=> $this->upload->display_errors(),
						  	'isi'	  	=> 'admin/buku/gambar'
						  );
		$this->load->view('admin/layout/wrapper', $data, FALSE);
			// Masuk database
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			// Create thumbnail gambar
			$config['image_library']	= 'gd2';
			$config['source_image'] 	= './assets/upload/image'.$upload_gambar['upload_data']['file_name'];
			// Lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/thumbs';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250; // Pixel
			$config['height']       	= 250; // Pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// End create thumbnail gambar

			$i = $this->input;


			$data = array(	'id_buku'  			=> $id_buku,
							'judul_gambar'  	=> $i->post('judul_gambar'),
							// Disimpan judul file gambar
							'gambar' 			=> $upload_gambar['upload_data']['file_name']
									);

			$this->buku_model->tambah_gambar($data);
			$this->session->set_flashdata('sukses', 'Data gambar telah ditambah');
			redirect(base_url('admin/buku/gambar/'.$id_buku),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 	=> 'Tambah Gambar Buku: ' .$buku->judul_buku,
						'buku'  	=> $buku,
						'gambar'  	=> $gambar,
					  	'isi'	  	=> 'admin/buku/gambar');
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

		if($valid->run()) {
			$config['upload_path']		= './assets/upload/image';
			$config['allowed_types'] 	= 'gif|jpg|png|JPG|jpeg';
			$config['max_size']  		= '5000';  // Dalam kb
			$config['max_width']  		= '5000';
			$config['max_height']  		= '5000';
			
			$this->load->library('upload', $config);
				
			if ( ! $this->upload->do_upload('gambar')){
			// End validasi

			$data = array(	'title' 	=> 'Tambah Buku',
							'kategori'  => $kategori,
							'error'  	=> $this->upload->display_errors(),
						  	'isi'	  	=> 'admin/buku/tambah'
						  );
		$this->load->view('admin/layout/wrapper', $data, FALSE);
			// Masuk database
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			// Create thumbnail gambar
			$config['image_library']	= 'gd2';
			$config['source_image'] 	= './assets/upload/image'.$upload_gambar['upload_data']['file_name'];
			// Lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/thumbs';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250; // Pixel
			$config['height']       	= 250; // Pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// End create thumbnail gambar

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
							'status_buku' 		=> $i->post('status_buku'),
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
		// Ambil data kategori yang akan diedit
		$kategori = $this->kategori_model->listing();
		
		$buku = $this->buku_model->detail($id_buku);

		// Validasi input
		$valid = $this->form_validation;

		$valid->set_rules('judul_buku','Judul Buku','required',
			array('required' => '%s harus diisi'));


		if($valid->run()) {
			// Check jika gambar diganti
			if(!empty($_FILES['gambar']['name'])) {

			$config['upload_path']		= './assets/upload/image';
			$config['allowed_types'] 	= 'gif|jpg|png|JPG|jpeg';
			$config['max_size']  		= '5000';  // Dalam kb
			$config['max_width']  		= '5000';
			$config['max_height']  		= '5000';
			
			$this->load->library('upload', $config);
				
			if (! $this->upload->do_upload('gambar')){
			// End validasi

			$data = array(	'title' 	=> 'Edit Buku: ' .$buku->judul_buku,
							'kategori'  => $kategori,
							'buku' 		=> $buku, 
							'error'  	=> $this->upload->display_errors(),
						  	'isi'	  	=> 'admin/buku/edit');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			// Masuk database
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			// Create thumbnail gambar
			$config['image_library']	= 'gd2';
			$config['source_image'] 	= './assets/upload/image'.$upload_gambar['upload_data']['file_name'];
			// Lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/thumbs';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250; // Pixel
			$config['height']       	= 250; // Pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			// End create thumbnail gambar

			$i = $this->input;
			// Slug Buku
			$slug_buku = url_title($this->input->post('judul_buku').'-'.$this->input->post('kode_buku'), 'dash', TRUE);

			$data = array(	'id_buku'			=> $id_buku,
							'id_user'			=> $this->session->userdata('id_user'),
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
							// Disimpan nama file gambar
							'gambar' 			=> $upload_gambar['upload_data']['file_name'],
							'berat' 			=> $i->post('berat'),
							'ukuran' 			=> $i->post('ukuran'),
							'status_buku' 		=> $i->post('status_buku')
									);

			$this->buku_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/buku'),'refresh');
		}}else{
			// Edit buku tanpa ganti gambar
			$i = $this->input;
			// Slug Buku
			$slug_buku = url_title($this->input->post('judul_buku').'-'.$this->input->post('kode_buku'), 'dash', TRUE);

			$data = array(	'id_buku'			=> $id_buku,
							'id_user'			=> $this->session->userdata('id_user'),
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
							// Disimpan nama file gambar (gambar tifak diganti)
							// 'gambar' 			=> $upload_gambar['upload_data']['file_name'],
							'berat' 			=> $i->post('berat'),
							'ukuran' 			=> $i->post('ukuran'),
							'status_buku' 		=> $i->post('status_buku')
									);

			$this->buku_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/buku'),'refresh');
		}}
		// End masuk database
		$data = array(	'title' 	=> 'Edit Buku: ' .$buku->judul_buku,
						'kategori'  => $kategori,
						'buku'		=> $buku,
					  	'isi'	  	=> 'admin/buku/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Delete buku
	public function delete($id_buku)
	{
		// Hapus gambar
		$gambar = $this->buku_model->detail_gambar($id_gambar);
		unlink('./assets/upload/image/'.$gambar->gambar);
		// unlink('./assets/upload/image/thumbs/'.$gambar->gambar);
		// End hapus gambar

		$data = array('id_buku' => $id_buku);
		$this->buku_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/buku'),'refresh');
	}

	// Delete gambar buku
	public function delete_gambar($id_buku,$id_gambar)
	{
		// Hapus gambar
		$gambar = $this->buku_model->detail_gambar($id_gambar);
		unlink('./assets/upload/image/'.$gambar->gambar);
		// unlink('./assets/upload/image/thumbs/'.$gambar->gambar);
		// End hapus gambar

		$data = array('id_gambar' => $id_gambar);
		$this->buku_model->delete_gambar($data);
		$this->session->set_flashdata('sukses', 'Data gambar telah dihapus');
		redirect(base_url('admin/buku/gambar/' .$id_buku),'refresh');
	}
}

/* End of file Buku.php */
/* Location: ./application/controllers/admin/Buku.php */