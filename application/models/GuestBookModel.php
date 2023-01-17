<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuestBookModel extends CI_Model {
  public function __construct() {
    parent::__construct();
  }

  public function get_all_guests() {
    return $this->db->get('bukutamu')->result_array();
  }

  public function get_all_guests_member() {
    $query = "SELECT membership.kode_member, membership.nama_lengkap, bukutamu_membership.created_at FROM bukutamu_membership JOIN membership ON bukutamu_membership.id_member = membership.id";
    
    return $this->db->query($query)->result_array();
  }
}