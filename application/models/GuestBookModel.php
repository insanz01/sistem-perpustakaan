<?php

class GuestBookModel extends CI_Model {
  public function __construct() {
    parent::__construct();
  }

  public function get_all_guests() {
    return $this->db->get('bukutamu')->result_array();
  }

  public function get_all_guests_member() {
    return $this->db->get('bukutamu_membership')->result_array();
  }
}