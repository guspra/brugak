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
			$data['user']  			  = $ceks;
			$data['level_users']  = $level;
			$data['judul_web'] 		= "Profile";

			$this->load->view('header', $data);
			$this->load->view('profile', $data);
			$this->load->view('footer');
		}
	}

}
