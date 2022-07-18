<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_v2 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf_report');
        $this->load->helper('security');
//        require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
    }

    public function index(){
        redirect('reports_v2/v');
    }

    public function v($aksi = "", $id = ""){
        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level'); // role dari users

        if(!isset($ceks)){
            redirect("web/login");
        } else {
            if($aksi == 'f') {
                $data['id_ruangan_dipilih'] = $this->input->post('id_ruangan');
                $data['filter_date_dari'] = $this->input->post('dari_tgl');
                $data['filter_date_sampai'] = $this->input->post('sampai_tgl');
                $data['judul_web'] = "Checklist Kebersihan";
                $data["semua_ruangan"] = $this->Guzzle_model->getAllRuangan();

                if($this->input->post("id_ruangan") == "0" || $this->input->post("id_ruangan") === 0 || $this->input->post("id_ruangan") === "0"){
                    $data["laporan_list"] = $this->Guzzle_model->getStatusRuanganByTanggalByID($data['filter_date_dari'],$data['filter_date_sampai'],$data['id_ruangan_dipilih']);
                } else if($this->input->post("id_ruangan") != "0" || $this->input->post("id_ruangan") == 0) {
                    $data["laporan_list"] = $this->Guzzle_model->getStatusRuanganByTanggalByID($data['filter_date_dari'],$data['filter_date_sampai'],$data['id_ruangan_dipilih']);
                    $info_ruangan = $this->Guzzle_model->getRuanganById($this->input->post("id_ruangan"));

                    if($this->session->has_userdata("id_ruangan_dipilih")){
                        $this->session->unset_userdata("id_ruangan_dipilih");
                    }
                    $this->session->set_userdata("id_ruangan_dipilih",$this->input->post("id_ruangan"));

                    if($this->session->has_userdata("nama_ruangan_dipilih")){
                        $this->session->unset_userdata("nama_ruangan_dipilih");
                    }
                    $this->session->set_userdata("nama_ruangan_dipilih",$info_ruangan["nama"]);

                    if($this->session->has_userdata("tgl_awal_id")){
                        $this->session->unset_userdata("tgl_awal_id");
                    }
                    $tgl_awal_id = tgl_indo($this->input->post("dari_tgl"));
                    $this->session->set_userdata("tgl_awal_id",$tgl_awal_id);

                    if($this->session->has_userdata("tgl_awal_sql")){
                        $this->session->unset_userdata("tg_awal_sql");
                    }
                    $this->session->set_userdata("tgl_awal_sql",$this->input->post("dari_tgl"));

                    if($this->session->has_userdata("tgl_akhir_id")){
                        $this->session->unset_userdata("tgl_akhir_id");
                    }
                    $tgl_akhir_id = tgl_indo($this->input->post("sampai_tgl"));
                    $this->session->set_userdata("tgl_akhir_id",$tgl_akhir_id);

                    if($this->session->has_userdata("tgl_akhir_sql")){
                        $this->session->unset_userdata("tgl_akhir_sql");
                    }
                    $this->session->set_userdata("tgl_akhir_sql",$this->input->post("sampai_tgl"));
                }

                $p = "range_tgl_v2";
                $this->load->view("header", $data);
                $this->load->view("datalaporan/$p", $data);
                $this->load->view("footer");
            } else if($aksi == 'c') {
                $array_pagi = [];
                $data["item_ruangan"] = $this->Guzzle_model->getRuanganById($this->session->userdata('id_ruangan_dipilih'));
                $data["nama_ruangan"] = $data["item_ruangan"]["nama"];
                $data["shifts"] = ["pagi","siang","sore"];
                $data["roles"] = ["office boy","pengawas"];
                $data["status"] = ["status","catatan"];

                $firstTgl = strtotime($this->session->userdata('tgl_awal_sql'));
                $endTgl = strtotime($this->session->userdata('tgl_akhir_sql'));

                $jarakWaktu = abs($endTgl-$firstTgl);
                $numberDays = $jarakWaktu / 86400;
                $numberDays = intval($numberDays)+1;

                $data["laporan_list"] = $this->Guzzle_model->getStatusRuanganByTanggalByID($this->session->userdata('tgl_awal_sql'),$this->session->userdata('tgl_akhir_sql'),$this->session->userdata('id_ruangan_dipilih'));
                $data['laporan_tgl'] = [];
                $data['laporan_status_ruangan'] = [];

                $indexCoba=0;
                for($i=0; $i<$numberDays; $i++){
                    $getTgl = date("Y-m-d",strtotime("+" . $i . "day",strtotime($this->session->userdata('tgl_awal_sql'))));
                    //disini proses filter per tanggal terhadap 3 shift waktu
                    //struktur id_ruangan-tanggal-shift
//                    $pagi = $this->session->userdata('id_ruangan_dipilih')."-".$getTgl."-"."PAGI";
//                    $siang = $this->session->userdata('id_ruangan_dipilih')."-".$getTgl."-"."SIANG";
//                    $sore = $this->session->userdata('id_ruangan_dipilih')."-".$getTgl."-"."SORE";

                    $waktu_data = $this->session->userdata('id_ruangan_dipilih')."-".$getTgl;

                    //mulai disini lanjutkan 4
                    array_push($data['laporan_tgl'], (object)[
                        "tanggal" => $getTgl,

                        "status_ob_pagi" => "BELUM",
                        "catatan_ob_pagi" => "",
                        "status_pengawas_pagi" => "BELUM",
                        "catatan_pengawas_pagi" => "",

                        "status_ob_siang" => "BELUM",
                        "catatan_ob_siang" => "",
                        "status_pengawas_siang" => "BELUM",
                        "catatan_pengawas_siang" => "",

                        "status_ob_sore" => "BELUM",
                        "catatan_ob_sore" => "",
                        "status_pengawas_sore" => "BELUM",
                        "catatan_pengawas_sore" => "",
                    ]);

                    foreach ($data['laporan_list'] as $index=>$val){
                        $ruang_api = $val['id_ruangan'];
                        $tgl_api = $val['tanggal'];
                        $waktu_api = $val['waktu'];

                        $dt_api = $ruang_api."-".$tgl_api;
                        //struktur : $waktu_data => id_ruangan + tanggal
                        //$indexCoba belum berubah, sebelum looping foreach $data['laporan_list'] berakhir
                        if($dt_api==$waktu_data){
                            if($waktu_api =='PAGI'){
                                $data['laporan_tgl'][$indexCoba]->status_ob_pagi=$val["status_ob"];
                                $data['laporan_tgl'][$indexCoba]->catatan_ob_pagi=$val["catatan_ob"];
                                $data['laporan_tgl'][$indexCoba]->status_pengawas_pagi=$val["status_pengawas"];
                                $data['laporan_tgl'][$indexCoba]->catatan_pengawas_pagi=$val["catatan_pengawas"];
                            }else if($waktu_api =='SIANG'){
                                $data['laporan_tgl'][$indexCoba]->status_ob_siang=$val["status_ob"];
                                $data['laporan_tgl'][$indexCoba]->catatan_ob_siang=$val["catatan_ob"];
                                $data['laporan_tgl'][$indexCoba]->status_pengawas_siang=$val["status_pengawas"];
                                $data['laporan_tgl'][$indexCoba]->catatan_pengawas_siang=$val["catatan_pengawas"];
                            }else if($waktu_api =='SORE'){
                                $data['laporan_tgl'][$indexCoba]->status_ob_sore=$val["status_ob"];
                                $data['laporan_tgl'][$indexCoba]->catatan_ob_sore=$val["catatan_ob"];
                                $data['laporan_tgl'][$indexCoba]->status_pengawas_sore=$val["status_pengawas"];
                                $data['laporan_tgl'][$indexCoba]->catatan_pengawas_sore=$val["catatan_pengawas"];
                            }

                        }

//                        if($dt_api==$waktu_data){
//                            if($waktu_api =='PAGI'){
//                                $data['laporan_tgl'][$i]->status_ob_pagi=$val["status_ob"];
//                                $data['laporan_tgl'][$i]->catatan_ob_pagi=$val["catatan_ob"];
//                                $data['laporan_tgl'][$i]->status_pengawas_pagi=$val["status_pengawas"];
//                                $data['laporan_tgl'][$i]->catatan_pengawas_pagi=$val["catatan_pengawas"];
//                            }else if($waktu_api =='SIANG'){
//                                $data['laporan_tgl'][$i]->status_ob_siang=$val["status_ob"];
//                            }else if($waktu_api =='SORE'){
//                                $data['laporan_tgl'][$i]->status_ob_sore=$val["status_ob"];
//                            }
//
//                        }
                    }

                $indexCoba++;
                }
                // uji jumlah index array per 1 index array data['laporan_tgl']
//                foreach ($data['laporan_tgl'][2] as $i=>$item){
////                        echo $i."-".$item->status_ob_pagi."</br>";
//                    echo count($data['laporan_tgl'][0]);
//                }

                $this->load->view("datalaporan/laporan_checklist",$data);
            } else {
                $p = "range_tgl_v2";
                $data['judul_web'] = "Checklist Kebersihan";
//                $data['laporan_list'] = $this->Guzzle_model->getAllStatusRuangan();
                $data['laporan_list'] = [];
                $data["id_ruangan_dipilih"] = null;
                $data["semua_ruangan"] = $this->Guzzle_model->getAllRuangan();
                $data["tgl_skrg"] = date("Y-m-d");
                $data["filter_tgl_awal"] = null;
                $data["filter_tgl_akhir"] = null;

                $this->session->set_userdata("id_ruangan_dipilih","");
                $this->session->set_userdata("nama_ruangan_dipilih","");
                $this->session->set_userdata("tgl_awal_id","");
                $this->session->set_userdata("tgl_awal_sql","");
                $this->session->set_userdata("tgl_akhir_id","");
                $this->session->set_userdata("tgl_akhir_sql","");


                $this->load->view("header",$data);
                $this->load->view("datalaporan/$p",$data);
                $this->load->view("footer");
                date_default_timezone_set('Asia/Jakarta');
            }
        }
    }


}


