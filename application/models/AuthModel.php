<?php

class AuthModel extends CI_Model {
  public function __construct() {
    parent::__construct();
  }

  public function login($data) {
    $user = $this->db->get_where('users', ['username' => $data['username']])->row_array();

		if(password_verify($data['password'], $user['password'])) {
			if($user['is_active'] == 0) {
				$this->session->set_flashdata('is_active', false);
				return false;
			}
			
			$this->session->set_userdata('SESS_SIPERPUS_USERID', $user['id']);
			$this->session->set_userdata('SESS_SIPERPUS_USERNAME', $user['username']);
			$this->session->set_userdata('SESS_SIPERPUS_NAME', $user['nama_petugas']);
			// $this->session->set_userdata('SESS_SIPERPUS_ROLE', $user['role']);

			// if($user['role'] == 3) {
			// 	$query = "SELECT LPAD(id, 5, '0') as id, nama, nomor_telepon, email, alamat, created_at, updated_at FROM perusahaan WHERE user_id = '$user[id]'";
		
			// 	$perusahaan = $this->db->query($query)->row_array();

			// 	$this->session->set_userdata('SESS_SIPERPUS_NAMA_PERUSAHAAN', $perusahaan['nama']);
			// 	$this->session->set_userdata('SESS_SIPERPUS_ID_PERUSAHAAN', $perusahaan['id']);
			// }

			return true;
		}

		return false;
  }
}