
<?php
$hari = ['Pagi', 'Siang', 'Sore', 'Malem'];
//$role = ['OB', 'PA','PN'];
$role = ['OB', 'PA'];
$status = ['St', 'Nb'];
?>

<div class="containers">

    <div>
        <h2 class="j-center">LAPORAN KEBERSIHAN</h2>
        <div>
            <table >
                <!--                <tr>-->
                <!--                    <td class="j-bold j-arial-font">Bulan</td>-->
                <!--                    <td class="j-bold j-arial-font">:</td>-->
                <!--                </tr>-->
                <tr>
                    <td class="j-bold j-arial-font">Ruangan</td>
                    <td class="j-bold j-arial-font">haha</td>
                    <td class="j-bold j-arial-font">:</td>
                    <?php if($this->session->userdata("id_ruangan_selected")==0):?>
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
    <div class="table-containers">
        <table class="j-table">
            <!--            <thead style="border-color:#1f1d1d; border-style: solid ; background-color: antiquewhite ; -->
            <thead>
            <tr>
                <th rowspan="3" width="100px" class="">Tgl</th>
                <?php foreach ($hari as $it) { ?>
                    <th class="j-arial-font " colspan="4"><?php echo $it ?></th>
                <?php } ?>
            </tr>
            <tr>
                <?php foreach ($hari as $it) { ?>
                    <?php foreach ($role as $its) { ?>
                        <th class="j-arial-font " colspan="2"><?= $its ?></th>
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
            <?php foreach ($mahasiswa as $list): ?>
<!--            --><?php //echo $list->nim;?>
                <tr class="j-center" >
                    <!--                 td dibawah utk set value utk kolom tanggal-->
                    <?php if($index%2==0){ ?>
                        <td class="" >
                            <?php echo $index++.' Mei 2022'; ?>
                        </td>
                        <!--                        xsini-->
                        <?php for($i=0;$i<8;$i++){?>
                            <!--                        di setiap 1 index $i ada 2 <td>-->
                            <td class="">
                                <!--                            <img src="./assets/img/check.png" alt="" width="15" height="15" style="max-height: 100px; max-width: 100px;">-->
                                <!--                            <img src="./assets/img/check-min.png" alt="" width="15" height="15" style="max-height: 100px; max-width: 100px;">-->
                                <?php if($i%2==0) {?>
                                    <!--                                <div class="j-text-center-w-green">Selesai</div>-->
                                    <img src="./assets/img/fix-check-green-min.png" alt="" width="15" height="15" >
                                    <?php
                                } else { ?>
                                    <!--                                <div class="j-text-center-w-red">Belum</div>-->
                                    <img src="./assets/img/fix-cross-red-min.png" alt="" width="15" height="15" >
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php if($i%2==0) {?>
                                    <div class="j-text-center">Selesai</div>
                                    <?php
                                } else { ?>
                                    <div class="j-text-center-w-red">Belum</div>
                                    <?php
                                }
                                ?>
                            </td>
                        <?php } ?>
                        <?php
                    } else {?>
                        <td class="j-text-center"  >
                            <?php echo $index++.' Mei 2022'; ?>
                        </td>
                        <!--                        csini-->
                        <?php for($i=0;$i<8;$i++){?>
                            <!--                        di setiap 1 index $i ada 2 <td>-->
                            <td class="">
                                <!--                            <img src="./assets/img/check.png" alt="" width="15" height="15" style="max-height: 100px; max-width: 100px;">-->
                                <!--                            <img src="./assets/img/check-min.png" alt="" width="15" height="15" style="max-height: 100px; max-width: 100px;">-->
                                <?php if($i%2==0) {?>
                                    <!--                                <div class="j-text-center-w-green">Selesai</div>-->
                                    <img src="./assets/img/fix-check-green-min.png" alt="" width="15" height="15" >
                                    <?php
                                } else { ?>
                                    <!--                                <div class="j-text-center-w-red">Belum</div>-->
                                    <img class="j-ganjil" src="./assets/img/fix-cross-red-min.png" alt="" width="15" height="15" >
                                    <?php
                                }
                                ?>
                            </td>
                            <td class="j-img-2">
                                <?php if($i%2==0) {?>
                                    <div class="">Selesai</div>
                                    <?php
                                } else { ?>
                                    <div class="">Belum</div>
                                    <?php
                                }
                                ?>
                            </td>
                        <?php } ?>
                        <?php
                    }
                    ?>


                    <!--                    8 berdasarkan jumlah kolom OB dan PA pada setiap shift (Pagi,Siang,Sore,Malem)-->

                </tr>
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

    /*.j-full-w {*/
    /*width: 100%;*/
    /*}*/

    /*.j-direction-ltr{*/
    /*direction: rtl;*/
    /*unicode-bidi: bidi-override;*/
    /*}*/

    /*.j-arial-font{*/
    /*font-family: "Lato", "proxima-nova", "Helvetica Neue", Arial, sans-serif;*/
    /*font-weight: bold;*/
    /*z-index: 100;*/
    /*position: relative !important;*/
    /*}*/

    /*.j-arial-font-unbold{*/
    /*font-family: "Lato", "proxima-nova", "Helvetica Neue", Arial, sans-serif;*/
    /*font-weight: normal;*/
    /*z-index: 100;*/
    /*position: relative !important;*/
    /*}*/

    /*.j-right{*/
    /*right: -20px;*/
    /*width: ;*/
    /*}*/

    /*.j-text-center {*/
    /*text-align: center;*/
    /*font-family: Arial;*/
    /*}*/

    /*.j-text-center-w-green {*/
    /*text-align: center;*/
    /*!*background-color: #00CC00;*!*/
    /*display:inline-block;*/
    /*line-height: 0.90em;*/
    /*width: 5.00em;*/
    /*font-family: 'Gabriela', serif;*/
    /*color: #081102;*/

    /*!*border: 2px solid red;*!*/
    /*border-top-left-radius: 50px 20px;*/


    /*background: rgba(43, 166, 203, 0.5 !* alpha value for background *!);*/
    /*padding: 0.2em 0.1em 0.2em 0.2em;*/
    /*font-weight: bold !important;*/
    /*}*/

    /*.j-bold{*/
    /*font-weight: bold !important;*/
    /*}*/

    /*.j-text-center-w-red {*/
    /*text-align: center;*/
    /*!*background-color: #FF1E3A;*!*/
    /*display: inline-block;*/
    /*font-family: 'Gabriela', serif;*/
    /*color: #081102;*/
    /*border-radius: 25px;*/
    /*background: rgba(43, 166, 203, 0.5 !* alpha value for background *!);*/
    /*padding: 0.2em 0.1em 0.2em 0.2em;*/
    /*border-radius: 5px;*/
    /*font-weight: bold !important;*/
    /*}*/

    /*.containers{*/
    /*background-color: #00CC00;*/
    /*}*/
    table{
        border: none;
        color: #1f1d1d;
    }

    .j-opacity{
        opacity: .2;
    }

    /*table thead tr th {*/
    /*border-collapse: collapse; border: none;*/
    /*background-color: antiquewhite;*/

    /*border: solid red 1px;*/
    /*font-weight: bold !important;*/
    /*}*/

    .three {
        border-style: dotted;
        border-color: blue;
    }
</style>




