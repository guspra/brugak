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

			// echo '<pre>'; print_r($data['status_ruangan']); exit;

			if ($data['status_ruangan'] == null) {
				redirect(404);
			}

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
			$jenis_revisi = htmlentities(strip_tags($this->input->post('jenis_revisi')));
			$keterangan = htmlentities(strip_tags($this->input->post('keterangan')));
			$id_verifikator = htmlentities(strip_tags($this->input->post('id_verifikator')));
			$id_dipa = htmlentities(strip_tags($this->input->post('id_dipa')));
			$cek_file = $data['status_ruangan']['url_file'];
			if ($_FILES['url_file']['error'] <> 4) {
				if ( ! $this->upload->do_upload('url_file'))
				{
						$simpan = 'n';
						$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				}
				 else
				{
					if ($cek_file!='') {
						unlink($cek_file);
					}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$file = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
				}
			}else {
				$file = $cek_file;
				$simpan = 'y';
			}

			if ($simpan=='y') {
				$data = array(
					'url_file'						=> $file,
					'id_dipa'						=> $id_dipa,
					'keterangan' 					=> $keterangan,
					'jenis_revisi'					=> $jenis_revisi,
					'id_user_verifikator_terakhir'	=> $id_verifikator
				);
				$status_ruangan_result = $this->Guzzle_model->updateRevisiDipa($id, $data);

				if ($status_ruangan_result['status'] == 200) {
					$verifikator = $this->Guzzle_model->getVerifikasiByUsulanRevisiId($id);

					$verifikator_filter = array_filter($verifikator, function($key) {
						return ($key['status_verifikasi'] != 'sudah');
					});
					
					foreach ($verifikator_filter as $key => $value) {
						$id_verifikator = $value['id_user_verifikator'];
						$this->Mcrud->kirim_notif('revisi_usulan_status_ruangan', $id_dipa, $id, $id_user, $id_verifikator);
					}
				}
				
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
				redirect('status_ruangan/v/'.$id_dipa);
				
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
					redirect("status_ruangan/v/$id_dipa/$aksi/".hashids_encrypt($id));
			 }

		}

		if (isset($_POST['btnkonfirm'])) {
			$status_verifikasi 		= htmlentities(strip_tags($this->input->post('status_verifikasi')));
			$id_user_verifikator 	= htmlentities(strip_tags($this->input->post('id_user_verifikator')));
			$id_usulan_status_ruangan  = htmlentities(strip_tags($this->input->post('id_usulan_status_ruangan')));
			$komentar  = htmlentities(strip_tags($this->input->post('catatan')));
			$id_verifikasi_usulan = htmlentities(strip_tags($this->input->post('id_verifikasi_usulan')));
			
			$simpan = 'y';
			$id_user_verifikator_terakhir = $data['status_ruangan']['id_user_verifikator_terakhir'];

			if ($simpan=='y') {
				if ($status_verifikasi == 'tolak') {
					$data = array(
						'status_verifikasi'			=> $status_verifikasi,
						'id_user_verifikator' 		=> $id_user,
						'id_usulan_status_ruangan'		=> $id_usulan_status_ruangan,
						'komentar'					=> $komentar
					);
					$verifikasi_result = $this->Guzzle_model->updateVerifikasiRevisiDipa($id_verifikasi_usulan, $data);
				} elseif ($status_verifikasi == 'sudah') {
					$data1 = array(
						'status_verifikasi'			=> $status_verifikasi,
						'id_user_verifikator' 		=> $id_user,
						'id_usulan_status_ruangan'		=> $id_usulan_status_ruangan,
						'komentar'					=> $komentar
					);
					$verifikasi_result = $this->Guzzle_model->updateVerifikasiRevisiDipa($id_verifikasi_usulan, $data1);

					if ($id_user != $id_user_verifikator_terakhir) {
						$data2 = array(
							'status_verifikasi'			=> 'belum',
							'id_user_verifikator' 		=> $id_user_verifikator,
							'id_usulan_status_ruangan'		=> $id_usulan_status_ruangan,
							'komentar'					=> ""
						);
						$new_verifikator = $this->Guzzle_model->createVerifikasiRevisiDipa($data2);
					}
				}
				
				if ($verifikasi_result['status'] == 200) {
					$user_dipa = $this->Guzzle_model->getUserByDipaId($id_dipa);
					
					$pelaksana = array_filter($user_dipa, function($key) {
						return ($key['role'] == 'pelaksana');
					});
					
					foreach ($pelaksana as $key => $value) {
						$id_pelaksana = $value['id'];
					}
					
					$this->Mcrud->kirim_notif('verifikasi_usulan_status_ruangan', $id_dipa, $id_usulan_status_ruangan, $id_user, $id_pelaksana, $status_verifikasi);
				}

				if ($new_verifikator['status'] == 201) {
					$this->Mcrud->kirim_notif('usulan_status_ruangan', $id_dipa, $id_usulan_status_ruangan, $id_user, $id_user_verifikator);
				}

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
			  redirect("status_ruangan/v/$id_dipa/$aksi");
			}
			redirect('status_ruangan/v/'.$id_dipa);
		}
			
	}

}