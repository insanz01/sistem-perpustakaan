<?php

class PrintController extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model("GuestBookModel", "guest_m");
    $this->load->model("LogModel", "log_m");
    $this->load->model("BookModel", "book_m");
  }

  public function index() {
    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/laporan/all');
    $this->load->view('templates/panel/footer');
  }

  public function print() {
    $filter = [
      "filter_awal" => $this->input->post("tanggal_mulai"),
      "filter_akhir" => $this->input->post("tanggal_akhir")
    ];

    $jenisLaporan = $this->input->post("jenis_laporan");

    switch($jenisLaporan) {
      case "BUKU_POPULER":
        $all_laporan = $this->book_m->get_popular_book();

        if($filter['filter_awal'] && $filter['filter_akhir']) {
          $all_laporan = $this->book_m->get_popular_book_filter($filter);
        }
        
        $data['filter'] = $filter;
        $data['all_laporan'] = $all_laporan;

        $filename = "app/print/buku_populer";
        break;
      case "BUKU_TAMU":
        $all_laporan = $this->guest_m->get_all_guests();

        if($filter['filter_awal'] && $filter['filter_akhir']) {
          $all_laporan = $this->guest_m->get_all_guests_filter($filter);
        }

        $data['filter'] = $filter;
        $data['all_laporan'] = $all_laporan;

        $filename = "app/print/buku_tamu";
        break;
      case "BUKU_TAMU_MEMBER":
        $all_laporan = $this->guest_m->get_all_guests_member();

        if($filter['filter_awal'] && $filter['filter_akhir']) {
          $all_laporan = $this->guest_m->get_all_guests_member_filter($filter);
        }

        $data['filter'] = $filter;
        $data['all_laporan'] = $all_laporan;

        $filename = "app/print/buku_tamu_member";
        break;
      case "LOG_PINJAM":
        $all_laporan = $this->log_m->get_all_log_pinjam();

        if($filter['filter_awal'] && $filter['filter_akhir']) {
          $all_laporan = $this->log_m->get_all_log_pinjam_filter($filter);
        }

        $data['filter'] = $filter;
        $data['all_laporan'] = $all_laporan;

        $filename = "app/print/log_pinjam";
        break;
      case "LOG_KEMBALI":
        $all_laporan = $this->log_m->get_all_log_kembali();

        if($filter['filter_awal'] && $filter['filter_akhir']) {
          $all_laporan = $this->log_m->get_all_log_kembali_filter($filter);
        }

        $data['filter'] = $filter;
        $data['all_laporan'] = $all_laporan;

        $filename = "app/print/log_kembali";
        break;
    }

    $this->load->view($filename, $data);
  }
}