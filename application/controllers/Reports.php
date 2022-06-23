<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller
{
    var $id_ruangan_global = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf_report');
//        $this->load->model('Guzzle_model');
        $this->load->helper('security');
        require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';

    }

    public function index()
    {
//        <a href="reports/v.html">
        redirect('reports/v');
//        $this->id_ruangan_global = null;
    }


    public function v($aksi = "", $id = "")
    {
        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level'); // role dari users

        if (!isset($ceks)) {
            redirect("web/login");
        } else {

//            if (($level != ('superadmin')) ) {
//                redirect('404_content');
//            }

            //            $data["users"] = $this->db->get('users')->result();
//            manualBerhasil dirubahjo
//            $data["laporan_list"] = $this->db->get('status_ruangan')->result();

            if ($aksi == 'f') {
//                $data["item_ruangan"] = $this->Guzzle_model->getRuanganById($this->input->post("id_ruangan"));
//                $data["dari_tgl"] = $this->input->post("dari_tgl");
//                $data["sampai_tgl"] = $this->input->post("sampai_tgl");
//
                $this->id_ruangan_global = $this->input->post("id_ruangan");
                $data["id_ruangan_global"] = $this->id_ruangan_global;
                $p = "range_tgl";
                $data['judul_web'] = "Cetak Laporans";
                $data['filter_date_dari'] = $this->input->post('dari_tgl');
                $data['filter_date_sampai'] = $this->input->post('sampai_tgl');
                $data["id_ruangan_selected"] = $this->input->post("id_ruangan");
                $data["ruangan_all"] = $this->Guzzle_model->getAllRuangan();
                $tanggalAwal = $this->input->post('dari_tgl');
                $tanggalAkhir = $this->input->post('sampai_tgl');

                if ($this->input->post("id_ruangan") == "0" || $this->input->post("id_ruangan") === 0 || $this->input->post("id_ruangan") === "0") {

                    $data['laporan_list'] = $this->Guzzle_model->getStatusRuanganByTanggal($tanggalAwal, $tanggalAkhir);
                    $item_ruangan = $this->Guzzle_model->getRuanganById($this->input->post('id_ruangan'));
                    $data["item_ruangan"] = $item_ruangan["nama"];



                    if ($this->session->has_userdata("id_ruangan_selected")) {
                        $this->session->unset_userdata("id_ruangan_selected");
                    }
                    $this->session->set_userdata('id_ruangan_selected', $this->input->post("id_ruangan"));

//                    Start Tanggal Awal Session versi Tgl Indo dan Tgl Sql
                    if ($this->session->has_userdata("tgl_awal")) {

                        $this->session->unset_userdata("tgl_awal");
                    }
                    $tgl_indo_awal = tgl_indo($this->input->post("dari_tgl"));
                    $this->session->set_userdata("tgl_awal", $tgl_indo_awal);

                    if ($this->session->has_userdata("tgl_awal_sql")) {
                        $this->session->unset_userdata("tgl_awal_sql");
                    }
                    $this->session->set_userdata("tgl_awal_sql", $this->input->post("dari_tgl"));
//                    Akhir dari Session versi Tgl Indo dan Tgl Sql

//                    Start Tanggal Akhir Session versi Tgl Indo dan Tgl Sql
                    if ($this->session->has_userdata("tgl_akhir")) {
                        $this->session->unset_userdata("tgl_akhir");
                    }
                    $tgl_indo_akhir = tgl_indo($this->input->post("sampai_tgl"));
                    $this->session->set_userdata("tgl_akhir", $tgl_indo_akhir);

                    if ($this->session->has_userdata("tgl_akhir_sql")) {
                        $this->session->unset_userdata("tgl_akhir_sql");
                    }
                    $this->session->set_userdata("tgl_akhir_sql", $this->input->post("sampai_tgl"));
//                    Akhir dari Session versi Tgl Indo dan Tgl Sql

                    $this->load->view("header", $data);
                    $this->load->view("datalaporan/$p", $data);
                    $this->load->view("footer");
                    date_default_timezone_set('Asia/Jakarta');
                } else if ($this->input->post("id_ruangan") != "0" || $this->input->post("id_ruangan") != 0) {
                    $data['laporan_list'] = $this->Guzzle_model->getStatusRuanganByTanggalByID($tanggalAwal, $tanggalAkhir, $this->input->post("id_ruangan"));
                    $item_ruangan = $this->Guzzle_model->getRuanganById($this->input->post('id_ruangan'));
                    $data["item_ruangan"] = $item_ruangan["nama"];

//                    if ($this->session->has_userdata("nama_ruangan")) {
//                        $this->session->unset_userdata("nama_ruangan");
//                    }
//                    $this->session->set_userdata('nama_ruangan', $item_ruangan["nama"]);

                    if ($this->session->has_userdata("id_ruangan_selected")) {
                        $this->session->unset_userdata("id_ruangan_selected");
                    }
                    $this->session->set_userdata('id_ruangan_selected', $this->input->post("id_ruangan"));

//                    Start setup untuk tgl_awal format tgl_sql dan tgl_indo
                    if ($this->session->has_userdata("tgl_awal")) {
                        $this->session->unset_userdata("tgl_awal");
                    }
                    $tgl_indo_awal = tgl_indo($this->input->post("dari_tgl"));
                    $this->session->set_userdata("tgl_awal", $tgl_indo_awal);

                    if ($this->session->has_userdata("tgl_awal_sql")) {
                        $this->session->unset_userdata("tgl_awal_sql");
                    }
                    $this->session->set_userdata("tgl_awal_sql", $this->input->post("dari_tgl"));
//                    Akhir Setup untuk tgl_awal format tgl_sql dan tgl_indo

//                    Start setup untuk tgl_akhir format tgl_sql dan tgl_indo
                    if ($this->session->has_userdata("tgl_akhir")) {
                        $this->session->unset_userdata("tgl_akhir");
                    }
                    $tgl_indo_akhir = tgl_indo($this->input->post("sampai_tgl"));
                    $this->session->set_userdata("tgl_akhir", $tgl_indo_akhir);

                    if ($this->session->has_userdata("tgl_akhir_sql")) {
                        $this->session->unset_userdata("tgl_akhir_sql");
                    }
                    $this->session->set_userdata("tgl_akhir_sql", $this->input->post("sampai_tgl"));

                    $this->load->view("header", $data);
                    $this->load->view("datalaporan/$p", $data);
                    $this->load->view("footer");
                    date_default_timezone_set('Asia/Jakarta');
                }


            } else if ($aksi == "c") {
                $item_ruangan = $this->Guzzle_model->getRuanganById($this->session->userdata('id_ruangan_selected'));
                $data["item_ruangan"] = $item_ruangan["nama"];

                $data["shifts"] = ["pagi","siang","sore"];
                $data["roles"] = ["Office Boy","Pengawas"];
                $data["status"] = ["Status","Catatan"];

                $data["tgl_first"] = $this->session->userdata("tgl_awal_sql");
                $data["tgl_end"] = $this->session->userdata("tgl_akhir_sql");

//                $data['firstTgl'] = strtotime($data["tgl_first"]);
//                $data['endTgl'] = strtotime($data["tgl_end"]);
//                $data['jarakWaktu'] = abs($data["endTgl"]-$data["firstTgl"]);
//                $data['numberDays'] = $data['jarakWaktu'] / 86400;
//                $data['numberDays'] = intval($data['numberDays']) + 1;

                $firstTgl = strtotime($data["tgl_first"]);
                $endTgl = strtotime($data["tgl_end"]);
//                var_dump($firstTgl);
                $jarakWaktu = abs($endTgl - $firstTgl);
                $numberDays = $jarakWaktu / 86400;
                $numberDays = intval($numberDays) + 1;
//                $numberDays = intval($numberDays) ;
                $data['laporan_status_ruangan'] = [];

                for($i=0; $i<$numberDays; $i++){
                    $getTgl = date('Y-m-d',strtotime("+" . $i . "day",strtotime($data['tgl_first'])));
                    $pagi = $this->Guzzle_model->getStatusShiftWaktu($this->session->userdata('id_ruangan_selected'),$getTgl,"PAGI");
                    $siang = $this->Guzzle_model->getStatusShiftWaktu($this->session->userdata('id_ruangan_selected'),$getTgl,"SIANG");
                    $sore = $this->Guzzle_model->getStatusShiftWaktu($this->session->userdata('id_ruangan_selected'),$getTgl,"SORE");
                    array_push($data['laporan_status_ruangan'],(object)[
                        'tanggal'=>$getTgl,

                        'status_ob_pagi'=>(isset($pagi))?$pagi['status_ob']:'BELUM',
                        'catatan_ob_pagi'=>(isset($pagi))?($pagi['catatan_ob']!=''?$pagi['catatan_ob']:'-'):'-',
                        'status_pengawas_pagi'=>(isset($pagi))?$pagi['status_pengawas']:'BELUM',
                        'catatan_pengawas_pagi'=>(isset($pagi))?($pagi['catatan_pengawas']!=''?$pagi['catatan_pengawas']:'-'):'-',

                        'status_ob_siang' => (isset($siang)) ? $siang['status_ob'] : 'BELUM',
                        'catatan_ob_siang' => (isset($siang)) ? ($siang['catatan_ob'] != '' ? $siang['catatan_ob'] : '-') : '-',
                        'status_pengawas_siang' => (isset($siang)) ? $siang['status_pengawas'] : 'BELUM',
                        'catatan_pengawas_siang' => (isset($siang)) ? ($siang['catatan_pengawas'] != '' ? $siang['catatan_pengawas'] : '-') : '-',

                        'status_ob_sore' => (isset($sore)) ? $sore['status_ob'] : 'BELUM',
                        'catatan_ob_sore' => (isset($sore)) ? ($sore['catatan_ob'] != '' ? $sore['catatan_ob'] : '-') : '-',
                        'status_pengawas_sore' => (isset($sore)) ? $sore['status_pengawas'] : 'BELUM',
                        'catatan_pengawas_sore' => (isset($sore)) ? ($sore['catatan_pengawas'] != '' ? $sore['catatan_pengawas'] : '-') : '-',
                    ]);
                }

                $this->load->view('datalaporan/v_report',$data);

            } else {

                $p = "range_tgl";
                $data['judul_web'] = "Cetak Laporans";
                $data["laporan_list"] = $this->Guzzle_model->getAllStatusRuangan();
                $data["id_ruangan_selected"] = null;
                $data["ruangan_all"] = $this->Guzzle_model->getAllRuangan();
                $data["current_date"] = date('Y-m-d');
                $data['filter_date_dari'] = null;
                $data['filter_date_sampai'] = null;
                $data["item_ruangan"] = null;
                $data["id_ruangan_global"] = "10";

                if ($this->session->has_userdata("id_ruangan_selected")) {
                    $this->session->unset_userdata("id_ruangan_selected");
                }
                $this->session->set_userdata('id_ruangan_selected', "0");

//                Awal setup tgl_awal sql dan tgl_awal indo
                if ($this->session->has_userdata("tgl_awal")) {
                    $this->session->unset_userdata("tgl_awal");
                }
                $tgl_indo_awal = tgl_indo(date("Y-m-d"));
                $this->session->set_userdata('tgl_awal', $tgl_indo_awal);

                if ($this->session->has_userdata("tgl_awal_sql")) {
                    $this->session->unset_userdata("tgl_awal_sql");
                }
                $this->session->set_userdata('tgl_awal_sql', date("Y-m-d"));
//                Akhir setup tgl_awal sql dan tgl_awal indo

//                Awal setup tgl_akhir sql dan tgl_akhir indo
                if ($this->session->has_userdata("tgl_akhir")) {
                    $this->session->unset_userdata("tgl_akhir");
                }
                $tgl_indo_akhir = tgl_indo(date("Y-m-d"));
                $this->session->set_userdata('tgl_akhir', $tgl_indo_akhir);

                if ($this->session->has_userdata("tgl_akhir_sql")) {
                    $this->session->unset_userdata("tgl_akhir_sql");
                }
                $this->session->set_userdata('tgl_akhir_sql', date("Y-m-d"));
//                Awal setup tgl_akhir sql dan tgl_akhir indo


//                set nilai default utk session id_ruangan_selected agar saat load awal menu laporan bulanan sudah memiliki
//                value
                $this->load->view("header", $data);
//            DariSini Cocokan dengan datapengguna/index (views)
                $this->load->view("datalaporan/$p", $data);
                $this->load->view("footer");
                date_default_timezone_set('Asia/Jakarta');

            }


        }
    }

    public function cetakLaporan()
    {
        $data['mahasiswa'] = $this->db->query("SELECT * FROM mahasiswa ORDER BY id DESC")->result();

        $dompdf = new DOMPDF();


        $html = $this->load->view('welcome_message', $data, true);


        $dompdf->load_html($html);

        $dompdf->set_paper('A4', 'landscape');

        $dompdf->render();
        $pdf = $dompdf->output();

        $dompdf->stream('laporanku.pdf', array("Attachment" => false));
    }

    public function cari_laporan()
    {
//        zanul
//        $id = hashids_decrypt($id);
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        if (!isset($ceks)) {
            redirect("web/login");
        } else {
            $p = "range_tgl";
            $data['judul_web'] = "Cetak Laporans";

            $data['filter_date_dari'] = $this->input->post('dari_tgl');
            $data['filter_date_sampai'] = $this->input->post('sampai_tgl');

            $tanggalAwal = $this->input->post('dari_tgl');
            $tanggalAkhir = $this->input->post('sampai_tgl');

//            echo "dari:".$tanggalAwal."sampai".$tanggalAkhir;
            $data['laporan_list'] = $this->Guzzle_model->getStatusRuanganByTanggal($tanggalAwal, $tanggalAkhir);
            $this->load->view("header", $data);
            $this->load->view("datalaporan/$p", $data);
            $this->load->view("footer");

        }
    }

    public function index_old()
    {
//        redirect('datapengguna/v');
        redirect('datalaporan/v');

    }


}


