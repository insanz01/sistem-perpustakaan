<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookModel extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  private function generate_kode()
  {
    $exists = $this->db->get('buku')->result_array();
    if (empty($exists)) {
      return 'BK_000001';
    }

    $id_string = (string)(end($exists)['id']+1);
    $strlen = strlen($id_string);

    $kode = "";

    for ($i = 0; $i < 6 - $strlen; $i++) {
      $kode .= "0";
    }

    $kode .= $id_string;

    return 'BK_' . $kode;
  }

  public function save_book($data)
  {
    $data['kode_buku'] = $this->generate_kode();

    $this->db->insert('buku', $data);

    return $this->db->insert_id();
  }

  public function get_all_books()
  {
    return $this->db->get('buku')->result_array();
  }

  public function get_single_book($id)
  {
    return $this->db->get_where('buku', ['id' => $id])->row_array();
  }

  public function delete_book($id)
  {
    return $this->db->delete('buku', ['id' => $id]);
  }

  public function update_book($data, $id)
  {
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update('buku');

    return $this->db->affected_rows();
  }

  public function get_popular_book() {
    $query = "SELECT buku.id, buku.kode_buku, buku.ISBN, buku.judul, buku.deskripsi, buku.gambar, buku.penulis, COUNT(log_buku_pinjam.id) as total_pinjam FROM buku JOIN log_buku_pinjam ON log_buku_pinjam.kode_buku = buku.kode_buku WHERE month(log_buku_pinjam.created_at) = month(now()) AND buku.id is not null ORDER BY total_pinjam DESC";

    return $this->db->query($query)->result_array();
  }
}
