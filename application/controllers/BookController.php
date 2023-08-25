<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    if(!$this->session->userdata('SESS_SIPERPUS_USERID')) {
      redirect('auth');
    }

    $this->load->model('BookModel', 'book_m');
    $this->load->model('AvailabilityModel', 'avail_m');
  }

  public function index()
  {
    $data['books'] = $this->book_m->get_all_books();

    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/buku/index', $data);
    $this->load->view('templates/panel/footer');
  }

  public function popular_book() {
    $data['books'] = $this->book_m->get_popular_book();

    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/buku/popular', $data);
    $this->load->view('templates/panel/footer');
  }

  public function add_book()
  {
    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/buku/add');
    $this->load->view('templates/panel/footer');
  }

  public function do_add_book()
  {
    $data = [
      'ISBN' => $this->input->post('ISBN'),
      'judul' => $this->input->post('judul'),
      'deskripsi' => $this->input->post('deskripsi'),
      'penulis' => $this->input->post('penulis'),
      'penerbit' => $this->input->post('penerbit'),
      'lemari' => $this->input->post('lemari'),
      'rak' => $this->input->post('rak')
    ];

    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    // $config['max_size']             = 100;
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('gambar'))
    {
      $error = array('error' => $this->upload->display_errors());

      var_dump($error); die;
    }
    else
    {
      $imageData = array('upload_data' => $this->upload->data());

      $data['gambar'] = $imageData['upload_data']['file_name'];
    }

    $book_id = $this->book_m->save_book($data);

    if ($this->avail_m->set_book_stock($book_id, $this->input->post('stok'))) {
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil menambahkan data book</div>');
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal menambahkan data book</div>');
    }

    redirect('buku');
  }

  public function edit_book($id)
  {
    $data['buku'] = $this->book_m->get_single_book($id);

    $this->load->view('templates/panel/header');
    $this->load->view('templates/panel/sidebar');
    $this->load->view('templates/panel/navbar');
    $this->load->view('app/buku/edit', $data);
    $this->load->view('templates/panel/footer');
  }

  public function do_update_book()
  {
    $id = $this->input->post('id');
    $data = [
      'ISBN' => $this->input->post("ISBN"),
      'judul' => $this->input->post("judul"),
      'deskripsi' => $this->input->post("deskripsi"),
      'penulis' => $this->input->post("penulis"),
      'lemari' => $this->input->post('lemari'),
      'rak' => $this->input->post('rak')
    ];

    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    // $config['max_size']             = 100;
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar'))
    {
      $imageData = array('upload_data' => $this->upload->data());
  
      $data['gambar'] = $imageData['upload_data']['file_name'];
    }

    if ($this->book_m->update_book($data, $id)) {
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil mengubah data book</div>');
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengubah data book</div>');
    }

    redirect('buku');
  }

  public function delete_book()
  {
    $id = $this->input->post('id');

    if ($this->book_m->delete_book($id)) {
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil menghapus data book</div>');
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal menghapus data book</div>');
    }

    redirect('buku');
  }
}
