<?php

class PrintController extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model("GuestBookModel", "guest_m");
    $this->load->model("LogModel", "log_m");
    $this->load->model("BookModel", "book_m");
    $this->load->model("MembershipModel", "member_m");
  }

  public function index() {
    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/laporan/all');
    $this->load->view('templates/panel/footer');
  }

  public function member($id) {
    $all_laporan = $this->log_m->get_all_riwayat_member($id);

    $member = $this->log_m->get_member_info($id);

    // if($filter['filter_awal'] && $filter['filter_akhir']) {
    //   $all_laporan = $this->log_m->get_all_log_kembali_filter($filter);
    // }

    $filter['filter_awal'] = null;
    $filter['filter_akhir'] = null;

    $data['filter'] = $filter;
    $data['all_laporan'] = $all_laporan;
    $data['member'] = $member;

    $filename = "app/print/riwayat_pinjam_member";
    $this->load->view($filename, $data);
  }

  public function print() {
    $filter = [
      "filter_awal" => $this->input->post("tanggal_mulai"),
      "filter_akhir" => $this->input->post("tanggal_akhir")
    ];

    $jenisLaporan = $this->input->post("jenis_laporan");

    switch($jenisLaporan) {
      case "RIWAYAT_PINJAM":
        $all_laporan = $this->book_m->get_popular_book();
        $all_chart = [];

        $month = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"];

        for($i = 1; $i <= 12; $i++) {
          $chart = $this->book_m->get_month_chart($i);
          array_push($all_chart, [
            "bulan" => $month[$i],
            "total_pinjam" => $chart['total_pinjam']
          ]);
        }

        if($filter['filter_awal'] && $filter['filter_akhir']) {
          $all_laporan = $this->book_m->get_popular_book_filter($filter);
        }
        
        $data['filter'] = $filter;
        $data['all_laporan'] = $all_laporan;
        $data['all_chart'] = $all_chart;

        // var_dump($data); die;

        $filename = "app/print/riwayat_peminjaman";
        break;
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
      case "DAFTAR_MEMBERSHIP":
        $all_laporan = $this->member_m->get_all_memberships();

        if($filter['filter_awal'] && $filter['filter_akhir']) {
          $all_laporan = $this->member_m->get_all_memberships_filter($filter);
        }

        $data['filter'] = $filter;
        $data['all_laporan'] = $all_laporan;

        $filename = "app/print/daftar_member";
        break;
      case "BUKU_PUSTAKA":
        $all_laporan = $this->book_m->get_all_books();

        if($filter['filter_awal'] && $filter['filter_akhir']) {
          $all_laporan = $this->book_m->get_all_books_filter($filter);
        }
        
        $data['filter'] = $filter;
        $data['all_laporan'] = $all_laporan;

        $filename = "app/print/buku_pustaka";
        break;
    }

    $this->load->view($filename, $data);
  }
}