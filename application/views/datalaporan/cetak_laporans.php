
<?php
$hari = ['Pagi', 'Siang', 'Sore', 'Malem'];
//$role = ['OB', 'PA','PN'];
$role = ['OB', 'PA'];
$status = ['St', 'Nb'];
?>

<div class="containers">

    <div>
        <h2 class="j-center">LAPORAN KEBERSIHAN</h2>
        <h3 class="j-center"><?php echo $this->session->userdata("id_ruangan_selected")?></h3>
        <h3 class="j-center"><?php echo $this->session->userdata("tgl_awal"); ?> s.d <?php echo $this->session->userdata("tgl_akhir"); ?> </h3>
        <h3 class="j-center">room id: <?php echo $id_room_select; ?></h3>
        <h3 class="j-center">tgl first sql: <?php echo $tgl_first; ?></h3>
        <h3 class="j-center">tgl end sql: <?php echo $tgl_end; ?></h3>
        <h3 class="j-center">tgl first indo: <?php echo $tgl_first_indo; ?></h3>
        <h3 class="j-center">tgl end indo: <?php echo $tgl_end_indo; ?></h3>

        <div>
            <table >
                <!--                <tr>-->
                <!--                    <td class="j-bold j-arial-font">Bulan</td>-->
                <!--                    <td class="j-bold j-arial-font">:</td>-->
                <!--                </tr>-->
                <tr>
                    <td class="j-bold j-arial-font">Ruangan</td>
                    <td class="j-bold j-arial-font">:</td>
                    <?php if($this->session->userdata("id_ruangan_selected")==0 || $this->session->userdata("id_ruangan_selected")=="0"):?>
                        <td class="j-bold j-arial-font">Semua Ruangan</td>
                    <?php else: ?>
                        <!--                        <td class="j-bold j-arial-font">--><?php //echo $this->session->userdata("id_ruangan_selected") ;?><!--</td>-->
                        <td class="j-bold j-arial-font"><?php echo $get_ruangan["nama"]; ?></td>
                    <?php endif; ?>
                </tr>
            </table>
        </div>
    </div>
    <div style="height: 30px">
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
            <tbody>

            <?php $index=1; ?>
            <?php foreach($list_status_ruangan as $key=>$value) :?>
                <?php $this->session->set_userdata("saved_date",$value["tanggal"]); ?>
                <tr class="j-center"><?php echo $this->session->userdata("saved_date");?></tr>
            <?php endforeach; ?>

            </tbody>
        </table>

        <div style="height: 50px">
            <!--            Untuk enter, jangan dihapus-->
        </div>

        <div class="" style="text-align: left;padding-right: 20px">

        </div>
        <div class="" style="text-align: left;padding-right: 20px">

            <ul style="list-style: none">

                <li class="j-arial-font j-direction-ltr" style="text-align: right;padding-right: :10px">OB : Office Boy</li>
                <li class="j-arial-font j-direction-ltr" style="text-align: right;padding-right: :10px">PA : Pengawas</li>
                <li class="j-arial-font j-direction-ltr" style="text-align: right;padding-right: :10px">St : Status</li>
                <li class="j-arial-font j-direction-ltr" style="text-align: right;padding-right: :10px">Nb : Catatan</li>
            </ul>
        </div>
    </div>
</div>



<!---->

<style>
    .j-table tr td.j-img{
        text-align: center;
        background-color: white;
        padding-top: 7px;
        padding-right: 10px;
        padding-left: 17px;
    }

    .j-table tr td img{
        padding-top: 2px;
        padding-right: 10px;
        padding-left: 9px;
        padding-bottom: 10px;
    }

    .j-table tr td.j-img-2{
        text-align: center;
    }

    .j-center{
        text-align: center;
    }

    .j-table tr td.j-align {
        text-align: center;
        background-color: #157dcc;
        padding-right: 10px;
        padding-left: 17px;
    }

    .table-container{
        background-color: #00CC00;
        overflow: hidden;
    }
    .j-table{
        border-collapse:collapse ;
        border: solid 2px;
        table-layout: auto;
        width:100%;
        overflow-wrap: break-word;
    }

    .j-table img{
        margin: 0px auto;

    }

    .j-table thead tr th{
        background-color: antiquewhite;
    }

    .j-table thead tr th,
    .j-table tbody tr td{
        border-width: 2px;
        border: solid!important;
        padding: 5px;

    }

    table{
        border: none;
        color: #1f1d1d;
    }

    .j-opacity{
        opacity: .2;
    }


    .three {
        border-style: dotted;
        border-color: blue;
    }
</style>




