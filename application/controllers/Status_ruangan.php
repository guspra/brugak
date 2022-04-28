<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_ruangan extends CI_Controller {
	public function index()
	{
		$ceks 	 = $this->session->userdata('username');

		if(!isset($ceks)) {
			redirect('web/login');
		} else {
			redirect('status_ruangan/v');
		}

	}

	public function v($aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');

		if(!isset($ceks)) {
			redirect('web/login');
		}

		date_default_timezone_set('Asia/Singapore');
		$today = date('Y-m-d');

		$data['status_ruangan'] = $this->Guzzle_model->getAllStatusRuangan;
		
		if ($aksi == 't') {
			$p = "tambah";
			$data['judul_web'] 	  = "Checklist Kebersihan Ruangan";
		} elseif ($aksi == 'd') {
			$p = "detail";
			$data['judul_web'] 	  = "Status Kebersihan Ruangan";
			$data['status_ruangan'] = $this->Guzzle_model->getStatusRuanganById($id);

			
			if ($data['status_ruangan'] == null) {
				$data['status_ruangan'] = 'belum';
			}
			// echo '<pre>'; print_r($data['status_ruangan']); exit;

			// $cek_notif = $this->Guzzle_model->getNotifikasiByIdPenerima($id_user);

			// $notif_filter = array_filter($cek_notif, function($key) use ($id) {
			// 	return ($key['id_for_link'] == $id);
			// });

			// foreach ($notif_filter as $key => $value) {
			// 	$this->Mcrud->update_notif($value);
			// }
		} elseif ($aksi == 'e') {
			$p = "edit";
			$data['judul_web'] 	  = "Edit Checklist Kebersihan Ruangan";
			$data['status_ruangan'] = $this->Guzzle_model->getStatusRuanganById($id);
			if ($data['status_ruangan']['id']=='' OR $data['status_ruangan']['tanggal']!=$today) {redirect('404');}
		} elseif ($aksi == 'h') {
			if ($level!='MR.CLEAN') {redirect('404');}
			$filter = array_filter($data['status_ruangan'], function($key) {
				return ($key['status_pengawas'] == 'sudah');
			});
			// echo '<pre>'; print_r($filter); exit;
			foreach ($filter as $key => $value) {
				if ($value['id'] == $id) {
					redirect('404');
				}
			}

			// $cek_data = $this->Guzzle_model->getRevisiDipaById($id);
			// if ($cek_data['url_file'] != '') {
			// 	unlink($cek_data['url_file']);
			// }
			// $this->Guzzle_model->deleteRevisiDipa($id);
			// $notif = $this->Guzzle_model->getAllNotifikasi();

			// 	$notif_filter = array_filter($notif, function($key) use ($id) {
			// 		return ($key['id_for_link'] == $id);
			// 	});

			// 	foreach ($notif_filter as $key => $value) {
			// 		$this->Guzzle_model->deleteNotifikasi($value['id']);
			// 	}

			$this->session->set_flashdata('msg',
				'
				<div class="alert alert-success alert-dismissible" role="alert">
					 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						 <span aria-hidden="true">&times;</span>
					 </button>
					 <strong>Sukses!</strong> Berhasil dihapus.
				</div>
				<br>'
			);
			redirect('status_ruangan/v');
		}else{
			$p = "index";
			$data['judul_web'] 	  = "CHECKLIST KEBERSIHAN RUANGAN";
		}

		$this->load->view('header', $data);
		$this->load->view("status_ruangan/$p", $data);
		$this->load->view('footer');

		if (isset($_POST['btnsimpan'])) {
			$waktu		 = htmlentities(strip_tags($this->input->post('waktu')));
			$catatan_ob 		 = htmlentities(strip_tags($this->input->post('catatan_ob')));
			
			$pesan = '';

			if ($level == 'MR.CLEAN') {
				$simpan = 'y';
			}

			if ($simpan=='y') {
				$data = array(
					'id_ruangan'		=> $id,
					'id_ob' 			=> $id_user,
					'id_pengawas'		=> 0,
					'status_ob'			=> "SUDAH",
					'status_pengawas'	=> "BELUM",
					'waktu'				=> $waktu,
					'tanggal'			=> $today,
					'catatan_ob'		=> $catatan_ob
				);
				$this->Guzzle_model->createStatusRuangan($data);
				
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Sukses!</strong> Berhasil disimpan.
					</div>
				<br>'
				);
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
			  redirect('status_ruangan/v/t/'.hashids_encrypt($id));
			}
			redirect('dashboard');
		}

		if (isset($_POST['btnupdate'])) {
			$status_pengawas = htmlentities(strip_tags($this->input->post('status_pengawas')));
			$catatan_pengawas = htmlentities(strip_tags($this->input->post('catatan_pengawas')));
			
			$data_lama = $data['status_ruangan'];

			$pesan = '';

			if ($level == "PENGAWAS" && $status_pengawas == "on") {
				$simpan = 'y';
			}

			if ($simpan=='y') {
				$data = array(
					'id_ruangan'		=> $data_lama['id_ruangan'],
					'id_ob' 			=> $data_lama['id_ob'],
					'id_pengawas'		=> $id_user,
					'status_ob'			=> $data_lama['status_ob'],
					'status_pengawas'	=> "SUDAH",
					'waktu'				=> $data_lama['waktu'],
					'tanggal'			=> $today,
					'catatan_pengawas'	=> $catatan_pengawas
				);
				$this->Guzzle_model->updateStatusRuangan($id, $data);
				
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Sukses!</strong> Berhasil disimpan.
					</div>
				 <br>'
				);
				redirect('dashboard');
				
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
					redirect('status_ruangan/v/e/'.hashids_encrypt($id));
			 }

		}
			
	}

}