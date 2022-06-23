<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Web extends CI_Controller
{

    public function index()
    {
        $data['judul_web'] = $this->Mcrud->judul_web();

        $this->load->view('header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('footer', $data);
    }

    public function login()
    {
        $ceks = $this->session->userdata('username');
        if (isset($ceks)) {
            // $this->load->view('404_content');
            redirect('dashboard');
//			redirect('berhasil');
//            redirect('web/login');
        } else {
//            ditambahjo
            $data['judul_web'] = "Halaman Login - " . $this->Mcrud->judul_web();
            $this->load->view('log/header', $data);
            $this->load->view('log/login', $data);
            $this->load->view('log/footer', $data);

//            ditambahjo utk ngetest btnlogins
//            if(isset($_POST['btnlogins'])){
//                echo "hay";
//            }
            if (isset($_POST['btnlogin'])) {
//                ditambahjo
                $this->session->set_flashdata('button_login','anda pencet login buttton');
                $username = htmlentities(strip_tags($_POST['username']));
                $pass = htmlentities(strip_tags($_POST['password']));

//				$username = htmlentities($_POST['username']);
//				$pass	   = htmlentities($_POST['password']);


                $data = array(
                    'username' => $username,
                    'password' => $pass,
                );

                try {
                    $client = new Client([
                        'base_uri' => 'http://localhost/brugakapi/index.php/',
                        'headers' => [
                            'Client-Service' => 'frontend-client',
                            'Auth-Key' => 'simplerestapi',
                            'Content-Type' => 'application/json'
                        ]
                    ]);

                    $response = $client->request('POST', 'auth/login', [
                        'json' => $data
                    ]);

//					if (200 == $response->getStatusCode()) {
                    if (200 == $response->getStatusCode()) {
                        $login_result = json_decode($response->getBody()->getContents(), true);
                    }
                } catch (GuzzleHttp\Exception\ClientException $e) {
                    $response = $e->getResponse();
                    $responseBody = json_decode($response->getBody()->getContents());
                }

//				berasal dari baris json_output($response['status'],$response) pada controller Auth di brugakapi;
//                if($login_result["status"] != 200) {
                if ($login_result["status"] != 200) {
                    $this->session->set_flashdata('msg',
                        '
						<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
							  </button>
							  <div class="container-fluid">				        							        
							        <strong>"' . $responseBody->message . '"</strong>
							        <br>							      
                              </div>
							  
						</div>'
                    );
                    redirect('web/login');

                } else if ($login_result['status'] == 200) {
//						$userID = $login_result['id'];
//						$user_role = $login_result['role'];
//						$user_token = $login_result['token'];
//						$user_nama = $login_result['nama'];
//
//						$this->session->set_userdata('username', "$username");
//						$this->session->set_userdata('nama', "$user_nama");
//						$this->session->set_userdata('id_user', "$userID");
//						$this->session->set_userdata('level', "$user_role");
//						$this->session->set_userdata('token', "$user_token");
//
//						$this->session->set_userdata('jml_notif_bell', "0");

//                    SAMPAI DISINI OKE

                    $userID = $login_result['id'];
                    $user_role = $login_result['role'];
                    $user_token = $login_result['token'];
                    $user_nama = $login_result['nama'];

//                    ditambahjo
//                    nanti session userdata berikut akan dicek juga di routes 'dashboard',yakni controller Users.php dalam function
//                    function index
                    $this->session->set_userdata('username', "$username");
                    $this->session->set_userdata('nama', "$user_nama");
                    $this->session->set_userdata('id_user', "$userID");
                    $this->session->set_userdata('level', "$user_role");
                    $this->session->set_userdata('token', "$user_token");

//                    $this->session->set_userdata('jml_notif_bell',"0");

                    $this->session->set_flashdata('msg',
                        '
						<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
							  </button>
							  <div class="container">
							    	<strong>"' . $login_result['last_login'] . '"</strong>
							    	<br>
							    	<strong>"ini header client_service status"."' . $login_result['header_client_service'] . '"</strong>
							    	<br>
							    	<strong>"ini header auth_key status"."' . $login_result['header_auth_key'] . '"</strong>
							    	<br>
							    	<strong>"ini status code when u&p is right"."' . $response->getStatusCode() . '"</strong>
							    	<br>
							    	<strong>"' . $login_result['status'] . '"</strong>
							    	<br>
							    	<strong>"' . $login_result['username'] . '"</strong>
							    	<br>
							    	<strong>"' . $login_result['password'] . '"</strong>
							    	<br>
							    	<strong>"' . $login_result['hashed_password'] . '"</strong>
							    	<br>
							    	<strong>"' . $login_result['last_login'] . '"</strong>
							    	<br>
							    	<strong>"' . $login_result['token'] . '"</strong>
							    	<br>
							    	<strong>"' . $login_result['message'] . '"</strong>		
							    	<br>					    	
							    	<strong>"' . $login_result['status_koneksi'] . '"</strong>	
							    	<br>
							    	<strong>"jumlah baris "."' . $login_result['jumlah_baris'] . '"</strong>						    	
							    	<br>
                                </div>
						</div>'
                    );
//                    redirect('web/login');
                    redirect('dashboard');
//                    redirect('berhasil');
                }
//                redirect('web/login');
            }
        }
    }


    public function logout()
    {
//        if ($this->session->has_userdata('username') and $this->session->has_userdata('id_user')) {
        if ($this->session->has_userdata('username') and $this->session->has_userdata('id_user')) {
            $this->session->sess_destroy();
        }

        redirect('web/login');
    }

    function error_not_found()
    {
        $this->load->view('404_content');
//        $this->load->view('404_content');
    }


    public function notif_bell($aksi = '')
    {
        date_default_timezone_set('Asia/Singapore');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        $data['notif'] = $this->Guzzle_model->getNotifikasiByIdPenerima($id_user);

        // $jml_notif_baru = 0;
        // foreach ($data['notif'] as $key => $value) {
        // 	if($value['status'] == 'belum dibaca') {
        // 		$jml_notif_baru++;
        // 	} elseif($value['status'] == 'sudah dibaca') {
        // 		$jml_notif_baru--;
        // 	}
        // }

        $filtered_notif = array_filter($data['notif'], function ($key) {
            return ($key['status'] == 'belum dibaca');
        });
        $jml_notif_baru = count($filtered_notif);

        $data['jml_notif'] = $jml_notif_baru;
        if ($aksi == 'pesan_baru') {
            $jml_notif_bell = $this->session->userdata('jml_notif_bell');
            if ($jml_notif_bell >= $jml_notif_baru) {
                $stt = '0';
            } else {
                $stt = '1';
            }
            $this->session->set_userdata('jml_notif_bell', "$jml_notif_baru");
            if ($id_user == '') {
                echo '11';
            } else {
                echo $stt;
            }
        } elseif ($aksi == 'jml') {
            echo number_format($jml_notif_baru, 0, ",", ".");
        } else {
            $this->load->view('notif/bell', $data);
        }
    }

    public function notif($aksi = '', $id = '')
    {
        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            // $data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
            // $data['users']  	 = $this->Mcrud->get_users();
            $data['judul_web'] = "Notifikasi";

            // $this->db->order_by('id_notif','DESC');
            // $data['query'] = $this->db->get_where('tbl_notif', array('penerima'=>$id_user));

            $data['notif'] = $this->Guzzle_model->getNotifikasiByIdPenerima($id_user);

            usort($data['notif'], function ($a, $b) {
                return $a['id'] <=> $b['id'];
            });

            if ($aksi == 'h') {
                $cek_data = $this->Guzzle_model->getNotifikasiById($id);
                if (count($cek_data) != 0) {
                    $this->Guzzle_model->deleteNotifikasi($id);
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
                    redirect("web/notif");
                } else {
                    redirect('404_content');
                }
            }
            // if ($aksi=='h' or $aksi=='h_all') {
            // 	if ($aksi=='h') {
            // 		$cek_data = $this->db->get_where("tbl_notif", array('id_notif'=>"$id"));
            // 	} else {
            // 		$cek_data = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user"));
            // 	}
            // 	if ($cek_data->num_rows() != 0) {
            // 		if ($aksi=='h') {
            // 			$h_notif = $cek_data->row()->hapus_notif;
            // 			if(!preg_match("/$id_user/i", $h_notif)) {
            // 				$data = array('hapus_notif'=>"$id_user, $h_notif");
            // 				$this->db->update('tbl_notif', $data, array('id_notif'=>$id));
            // 			}
            // 		} else {
            // 			foreach ($cek_data->result() as $key => $value) {
            // 				$h_notif = $value->hapus_notif;
            // 				if(!preg_match("/$id_user/i", $h_notif)) {
            // 					$data = array('hapus_notif'=>"$id_user, $h_notif");
            // 					$this->db->update('tbl_notif', $data, array('penerima'=>$id_user));
            // 				}
            // 			}
            // 		}
            // 		$this->session->set_flashdata('msg',
            // 			'
            // 			<div class="alert alert-success alert-dismissible" role="alert">
            // 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            // 					 <span aria-hidden="true">&times;</span>
            // 				 </button>
            // 				 <strong>Sukses!</strong> Berhasil dihapus.
            // 			</div>
            // 			<br>'
            // 		);
            // 		redirect("web/notif");
            // 	} else {
            // 		if ($aksi=='h') {
            // 			redirect('404_content');
            // 		} else {
            // 			redirect("web/notif");
            // 		}
            // 	}
            // }

            $this->load->view('header', $data);
            $this->load->view('notif/index', $data);
            $this->load->view('footer');
        }
    }

}
