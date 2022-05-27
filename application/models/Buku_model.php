<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing all buku
	public function listing()
	{
		$this->db->select('buku.*,
							user.nama,
							kategori.id_kategori,
							kategori.nama_kategori,
							kategori.slug_kategori,
							COUNT(gambar.id_gambar) AS total_gambar');
		$this->db->from('buku');
		// JOIN
		$this->db->join('user', 'user.id_user = buku.id_user', 'left');
		$this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left');
		$this->db->join('gambar', 'gambar.id_buku = buku.id_buku', 'left');
		// END JOIN
		$this->db->group_by('buku.id_buku');
		$this->db->order_by('id_buku', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail buku
	public function detail($id_buku)
	{
		$this->db->select('*');
		$this->db->from('buku');
		$this->db->where('id_buku', $id_buku);
		$this->db->order_by('id_buku', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail gambar buku
	public function detail_gambar($id_gambar)
	{
		$this->db->select('*');
		$this->db->from('gambar');
		$this->db->where('id_gambar', $id_gambar);
		$this->db->order_by('id_gambar', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Gambar
	public function gambar($id_buku)
	{
		$this->db->select('*');
		$this->db->from('gambar');
		$this->db->where('id_buku', $id_buku);
		$this->db->order_by('id_gambar', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Tambah gambar
	public function tambah_gambar($data)
	{
		$this->db->insert('gambar', $data);
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('buku', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_buku', $data['id_buku']);
		$this->db->update('buku', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_buku', $data['id_buku']);
		$this->db->delete('buku', $data);
	}

	// Delete gambar
	public function delete_gambar($data)
	{
		$this->db->where('id_gambar', $data['id_gambar']);
		$this->db->delete('gambar', $data);
	}
}

/* End of file Buku_model.php */
/* Location: ./application/models/Buku_model.php */