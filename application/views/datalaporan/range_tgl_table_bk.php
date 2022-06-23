<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="dashboard.html">Dashboard</a></li>
    <li class="active"><?php echo $judul_web; ?></li>
</ol>
<!-- end breadcrumb -->
<h1 class="page-header">Data
    <small><?php echo $judul_web; ?></small>
</h1>
<!-- end page-header -->
<div class="row">
    <div class="col-md-12">
        <?php
        echo $this->session->flashdata('msg');
        ?>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                            class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                       data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                       data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div>
                <!--                MulaiDisini Lihat di datapengguna/index.php (views)-->
                <center>
                    <div class="container">
                        <h1>Cetak Laporan</h1>
                        <br>
                        <form action="" method="post">
                            <table>
                                <tr>
                                    <td style="">Dari Tanggal</td>
                                    <td width="5px"></td>
                                    <td><input type="date" value="<?php echo $current_date; ?>" id="dari_tgl" name="dari_tgl"
                                               required="required"></td>
                                    <td width="5px"></td>
                                    <td style="">Sampai Tanggal</td>
                                    <td width="5px"></td>
                                    <td><input type="date" value="<?php echo $current_date; ?>" id="sampai_tgl" name="sampai_tgl"
                                               required="required"></td>
                                    <td width="5px"></td>
                                    <td style=""><input type="button" onclick="prosesPeriode('<?php echo $current_date; ?>')" class="btn btn-primary" name="filter" id="filter"
                                                        value="Filter"></td>
                                </tr>
                            </table>
                        </form>
                        <br>

                        <br>
                        <table style="width: 800px;" class="table table-bordered">
                            <thead class="" style="">
                            <tr style="">
                                <th class="" style="text-align: center">No</th>
                                <th style="text-align: center">Username</th>
                                <th style="text-align: center">Nama Lengkap</th>
                                <th style="text-align: center">Tanggal Masuk</th>
                                <th style="text-align: center">Whatsapp</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                            </thead>

                            <?php

                            ?>

                            <?php foreach ($users as $key => $it) { ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $key + 1; ?></td>
                                    <td style="text-align: center"><?php echo $it->username; ?></td>
                                    <td style="text-align: center"><?php echo $it->nama; ?></td>
                                    <td style="text-align: center"><?php echo $it->created_at; ?></td>
                                    <td style="text-align: center"><?php echo $it->whatsapp; ?></td>
                                    <td style="text-align: center">
                                        <strong>
                                            <i class="fa fa-print btn btn-danger"></i>
                                        </strong>
                                    </td>
                                    <!--                    <td style="text-align: center">-->
                                    <!--                                    <td class="btn btn-danger btn-xs"-->
                                    <!--                                        style="align-items: center; vertical-align: middle;">-->
                                    <!--                                        <i class="fa fa-print"></i>-->
                                    <!--                                    </td>-->


                                </tr>

                                <?php
                            } ?>


                        </table>

                    </div>
                </center>
            </div>
        </div>
        <div class="panel-body">
            <!--                            Tambah Pengguna dari baris dibawah Tambah $judul_web-->
            <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/t.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah <?php echo $judul_web; ?></a>
            <hr>
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <!--                        id ruangan, id, ob, id pengawas, status ob, status pengawas, aksi-->
                        <th width="1%" style="text-align: center">No.</th>
                        <th style="text-align: center">Id Ruangan</th>
                        <th style="text-align: center">Id OB</th>
                        <th style="text-align: center">Id Pengawas</th>
                        <th style="text-align: center">Status OB</th>
                        <th style="text-align: center">Status Pengawas</th>
                        <th style="text-align: center" width="10%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=1;
                    foreach ($laporan_list as $key => $baris):
                        ?>
                        <tr>
                            <td style="text-align: center"><b><?php echo $no++; ?></b></td>
                            <td style="text-align: center"><?php echo $baris->id_ruangan; ?></td>
                            <td style="text-align: center"><?php echo $baris->id_ob; ?></td>
                            <td style="text-align: center"><?php echo $baris->id_pengawas; ?></td>
                            <td style="text-align: center"><?php echo $baris->status_ob; ?></td>
                            <td style="text-align: center"><?php echo $baris->status_pengawas; ?></td>


                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<script type="text/javascript">
    $(document).ready(function(){

    });

    function prosesPeriode(current_date) {
        var dari_tgl = $("#dari_tgl").val();
        var sampai_tgl = $("#sampai_tgl").val();
        alert("dari tgl : "+dari_tgl+" sampai tgl : "+sampai_tgl);
        // var dari_tgl = document.getElementById('dari_tgl');
        // dari_tgl.valueAsDate = new Date();
        //
        // dari_tgl.onchange=function () {
        //     alert(this.value())
        // }
    }
</script>
