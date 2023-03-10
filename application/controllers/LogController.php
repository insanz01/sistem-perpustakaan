<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LogController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    if(!$this->session->userdata('SESS_SIPERPUS_USERID')) {
      redirect('auth');
    }

    $this->load->model("LogModel", "log_m");
    $this->load->model("MembershipModel", "membership_m");
    $this->load->model("BookModel", "book_m");
    $this->load->model("AvailabilityModel", "avail_m");
  }

  // pengembalian buku
  public function log_masuk()
  {
    $data['memberships'] = $this->membership_m->get_all_memberships();
    $data['books'] = $this->book_m->get_all_books();
    
    $data['logs'] = $this->log_m->get_all_log_kembali();

    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/log/masuk', $data);
    $this->load->view('templates/panel/footer');
  }

  public function add_log_masuk()
  {
    $data = $this->input->post();

    if($this->log_m->add_log_masuk($data)) {
      $book_id = $this->log_m->get_book_by_kode($data['kode_buku']);

      if($this->avail_m->increase_stock($book_id)) {
        $this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Berhasil tambah data dan berhasil menambah stok</div>");
      } else {
        $this->session->set_flashdata('pesan', "<div class='alert alert-danger' role='alert'>Berhasil tambah data dan gagal menambah stok</div>");
      }
    } else {
      $this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Gagal tambah data</div>");
    }
    
    redirect("log/kembali");
  }

  // peminjaman buku
  public function log_keluar()
  {
    $data['memberships'] = $this->membership_m->get_all_memberships();
    $data['books'] = $this->book_m->get_all_books();

    $data['logs'] = $this->log_m->get_all_log_pinjam();

    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/log/keluar', $data);
    $this->load->view('templates/panel/footer');
  }

  public function add_log_keluar()
  {
    $data = $this->input->post();

    if($this->log_m->add_log_keluar($data)) {
      $book_id = $this->log_m->get_book_by_kode($data['kode_buku']);

      if($this->avail_m->decrease_stock($book_id)) {
        $this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Berhasil tambah data dan mengurangi menambah stok</div>");
      } else {
        $this->session->set_flashdata('pesan', "<div class='alert alert-danger' role='alert'>Stok habis</div>");
      }
    } else {
      $this->session->set_flashdata('pesan', "<div class='alert alert-success' role='alert'>Gagal tambah data</div>");
    }

    redirect("log/pinjam");
  }
}
