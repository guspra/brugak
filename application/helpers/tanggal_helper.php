<?php

function tgl_sql($date){
    $exp=explode("-",$date);
    if(count($exp) == 3){
        $bln_indo = getBulan($exp[1]);
//        $date = $exp[2].'-'.$exp[1].'-'.$exp[0];
        $date = $exp[2].'-'.$bln_indo.'-'.$exp[0];
    }
    return $date;
}

function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function tgl_indo($date){
    $exp = explode("-",$date);
    $date = "";
    if(count($exp)>0){
        $bulan = getBulan($exp[1]);
        $data = $exp[2]." ".$bulan." ".$exp[0];
    }
    return $data;
}



?>