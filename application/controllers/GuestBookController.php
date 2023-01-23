<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuestBookController extends CI_Controller {
  public function __construct() {
    parent::__construct();

    if(!$this->session->userdata('SESS_SIPERPUS_USERID')) {
      redirect('auth');
    }

    $this->load->model("GuestBookModel", "bukutamu_m");
  }

  public function index() {
    $data['tamu'] = $this->bukutamu_m->get_all_guests();

    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/buku_tamu/index', $data);
    $this->load->view('templates/panel/footer');
  }

  public function member() {
    $data['tamu'] = $this->bukutamu_m->get_all_guests_member();

    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/buku_tamu/member', $data);
    $this->load->view('templates/panel/footer');
  }
}