<?php
//$hari = ['Pagi', 'Siang', 'Sore', 'Malam'];
$hari = ['PAGI', 'SIANG', 'SORE'];
//$role = ['OB', 'PA','PN'];
$role = ['OB', 'Pengawas'];
$status = ['Status', 'Cttn'];
?>

<div class="containers">

    <div>
        <h3 class="j-center">LAPORAN KEBERSIHAN</h3>

        <h4 class="j-center"><?php echo $this->session->userdata("tgl_awal"); ?>
            s.d <?php echo $this->session->userdata("tgl_akhir"); ?> </h4>


        <div>
            <table>

                <tr>
                    <td class="j-bold j-arial-font">Ruangan</td>
                    <td class="j-bold j-arial-font">:</td>
                    <?php if ($this->session->userdata("id_ruangan_selected") == 0 || $this->session->userdata("id_ruangan_selected") == "0"): ?>
                        <td class="j-bold j-arial-font">Semua Ruangan</td>
                    <?php else: ?>
                        <!--                        <td class="j-bold j-arial-font">--><?php //echo $this->session->userdata("id_ruangan_selected") ;?><!--</td>-->
                        <td class="j-bold j-arial-font"><?php echo $get_ruangan["nama"]; ?></td>
                    <?php endif; ?>
                </tr>
            </table>
        </div>
    </div>
    <div style="height: 10px">
        <!--            Untuk enter, jangan dihapus-->
    </div>
    <!--    tes tangkap session -->
    <div class="table-containers">
        <table class="j-table">
            <!--            <thead style="border-color:#1f1d1d; border-style: solid ; background-color: antiquewhite ; -->
            <thead>
            <tr>
                <th rowspan="3" width="100px" class="">Tgl</th>
                <?php foreach ($hari as $it) { ?>
                    <th class="j-arial-font " colspan="4"><?php echo $it; ?></th>
                <?php } ?>
            </tr>
            <tr>
                <?php foreach ($hari as $it) { ?>
                    <?php foreach ($role as $its) { ?>
                        <th class="j-arial-font " colspan="2"><?= $its; ?></th>
                    <?php } ?>
                <?php } ?>
            </tr>
            <tr>
                <?php foreach ($hari as $it) { ?>
                    <?php foreach ($role as $its) { ?>
                        <?php foreach ($status as $oj) { ?>
                            <th colspan="1" class="j-arial-font "><?= $oj ?></th>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </tr>
            </thead>


            <?php foreach ($list_status_ruangan as $key => $value){ ?>
                <?php $tes[$value["tanggal"]] = $value["tanggal"];?>
            <?php } ?>

            <tbody>


            <?php foreach($laporan_status_ruangan as $index=>$value){?>
                <tr>
                    <!--Cetak Tanggal Format Indonesia: -->
                    <td class="j-center"><?php echo tgl_indo($value->tanggal);?></td>

                    <!--Cetak icon centang / cross dan status keterangan-->

                    <!--PAGI STATUS OB-->
                    <?php if($value->status_ob_pagi=="SUDAH"){ ?>
                        <td class="icon-checklist" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">
<!--                            <i class="fa fa-check"></i>-->
                        </td>
                    <?php } else {?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CrossRed.png" alt="" width="15" height="15">
                            <i class="fa fa-close" style="font-size:24px;color:red"></i>
                        </td>
                    <?php } ?>

                    <?php if($value->catatan_ob_pagi!="" || $value->catatan_ob_pagi == null){ ?>
                        <td class="j-center">
                            <?php echo $value->catatan_ob_pagi;?>
                        </td>
                    <?php } else {?>

                        <td class="j-center">
                            <?php echo $value->catatan_ob_pagi;?>
                        </td>
                    <?php } ?>
                    <!--END PAGI STATUS OB-->

                    <!--PAGI STATUS PENGAWAS-->
                    <?php if($value->status_pengawas_pagi=="SUDAH"){ ?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">
                        </td>
                    <?php } else {?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CrossRed.png" alt="" width="15" height="15">
                        </td>
                    <?php } ?>

                    <?php if($value->catatan_pengawas_pagi!=""){ ?>
                        <td class="j-center">
                            <?php echo $value->catatan_pengawas_pagi;?>
                        </td>
                    <?php } else {?>
                        <td class="j-center">
                            <?php echo $value->catatan_pengawas_pagi;?>
                        </td>
                    <?php } ?>
                    <!--END PAGI STATUS PENGAWAS-->


                    <!--SIANG STATUS OB-->
                    <?php if($value->status_ob_siang=="SUDAH"){ ?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">
                        </td>
                    <?php } else {?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CrossRed.png" alt="" width="15" height="15">
                        </td>
                    <?php } ?>

                    <?php if($value->catatan_ob_siang!=""){ ?>
                        <td class="j-center">
                            <?php echo $value->catatan_ob_siang;?>
                        </td>
                    <?php } else {?>
                        <td class="j-center">
                            <?php echo $value->catatan_ob_siang;?>
                        </td>
                    <?php } ?>
                    <!--END SIANG STATUS OB-->

                    <!--SIANG STATUS PENGAWAS-->
                    <?php if($value->status_pengawas_siang=="SUDAH"){ ?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">
                        </td>
                    <?php } else {?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CrossRed.png" alt="" width="15" height="15">
                        </td>
                    <?php } ?>

                    <?php if($value->catatan_pengawas_siang!="SUDAH"){ ?>
                        <td class="j-center">
                            <?php echo $value->catatan_pengawas_siang;?>
                        </td>
                    <?php } else {?>
                        <td class="j-center">
                            <?php echo $value->catatan_pengawas_siang;?>
                        </td>
                    <?php } ?>
                    <!--END SIANG STATUS PENGAWAS-->


                    <!--SORE STATUS OB-->
                    <?php if($value->status_ob_sore=="SUDAH"){ ?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">
                        </td>
                    <?php } else {?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CrossRed.png" alt="" width="15" height="15">
                        </td>
                    <?php } ?>

                    <?php if($value->catatan_ob_sore=="SUDAH"){ ?>
                        <td class="j-center">
                            <?php echo $value->catatan_ob_sore;?>
                        </td>
                    <?php } else {?>
                        <td class="j-center">
                            <?php echo $value->catatan_ob_sore;?>
                        </td>
                    <?php } ?>
                    <!--END SORE STATUS OB-->

                    <!--SORE STATUS PENGAWAS-->
                    <?php if($value->status_pengawas_sore=="SUDAH"){ ?>
                        <td class="" style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CheckGreen.png" alt="" width="15" height="15">
                        </td>
                    <?php } else {?>
                        <td style="padding-left: 20px; padding-right: 20px">
                            <img src="./assets/img/CrossRed.png" alt="" width="15" height="15">
                        </td>
                    <?php } ?>

                    <?php if($value->catatan_pengawas_sore=="SUDAH"){ ?>
                        <td class="j-center">
                            <?php echo $value->catatan_pengawas_sore;?>
                        </td>
                    <?php } else {?>
                        <td class="j-center">
                            <?php echo $value->catatan_pengawas_sore;?>
                        </td>
                    <?php } ?>
                    <!--END SORE STATUS PENGAWAS-->

                </tr>
            <?php } ?>

            <!--start hapus-->

            <!--end hapus sampai sini-->




            </tbody>
        </table>



    </div>
</div>


<!---->

<style>
    .j-table tr td.j-img {
        text-align: center;
        background-color: white;
        padding-top: 7px;
        padding-right: 10px;
        padding-left: 17px;
    }

    .j-table tr td img {
        padding-top: 2px;
        padding-right: 10px;
        padding-left: 9px;
        padding-bottom: 10px;
    }

    .j-table tr td.j-img-2 {
        text-align: center;
    }

    .j-center {
        text-align: center;
        margin-right: auto;
        margin-left: auto;
    }

    .j-table tr td.j-align {
        text-align: center;
        background-color: #157dcc;
        padding-right: 10px;
        padding-left: 17px;
    }



    .j-table {
        border-collapse: collapse;
        border: solid 2px;
        table-layout: auto;
        width: 100%;
        overflow-wrap: break-word;
    }

    .j-table img {
        margin: 0px auto;

    }

    .j-table thead tr th {
        background-color: antiquewhite;
    }

    .j-table thead tr th,
    .j-table tbody tr td {
        border-width: 2px;
        border: solid !important;
        padding: 5px;

    }




    table {
        border: none;
        color: #1f1d1d;
    }

    .j-opacity {
        opacity: .2;
    }




</style>




