<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing
	public function listing()
	{
		$query = $this->db->get('konfigurasi');
		return $query->row();
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_konfigurasi', $data['id_konfigurasi']);
		$this->db->update('konfigurasi', $data);
	}

	// Load menu kategori buku
	public function nav_buku()
	{
		$this->db->select('buku.*,
							kategori.nama_kategori,
							kategori.slug_kategori');
		$this->db->from('buku');
		// JOIN
		$this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left');
		// END JOIN
		$this->db->group_by('buku.id_kategori');
		$this->db->order_by('kategori.urutan', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

}

/* End of file Konfigurasi_model.php */
/* Location: ./application/models/Konfigurasi_model.php */