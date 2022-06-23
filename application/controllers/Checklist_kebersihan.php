<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist_kebersihan extends CI_Controller {

    public function index()
    {
//        <a href="datapengguna/v.html">
        redirect('checklist_kebersihan/v');
    }

    public function v($aksi='', $id=''){
        $id = hashids_decrypt($id);
        $ceks 	 = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level 	 = $this->session->userdata('level');

        if(!isset($ceks)){
            redirect("web/login");
        } else {
            $p = "checklist_kebersihan";
            $data['judul_web'] 	  = "Checklist Kebersihan";


            $this->load->view("header",$data);
            $this->load->view("checklist_kebersihan/$p",$data);
            $this->load->view("footer");
        }
    }



}


