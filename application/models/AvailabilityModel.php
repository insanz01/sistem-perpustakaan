<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AvailabilityModel extends CI_Model {
  public function __construct() {
    parent::__construct();
  }

  public function set_book_stock($book_id, $stock_value) {
    $data = [
      'id_buku' => $book_id,
      'stok' => $stock_value
    ];

    return $this->db->insert('ketersediaan', $data);
  }

  public function increase_stock($book_id) {
    $stock_book = $this->db->get_where('ketersediaan', ['id_buku', $book_id])->row_array();

    $new_stock = $stock_book['stok'] + 1;

    $this->db->set('stok', $new_stock);
    $this->db->where('id_buku', $book_id);
    $this->db->update('ketersediaan');

    return $this->db->affected_rows();
  }

  public function decrease_stock($book_id) {
    $stock_book = $this->db->get_where('ketersediaan', ['id_buku', $book_id])->row_array();

    $new_stock = $stock_book['stok'] - 1;

    if($new_stock < 0) {
      return false;
    }

    $this->db->set('stok', $new_stock);
    $this->db->where('id_buku', $book_id);
    $this->db->update('ketersediaan');

    return $this->db->affected_rows();
  }
}