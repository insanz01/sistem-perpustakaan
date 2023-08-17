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

  public function get_all_books_filter($filter)
  {
    $query = "SELECT * FROM buku WHERE (DATE(created_at) BETWEEN $filter[filter_awal] AND $filter[filter_akhir]) OR (DATE(created_at) = $filter[filter_awal]) OR (DATE(created_at) = $filter[filter_akhir])";

    return $this->db->query($query)->result_array();
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
    $query = "SELECT buku.id, buku.kode_buku, buku.ISBN, buku.judul, buku.deskripsi, buku.gambar, buku.penulis, buku.penerbit, COUNT(log_buku_pinjam.id) as total_pinjam FROM buku JOIN log_buku_pinjam ON log_buku_pinjam.kode_buku = buku.kode_buku WHERE month(log_buku_pinjam.created_at) = month(now()) AND buku.id is not null GROUP BY log_buku_pinjam.kode_buku ORDER BY total_pinjam DESC";

    return $this->db->query($query)->result_array();
  }

  public function get_popular_book_filter($filter) {
    $query = "SELECT buku.id, buku.kode_buku, buku.ISBN, buku.judul, buku.deskripsi, buku.gambar, buku.penulis, buku.penerbit, COUNT(log_buku_pinjam.id) as total_pinjam FROM buku JOIN log_buku_pinjam ON log_buku_pinjam.kode_buku = buku.kode_buku WHERE month(log_buku_pinjam.created_at) = month(now()) AND buku.id is not null AND DATE(log_buku_pinjam.created_at) BETWEEN '$filter[filter_awal]' AND '$filter[filter_akhir]' GROUP BY log_buku_pinjam.kode_buku ORDER BY total_pinjam DESC";

    return $this->db->query($query)->result_array();
  }

  public function get_month_chart($current_month) {
    $query = "SELECT COUNT(log_buku_pinjam.id) as total_pinjam FROM log_buku_pinjam WHERE month(log_buku_pinjam.created_at) = $current_month";

    return $this->db->query($query)->row_array();
  }
}
