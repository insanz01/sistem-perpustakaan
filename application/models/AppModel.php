<?php

class AppModel extends CI_Model {
  public function __construct() {
    parent::__construct();
  }

  public function total_book() {
    $books = $this->db->get("buku")->result_array();

    return count($books);
  }

  public function total_member() {
    $members = $this->db->get("membership")->result_array();

    return count($members);
  }

  public function total_visitor_today() {
    $query = "SELECT * FROM bukutamu WHERE created_at = CURDATE()";
    $visitors = $this->db->query($query)->result_array();

    $queryMember = "SELECT * FROM bukutamu_membership WHERE created_at = CURDATE()";
    $member_visitors = $this->db->query($query)->result_array();

    return count($visitors) + count($member_visitors);
  }

  public function total_visitor_week() {
    $query = "SELECT * FROM bukutamu WHERE created_at = CURDATE()";
    $visitors = $this->db->query($query)->result_array();

    $queryMember = "SELECT * FROM bukutamu_membership WHERE created_at = CURDATE()";
    $member_visitors = $this->db->query($query)->result_array();

    return count($visitors) + count($member_visitors);
  }
}