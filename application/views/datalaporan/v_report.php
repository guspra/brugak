<?php
//============================================================+
// File name   : example_005.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 005 for TCPDF class
//               Multicell
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
 * @abstract TCPDF - Example: Multicell
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// hilangkan fungsi require once_disini karena kita sudah sisipkan filenya di library pdf_report
//require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 005');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' ', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

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
$pdf->setFont('times', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->setFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example

$title = <<<EOD
<h2>Laporan Kebersihan</h2>
<!--untuk enter-->
<!--<span style="white-space: pre-line"></span>-->
EOD;
$title .='<h3>'.$this->session->userdata('tgl_awal').' S.D. '.$this->session->userdata('tgl_akhir');

$title .='</h3>';
$pdf->WriteHTMLCell(0,0,'','',$title,0,1,0,true,'C',true);


$ruangan ='<div>';
$ruangan .='<table><tr><td class="j-bold j-arial-font"><h3>'.$item_ruangan;

$ruangan .='</h3></td></tr></table></div>';
$pdf->WriteHTMLCell(0,0,'','',$ruangan,0,1,0,true,'L',true);

$table_header = '<div class="table-containers">';
$table_header .= '<table style="border:1px solid #000; padding:6px;">';
$table_header .= '<thead>';
$table_header .= '<tr style="background-color: #e8c3be;">
                    <th align="center" colspan="2" rowspan="3" 
                    style="vertical-align: middle; text-align: center; border:1px solid #000;"><b>Tgl</b></th>';
foreach ($shifts as $key=>$val){
    $table_header .= '<th colspan="4" align="center" style="border:1px solid #000;"><b>'.ucwords($val);
    $table_header .='</b></th>';
}
$table_header .="</tr>";

$table_header .= '<tr style="background-color: #e8c3be;">';
foreach ($shifts as $key=>$val){
    foreach ($roles as $i=>$v){
        $table_header .= '<th colspan="2" align="center" style="border:1px solid #000;"><b>'.ucwords($v);
        $table_header .= '</b></th>';
    }
}
$table_header .='</tr>';

$table_header .='<tr style="background-color: #e8c3be;">';
foreach ($shifts as $key=>$val){
    foreach ($roles as $i => $v){
        foreach ($status as $k=>$nilai){
            $table_header .= '<th colspan="1" align="center" style="border:1px solid #000;"><b>'.ucwords($nilai);
            $table_header .='</b></th>';
        }
    }
}
$table_header .='</tr>';

$table_header .="</thead>";
$table_header .='<tbody>';
foreach ($laporan_status_ruangan as $index=>$val){
    $table_header .='<tr>';
    //cuys
        $table_header .='<td colspan="2" style="border:1px solid #000;">'.tgl_indo($val->tanggal);
        $table_header .='</td>';

        //PAGI
        //ob pagi
        if($val->status_ob_pagi=="SUDAH"){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        }

        if($val->catatan_ob_pagi!='' || $val->catatan_ob_pagi != null){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_ob_pagi;
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_ob_pagi;
            $table_header .= '</td>';

        }
        //end ob pagi

        // pengawas pagi
        if($val->status_pengawas_pagi=="SUDAH"){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        }

        if($val->catatan_pengawas_pagi!="" || $val->catatan_pegawas_pagi!=null){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_pengawas_pagi;
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_pengawas_pagi;
            $table_header .= '</td>';
        }
        //end pengawas pagi
        //END PAGI

        //SIANG
        //ob siang
        if($val->status_ob_siang=="SUDAH"){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        }

        if($val->catatan_ob_siang !="" || $val->catatan_ob_siang != null){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_ob_siang;
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_ob_siang;
            $table_header .= '</td>';
        }
        //end ob siang

        //pengawas siang
        if($val->status_pengawas_siang=="SUDAH"){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        }

        if($val->catatan_pengawas_siang !="" || $val->catatan_pengawas_siang != null){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_pengawas_siang;
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_pengawas_siang;
            $table_header .= '</td>';
        }
        //end pengawas siang
        //END SIANG

        //SORE
        //ob sore
        if($val->status_ob_sore=="SUDAH"){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        }

        if($val->catatan_ob_sore !="" || $val->catatan_ob_sore != null){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_ob_sore;
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_ob_sore;
            $table_header .= '</td>';
        }
        //end ob sore

        // pengawas sore
        if($val->status_pengawas_sore=="SUDAH"){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= '<img src="./assets/img/CrossRed.png" alt="" width="15" height="15">';
            $table_header .= '</td>';
        }

        if($val->catatan_pengawas_sore !="" || $val->catatan_pengawas_sore != null){
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_pengawas_sore;
            $table_header .= '</td>';
        } else {
            $table_header .= '<td class="icon-checklist" style="border:1px solid #000; padding-top: 25px; padding-bottom: 25px; padding-left: 20px; padding-right: 20px">';
            $table_header .= $val->catatan_pengawas_sore;
            $table_header .= '</td>';
        }
    $table_header .='</tr>';
}
//$table_header .='<tr>';
//$table_header .='<td colspan="2" style="border:1px solid #000;" align="center">'.'<b>'.$this->session->userdata('tgl_akhir_sql').'</b>';
//$table_header .='</td>';
//$table_header .='</tr>';
$table_header .='</tbody>';
$table_header .="</table>";
$table_header .="</div>";
$pdf->WriteHTMLCell(0,0,'','',$table_header,0,1,0,true,'C',true);
//lanjutkan disini niru C:\xampp\htdocs\tes_tcpdf\application\views\laporan\v_report.php
// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
//$pdf->Output('example_005.pdf', 'I');
$pdf->Output('example_005.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
