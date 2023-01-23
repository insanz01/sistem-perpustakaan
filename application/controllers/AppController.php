<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AppController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model("AppModel", 'app_m');

    if(!$this->session->userdata('SESS_SIPERPUS_USERID')) {
      redirect('auth');
    }
  }

  public function index()
  {
    $data['total_book'] = $this->app_m->total_book();
    $data['total_member'] = $this->app_m->total_member();
    $data['total_visitor_today'] = $this->app_m->total_visitor_today();
    $data['total_visitor_week'] = $this->app_m->total_visitor_week();

    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/dashboard', $data);
    $this->load->view('templates/panel/footer');
  }
}
