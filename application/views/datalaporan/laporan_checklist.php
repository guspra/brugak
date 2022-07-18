<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');
$this->load->library('session');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        //set Gambar ketika menemukan last page
//        $image_file = K_PATH_IMAGES.'kumhamrad.png';
//        $this->Image($image_file, 100, 100, 26, 31, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
//        $this->setFont('helvetica', 'B', 10);
        if($this->page==1){
            $image_file = K_PATH_IMAGES.'kumhamrad.png';
            $this->Image($image_file, 18, 13, 26, 31, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            // Set font
            $this->setFont('helvetica', 'B', 10);
            // Title
            $this->Ln(4);
            $this->Cell(0, 15, 'KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->Cell(0, 15, 'REPUBLIK INDONESIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->Cell(0, 15, 'KANTOR WILAYAH NUSA TENGGARA BARAT', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->setFont('helvetica', '', 10);
            $this->Cell(0, 15, 'Jalan Majapahit No. 44 Mataram', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->Cell(0, 15, 'Telepon : 0370 – 7856244', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->Cell(0, 15, 'Laman : ntb.kemenkumham.go.id, Surel : kanwilntb@kemenkumham.go.id', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(10);
//        $style_up = array('width' => 0.5, 'line' => '2,2,2,2', 'phase' => 1, 'color' => array(0, 0, 0));
//        $this->Line(10, 40, 200, 40, $style_up);
            $style = array('width' => 1.0, 'line' => '2,2,2,2', 'phase' => 1, 'color' => array(0, 0, 0));
            $style2 = array('width' => 0.5, 'line' => '2,2,2,2', 'phase' => 1, 'color' => array(0, 0, 0));
            $this->Line(10, 46, 287, 46, $style2);
            $this->Line(10, 47, 287, 47, $style);
            $this->setFont('helvetica', 'B', 15);
            $this->Ln(10);
            $this->Cell(0, 15,
                'Laporan Kebersihan',
                0,
                false,
                'C',
                0,
                '',
                0,
                false,
                'M', 'M');
            $this->Ln(10);
            $this->setFont('helvetica', '', 10);
            $this->Ln(7);

            $this->setFont('helvetica', '', 10);
        }

        //cuyss

    }

    // Page footer
    public function Footer_bk() {
        $this->setY(-15);
        // Set font
        $this->setFont('helvetica', 'I', 8);
        if($this->lastPage(true)){
            $this->Cell(173,10, ' FOOTER TEST ssss -  {nb}', 0, 0);
        }
        // Position at 15 mm from bottom

        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

    }


    public function Footer() {
        $tpages = $this->getAliasNbPages();
        $pages = $this->getPage();

        $footer =  $pages ." / ". $tpages;

        if ($pages == 1 ) {
//            $footer = 'FIRST' . $pages .'/'. $tpages;
            $footer =  $pages .'/'. $tpages;
        }
        $this->Cell(0, 10, $footer, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }



}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$hari_ini = date("Y-m-d");
$hari_ini_id = tgl_indo($hari_ini);


// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
//$pdf->setTitle('TCPDF Example 003');
$pdf->setTitle("Laporan Kebersihan".$hari_ini_id."_".$nama_ruangan);
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
//$pdf->setTopMargin(10);
$pdf->setLeftMargin(10);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
//$pdf->setFont('times', '', 12);
$pdf->setFont('helvetica', 'B', 12);
// add a page
$pdf->AddPage();

$pdf->Ln(30);

// set some text to print
$txt = <<<EOD
Laporan Jadwal Kegiatan
EOD;



$pdf->Ln(10);
$txt = $this->session->userdata('tgl_awal_id').' S.D. '.$this->session->userdata('tgl_akhir_id');



$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

$ruangan ='<div>';
$ruangan .='<table><tr><td class="j-bold j-arial-font"><h4>'.$nama_ruangan;
//sampai disini bisa tampilkan nama ruangan

$ruangan .='</h4></td></tr></table></div>';
$pdf->WriteHTMLCell(0,0,'','',$ruangan,0,1,0,true,'L',true);
$pdf->setFont('helvetica', 'B', 9);
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'line' => 4, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
//header tanggal dan lain-lain
$table_header = '<div class="editable-container">';
$table_header .='<table style="border:1px solid #000; padding: 6px">';
$table_header .='<thead>';
$table_header .= '<tr style="background-color: #e8c3be;"> <th align="center" colspan="2" rowspan="3" 
style="vertical-align: middle; text-align: center;border: 1px solid #000;">';

$table_header .='<b>Tanggal</b></th>';

foreach ($shifts as $id=>$val){
    $table_header .='<th colspan="4" align="center" style="border: 1px solid #000;"><b>'.ucwords($val).'</b></th>';
}
$table_header .='</tr>';
$table_header .='<tr style="background-color: #e8c3be;">';
foreach ($shifts as $key=>$val){
    foreach ($roles as $k=>$v){
        $table_header .= '<th colspan="2" align="center" style="border:1px solid #000;"><b>'.ucwords($v).'</b></th>';
    }
}
$table_header .='</tr>';
$table_header .='<tr style="background-color: #e8c3be; ">';
    foreach ($shifts as $key=>$val){
        foreach ($roles as $i=>$v){
            foreach ($status as $k=>$nilai){
                $table_header .='<th colspan="1" align="center" style="border: 1px solid #000;"><b>'.ucwords($nilai).'</b></th>';
            }
        }
    }
$table_header .='</tr>';

$table_header .='</thead>';
$table_header .='<tbody>';
foreach ($laporan_tgl as $index=>$val){
    $table_header .='<tr>';
    //cuys
        $table_header .='<td colspan="2" style="border: 1px solid #000;">'.tgl_indo($val->tanggal);
        $table_header .='</td>';

        if($val->status_ob_pagi=="SUDAH"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        } else if($val->status_ob_pagi=="BELUM") {
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        }

        if($val->catatan_ob_pagi!=""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_ob_pagi;
            $table_header .= '</td>';
        } else if($val->catatan_ob_pagi=="") {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '-';
            $table_header .= '</td>';
        }

        if($val->status_pengawas_pagi=="SUDAH"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        } else if($val->status_pengawas_pagi=="BELUM") {
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        }

        if($val->catatan_pengawas_pagi!=""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_pengawas_pagi;
            $table_header .= '</td>';
        } else if($val->catatan_pengawas_pagi=="") {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= "-";
            $table_header .= '</td>';
        }

        if($val->status_ob_siang=="SUDAH"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        } else if($val->status_ob_siang=="BELUM"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        }

        if($val->catatan_ob_siang!=""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_ob_siang;
            $table_header .= '</td>';
        } else if($val->catatan_ob_siang==""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= "-";
            $table_header .= '</td>';
        }

        if($val->status_pengawas_siang=="SUDAH"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        } else if($val->status_pengawas_siang=="BELUM"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        }

        if($val->catatan_pengawas_siang!=""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_pengawas_siang;
            $table_header .= '</td>';
        } else if($val->catatan_pengawas_siang==""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= "-";
            $table_header .= '</td>';
        }

        if($val->status_ob_sore=="SUDAH"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        } else if($val->status_ob_sore=="BELUM"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        }

        if($val->catatan_ob_sore!=""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_ob_sore;
            $table_header .= '</td>';
        } else if($val->catatan_ob_sore==""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= "-";
            $table_header .= '</td>';
        }

        if($val->status_pengawas_sore=="SUDAH"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        } else if($val->status_pengawas_sore=="BELUM"){
            $table_header .='<td class="icon-checklist" style="border: 1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .='<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .='</td>';
        }

        if($val->catatan_pengawas_sore!=""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_pengawas_sore;
            $table_header .= '</td>';
        } else if($val->catatan_pengawas_sore==""){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= "-";
            $table_header .= '</td>';
        }

    $table_header .='</tr>';
}
$table_header .='</tbody>';
$table_header .='</table>';
$table_header .= '</div>';

$pdf->WriteHTMLCell(0,0,'','',$table_header,0,1,0,true,'C',true);
// move pointer to last page
$pdf->lastPage();

//dari sini
$pdf->setFont('helvetica', 'B', 9);
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'line' => 4, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);

$text="DUMMY";

//deklarasi array bantuan
$pdf->Ln(7);

//dikomen dari sini
//$tbl = <<<EOD
//<table cellspacing="0" cellpadding="1" border="1">
//    <tr >
//        <td class="text-center" style="text-align: center; padding: 70px 0; border: 1px solid black; height: 60px; line-height:30px;" rowspan="3" colspan="1">
//        <br /><br />Tanggal</td>
//        <td>COL 2 - ROW 1</td>
//        <td>COL 3 - ROW 1</td>
//    </tr>
//    <tr>
//        <td rowspan="2">COL 2 - ROW 2 - COLSPAN 2<br />text line<br />text line<br />text line<br />text line</td>
//        <td>COL 3 - ROW 2</td>
//    </tr>
//    <tr>
//       <td>COL 3 - ROW 3</td>
//    </tr>
//
//</table>
//EOD;
//
//$pdf->writeHTML($tbl, true, false, false, false, '');

//dikomen sampai sini


//$pdf->Cell(25, 24, $nama_ruangan, 0, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
//$pdf->Ln(25);
//$pdf->Cell(25, 24, "Tanggal", 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');


//$pdf->AddPage();
$pdf->setFont('helvetica', 'B', 10);
$pdf->Ln();


//Close and output PDF document
//$pdf->Output('example_003.pdf', 'I');
$today = date("Y-m-d");
$today_id = tgl_indo($today);

//$pdf->Output("Laporan Kebersihan".$today_id."_".$nama_ruangan.'.pdf', 'D');
$pdf->Output("Laporan Kebersihan".$today_id."_".$nama_ruangan.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
