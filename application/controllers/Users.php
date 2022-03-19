<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['judul_web'] = "Dashboard";
			$data['waktu'] = array('PAGI', 'SIANG', 'SORE');			

			$ruangan = $this->Guzzle_model->getAllRuangan();

			foreach ($data['waktu'] as $key_waktu) {
				$status_by_waktu = $this->Guzzle_model->getStatusRuanganByWaktu($key_waktu);

				foreach ($ruangan as $key => $value) {
					for($i=0; $i < count($status_by_waktu); $i++) {
						if ($value['id'] == $status_by_waktu[$i]['id_ruangan']) {
							$data['status'][$key_waktu][$key] = array(
								'id_ruangan'		=> $value['id'],
								'nama_ruangan' 		=> $value['nama'],
								'id_status_ruangan'	=> $status_by_waktu[$i]['id_status_ruangan'],
								'status_ob'			=> $status_by_waktu[$i]['status_ob'],
								'status_pengawas'	=> $status_by_waktu[$i]['status_pengawas']
							);
						}
					}
					if ($data['status'][$key_waktu][$key] == null) {
						$data['status'][$key_waktu][$key] = array(
							'id_ruangan'		=> $value['id'],
							'nama_ruangan' 		=> $value['nama'],
							'status_ob'			=> 'BELUM',
							'status_pengawas'	=> 'BELUM'
						);	
					}
				}

			}

			// echo '<pre>'; print_r($data['status']); echo '</pre>'; exit;

			// foreach ($ruangan as $key => $value) {
			// 	for($i=0; $i < count($status_siang); $i++) {
			// 		if ($value['id'] == $status_siang[$i]['id_ruangan']) {
			// 			$data['status_pagi'][$key] = array(
			// 				'id_ruangan'		=> $value['id'],
			// 				'nama_ruangan' 		=> $value['nama'],
			// 				'status_ob'			=> $status_siang[$i]['status_ob'],
			// 				'status_pengawas'	=> $status_siang[$i]['status_pengawas']
			// 			);
			// 		}
			// 	}
			// 	if ($data['status_siang'][$key] == null) {
			// 		$data['status_siang'][$key] = array(
			// 			'id_ruangan'		=> $value['id'],
			// 			'nama_ruangan' 		=> $value['nama'],
			// 			'status_ob'			=> 'BELUM',
			// 			'status_pengawas'	=> 'BELUM'
			// 		);	
			// 	}
			// }

			// foreach ($ruangan as $key => $value) {
			// 	for($i=0; $i < count($status_sore); $i++) {
			// 		if ($value['id'] == $status_sore[$i]['id_ruangan']) {
			// 			$data['status_pagi'][$key] = array(
			// 				'id_ruangan'		=> $value['id'],
			// 				'nama_ruangan' 		=> $value['nama'],
			// 				'status_ob'			=> $status_sore[$i]['status_ob'],
			// 				'status_pengawas'	=> $status_sore[$i]['status_pengawas']
			// 			);
			// 		}
			// 	}
			// 	if ($data['status_sore'][$key] == null) {
			// 		$data['status_sore'][$key] = array(
			// 			'id_ruangan'		=> $value['id'],
			// 			'nama_ruangan' 		=> $value['nama'],
			// 			'status_ob'			=> 'BELUM',
			// 			'status_pengawas'	=> 'BELUM'
			// 		);	
			// 	}
			// }

			
			
			$this->load->view('header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('footer');
		}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			= $this->Guzzle_model->getUserById($id_user);
			$data['level_users']  	= $level;
			$data['judul_web'] 		= "Profile";

			$this->load->view('header', $data);
			$this->load->view('profile', $data);
			$this->load->view('footer');
		}

		$user_list = $this->Guzzle_model->getAllUser();

		if (isset($_POST['btnupdate'])) {
			$username	 		= htmlentities(strip_tags($this->input->post('username')));
			$nama	= htmlentities(strip_tags($this->input->post('nama')));
			$whatsapp	= htmlentities(strip_tags($this->input->post('whatsapp')));
			$password  = htmlentities(strip_tags($this->input->post('password')));
			$password2 = htmlentities(strip_tags($this->input->post('password2')));

			if ($username != $ceks) {
				$cek_username = array_search($username, array_column($user_list, 'username', 'id'));
			}

			$pesan  = '';
			$update = 'yes';
			
			if ($cek_username != null) {
				$update = 'no';
				$pesan  = "Username '<b>$username</b>' sudah ada";
			} else {
				$pass_lama = $data['user']['password'];
				if ($password=='') {
					$password = $pass_lama;
				} else {
					if ($password!=$password2) {
						$update = 'no';
						$pesan  = "Password tidak cocok!";
					}
				}
			}
				

			if ($update == 'yes') {
				$data = array(
					'nama'			=> $nama,
					'whatsapp'		=> $whatsapp,
					'username' 		=> $username,
					'password' 		=> $password,
					'role' 			=> $level
				);
				$this->Guzzle_model->updateUser($id_user, $data);
					
				$this->session->has_userdata('username');
				$this->session->set_userdata('username', "$username");
				$this->session->has_userdata('nama');
				$this->session->set_userdata('nama', "$nama");

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Sukses!</strong> Profile berhasil disimpan.
					</div>
				  <br>'
				);
				redirect('profile');
				
			}else {
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-warning alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Gagal!</strong> '.$pesan.'.
					</div>
					<br>'
				);
				redirect('profile');
			}
		}
			
	}

}
