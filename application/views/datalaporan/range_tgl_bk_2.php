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
            <div class="panel-body">
                <!--                MulaiDisini Lihat di datapengguna/index.php (views)-->
                <center>
                    <div class="table-responsive">
                        <h1>Cetak Laporan</h1>
                        <!--                        <form action="/brugak/reports/cari_laporan.html" method="post">-->
                        <form action="<?php echo $link1; ?>/<?php echo $link2; ?>/f.html" method="post">

                            <table>
                                <tr>
                                    <th style="">Dari Tanggal</th>
                                    <td width="5px"></td>
                                    <?php if ($filter_date_dari == null) : ?>
                                        <td>
                                            <input type="date"
                                                   value="<?php echo date('Y-m-d') ?>"
                                                   id="dari_tgl" name="dari_tgl"
                                                   required="required">
                                        </td>
                                    <?php else : ?>
                                        <td>
                                            <input type="date"
                                                   value="<?php echo $filter_date_dari; ?>"
                                                   id="dari_tgl" name="dari_tgl"
                                                   required="required">
                                        </td>
                                    <?php endif; ?>
                                    <td width="5px"></td>

                                    <th style="">Sampai Tanggal</th>
                                    <td width="5px"></td>
                                    <?php if ($filter_date_sampai == null) : ?>
                                        <td>
                                            <input type="date"
                                                   value="<?php echo date('Y-m-d'); ?>"
                                                   id="sampai_tgl" name="sampai_tgl"
                                                   required="required">
                                        </td>
                                    <?php else : ?>
                                        <td>
                                            <input type="date"
                                                   value="<?php echo $filter_date_sampai; ?>"
                                                   id="sampai_tgl" name="sampai_tgl"
                                                   required="required">
                                        </td>
                                    <?php endif; ?>
                                    <td width="5px"></td>

                                    <!--                                    button filter disamping-->
                                    <!--                                    <td style="">-->
                                    <!--                                        <button type="submit" class="btn btn-primary" name="filter">-->
                                    <!--                                            Filter-->
                                    <!--                                        </button>-->
                                    <!--                                    </td>-->
                                </tr>
                            </table>
                            <!--                            mencoba-->
                            <table>
                                <thead>
                                <tr style="height: 15px;"></tr>
                                <tr>
                                    <th width="15px"></th>
                                    <th style="">Pilih Ruangan</th>
                                    <th width="5px"></th>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                </thead>

                            </table>
<!--                            taruh disini-->
                            <table>
                                <thead>
                                <tr class="text-center">
                                    <th>

                                        <div class="form-group" style="align-items: center; text-align: center">
                                            <label hidden class="control-label col-lg-1" style="text-align: center">Ruangan</label>
                                            <div class="col-lg-12">
                                                <select class="form-control default-select2" id="id_ruangan"
                                                        name="id_ruangan" required>
<!--                                                    SAMPAIDISINI-->
<!--                                                    <option value="">- Pilih -</option>-->
                                                    <?php if($id_ruangan_selected==null):?>
<!--                                                        <option value="0" selected>Semua Ruangan</option>-->
                                                        <option value="" selected>- Pilih -</option>
                                                        <option value="0">Semua Ruangan</option>
                                                    <?php else:?>
                                                        <option value="0" selected>Semua Ruangan</option>
                                                        <?php foreach ($ruangan_all as $item): ?>
                                                            <?php if($item['id']==$id_ruangan_selected):?>
                                                                <option selected value="<?php echo $item['id']; ?>" >
                                                                    <?php echo $item['nama']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif;?>


                                                    <?php foreach ($ruangan_all as $item): ?>
                                                        <option value="<?php echo $item['id']; ?>" >
                                                            <?php echo $item['nama']; ?>
                                                        </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>

                                    </th>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                </thead>
                            </table>

                            <table>
                                <thead>
                                <tr>
                                    <!--                                    hay button filter dibawah-->
                                    <button type="submit" class="btn btn-primary" name="filter">
                                        Filter
                                    </button>
                                </tr>
                                </thead>
                            </table>
                            <!-- <?php /*if($item_ruangan==null):*/ ?>
                            <?php /*echo "item ruangan kosong";*/ ?>
                            <?php /*else:*/ ?>
                            <?php /*echo $item_ruangan['nama'];*/ ?>
                            --><?php /*endif;*/ ?>

                        </form>

                    </div>

                </center>
            </div>
            <div class="panel-body">
                <!--                            Tambah Pengguna dari baris dibawah Tambah $judul_web-->
                <hr>
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <!--                        id ruangan, id, ob, id pengawas, status ob, status pengawas, aksi-->
                            <th width="1%" style="text-align: center">No.</th>
                            <th style="text-align: center">Ruangan</th>
                            <th style="text-align: center">OB</th>
                            <th style="text-align: center">Status OB</th>
                            <th style="text-align: center">Pengawas</th>
                            <th style="text-align: center">Status Pengawas</th>
                            <!--                            <th style="text-align: center" width="10%">Aksi</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        foreach ($laporan_list as $key => $baris):
                            ?>
                            <tr>
                                <td style="text-align: center"><b><?php echo $no++; ?></b></td>
                                <td style="text-align: center"><?php echo ucfirst($this->Mcrud->get_nama_ruangan($baris["id_ruangan"])); ?></td>
                                <td style="text-align: center"><?php echo ucfirst($this->Mcrud->get_user_name_by_id($baris["id_ob"])); ?></td>
                                <td style="text-align: center"><?php echo $baris["status_ob"]; ?></td>
                                <td style="text-align: center"><?php echo ucfirst($this->Mcrud->get_pengawas_name_by_id($baris["id_pengawas"])); ?></td>
                                <td style="text-align: center"><?php echo $baris["status_pengawas"]; ?></td>

                                <!--                                <td align="center">-->
                                <!--                                    --><?php //if ($baris['role'] != 'superadmin') :
                                ?>
                                <!--                                        <a href="--><?php //echo $link1;
                                ?><!--/--><?php //echo $link2;
                                ?><!--/c.html"-->
                                <!--                                           class="" title="Cetak"-->
                                <!--                                           onclick="">-->
                                <!--                                            <i class="fa fa-print btn btn-danger"></i>-->
                                <!--                                        </a>-->
                                <!--                                    --><?php //endif;
                                ?>
                                <!--                                </td>-->

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div style="text-align: center; font-weight: bold">
                        <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/c.html"
                           class="" title="Cetak"
                           onclick="" target="_blank">
                            <i class="fa fa-print btn btn-danger" style="padding: 10px"> Cetak </i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="view_data"></div>
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<script type="text/javascript">
    $(document).ready(function () {

    });

    function filter(current_date) {
        var dari_tgl = $("#dari_tgl").val();
        var sampai_tgl = $("#sampai_tgl").val();

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/Reports/cari_laporan",
            data: "dari_tgl=" + dari_tgl + "&sampai_tgl=" + sampai_tgl,
            cache: false,
            success: function (data) {
                // $("#view_data").html(data);
            }
        });
    }

    function prosesPeriode(current_date) {
        var dari_tgl = $("#dari_tgl").val();
        var sampai_tgl = $("#sampai_tgl").val();
        alert("dari tgl : " + dari_tgl + " sampai tgl : " + sampai_tgl);
        // var dari_tgl = document.getElementById('dari_tgl');
        // dari_tgl.valueAsDate = new Date();
        //
        // dari_tgl.onchange=function () {
        //     alert(this.value())
        // }
    }
</script>
