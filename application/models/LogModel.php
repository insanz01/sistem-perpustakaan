<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LogModel extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  private function is_member_exists($kode_member)
  {
    $user = $this->db->get_where('membership', ['kode_member' => $kode_member])->row_array();

    if (empty($user)) {
      return false;
    }

    return true;
  }

  private function is_book_exists($kode_buku)
  {
    $book = $this->db->get_where('buku', ['kode_buku' => $kode_buku])->row_array();

    if (empty($book)) {
      return false;
    }

    return true;
  }

  public function add_log_keluar($data)
  {
    $tanggal_sekarang = date('Y-m-d');
    $batas_pinjam = date_create($tanggal_sekarang);
    date_add($batas_pinjam, date_interval_create_from_date_string("7 days"));

    $data['batas_pinjam'] = date_format($batas_pinjam, 'Y-m-d');

    if (!$this->is_member_exists($data['kode_member'])) {
      return false;
    }

    if (!$this->is_book_exists($data['kode_buku'])) {
      return false;
    }
    
    return $this->db->insert("log_buku_pinjam", $data);
  }

  public function add_log_masuk($data)
  {
    $query = "SELECT log_buku_pinjam.id, log_buku_pinjam.kode_buku, log_buku_pinjam.kode_member, log_buku_pinjam.batas_pinjam, log_buku_pinjam.created_at FROM log_buku_pinjam WHERE log_buku_pinjam.kode_member = '$data[kode_member]' AND log_buku_pinjam.kode_buku = '$data[kode_buku]' ORDER BY log_buku_pinjam.id DESC LIMIT 1";

    $log_buku_pinjam = $this->db->query($query)->row_array();

    $today_date = date("Y-m-d", time());
    $expire_date = date("Y-m-d", strtotime($log_buku_pinjam['batas_pinjam']));

    $data_kembali = [
      'kode_buku' => $data['kode_buku'],
      'kode_member' => $data['kode_member'],
      'log_buku_pinjam_id' => $log_buku_pinjam['id'],
      'terlambat' => false
    ];

    if($expire_date < $today_date) {
      $data_kembali['terlambat'] = true;
    }

    return $this->db->insert("log_buku_kembali", $data_kembali);
  }

  public function get_all_riwayat_member($id) {
    $query = "SELECT b.id, b.kode_buku, b.ISBN, b.judul, b.deskripsi, b.gambar, b.penerbit, b.penulis, lbk.terlambat, lbj.created_at FROM log_buku_pinjam lbj JOIN membership m ON lbj.kode_member = m.kode_member LEFT JOIN log_buku_kembali lbk ON lbk.log_buku_pinjam_id = lbj.id JOIN buku b ON b.kode_buku = lbk.kode_buku WHERE m.id = $id";

    return $this->db->query($query)->result_array();
  }

  public function get_member_info($id) {
    return $this->db->get_where("membership", ["id" => $id])->row_array();
  }

  public function get_all_log_kembali() {
    $query = "SELECT log_buku_kembali.id, buku.kode_buku, buku.ISBN, buku.judul, membership.kode_member, membership.nama_lengkap, log_buku_kembali.terlambat, log_buku_kembali.created_at FROM log_buku_kembali JOIN buku ON log_buku_kembali.kode_buku = buku.kode_buku JOIN membership ON log_buku_kembali.kode_member = membership.kode_member;";

    return $this->db->query($query)->result_array();
  }

  public function get_all_log_kembali_filter($filter) {
    $query = "SELECT log_buku_kembali.id, buku.kode_buku, buku.ISBN, buku.judul, membership.kode_member, membership.nama_lengkap, log_buku_kembali.terlambat, log_buku_kembali.created_at FROM log_buku_kembali JOIN buku ON log_buku_kembali.kode_buku = buku.kode_buku JOIN membership ON log_buku_kembali.kode_member = membership.kode_member WHERE DATE(log_buku_pinjam.created_at) BETWEEN '$filter[filter_awal]' AND '$filter[filter_akhir]'";

    return $this->db->query($query)->result_array();
  }

  public function get_all_log_pinjam() {
    $query = "SELECT log_buku_pinjam.id, buku.kode_buku, buku.ISBN, buku.judul, membership.kode_member, membership.nama_lengkap, log_buku_pinjam.created_at FROM log_buku_pinjam JOIN buku ON log_buku_pinjam.kode_buku = buku.kode_buku JOIN membership ON log_buku_pinjam.kode_member = membership.kode_member";

    return $this->db->query($query)->result_array();
  }

  public function get_all_log_pinjam_filter($filter) {
    $query = "SELECT log_buku_pinjam.id, buku.kode_buku, buku.ISBN, buku.judul, membership.kode_member, membership.nama_lengkap, log_buku_pinjam.created_at FROM log_buku_pinjam JOIN buku ON log_buku_pinjam.kode_buku = buku.kode_buku JOIN membership ON log_buku_pinjam.kode_member = membership.kode_member WHERE DATE(log_buku_pinjam.created_at) BETWEEN '$filter[filter_awal]' AND '$filter[filter_akhir]'";

    return $this->db->query($query)->result_array();
  }

  public function get_book_by_kode($kode_buku) {
    $book = $this->db->get_where('buku', ['kode_buku' => $kode_buku])->row_array();

    return $book['id'];
  }
}
