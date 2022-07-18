<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>

<ol class="breadcrumb pull-right">
    <li><a href="dashboard.html">Dashboard</a></li>
    <li class="active"><?php echo $judul_web; ?></li>
</ol>
<h1 class="page-header">Data
    <small><?php echo $judul_web;?></small>
</h1>
<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('msg');?>
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
                <center>
                    <div class="table-responsive">
                        <h1><?php echo ucwords($judul_web);?></h1>

                        <form action="<?php echo $link1;?>/<?php echo $link2?>/f.html" method="post">
                            <table>


                                <tr>
                                    <th style="">Dari Tanggal</th>
                                    <th width="5px"></th>
                                    <?php if($filter_date_dari == null) { ?>
                                        <th>
                                            <input type="date"
                                                   value="<?php echo date('Y-m-d')?>"
                                                   id="dari_tgl" name="dari_tgl"
                                                   required="required">
                                        </th>
                                    <?php } else { ?>
                                        <th>
                                            <input type="date"
                                                   value="<?php echo $filter_date_dari;?>"
                                                   id="dari_tgl" name="dari_tgl"
                                                   required="required">
                                        </th>
                                    <?php } ?>
                                    <th width="5px"></th>
                                    <th style="">Sampai Tanggal</th>
                                    <th width="5px"></th>
                                    <?php if ($filter_date_sampai==null) { ?>
                                        <th>
                                            <input type="date" value="<?php echo date('Y-m-d');?>"
                                                   id="sampai_tgl" name="sampai_tgl"
                                                   required="required">
                                        </th>
                                    <?php } else { ?>
                                        <th>
                                            <input type="date" value="<?php echo $filter_date_sampai; ?>"
                                                   id="sampai_tgl" name="sampai_tgl"
                                                   required="required">
                                        </th>
                                    <?php } ?>
                                    <th width="5px"></th>
                                </tr>
                            </table>
                            <table>
                                <thead>
                                <th style="height: 15px;"></th>
                                <tr>
                                    <th width="15px"></th>
                                    <th style="">-Pilih Ruangan-</th>
                                    <th width="5px"></th>
                                </tr>
                                </thead>
                            </table>
                            <table>
                                <thead>
                                <tr class="text-center">
                                    <th>
                                        <div class="form-group" style="align-items: center; text-align: center">
                                            <label hidden class="control-label col-lg-1"
                                                   style="text-align: center;" for="">
                                                Ruangan
                                            </label>
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="form-control default-select2" id="id_ruangan"
                                                    name="id_ruangan" required="required">
                                                <?php foreach ($semua_ruangan as $item){ ?>
                                                    <option value="<?php echo $item['id'];?>"
                                                        <?php if($id_ruangan_dipilih == $item["id"]){?>
                                                            selected
                                                    <?php } ?>>
                                                        <?php echo $item['nama'];?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </th>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                </thead>
                            </table>

                            <table>
                                <thead>
                                <tr>
                                    <button type="submit" class="btn btn-primary" name="filter" id="filter">
                                        Filter
                                    </button>
                                </tr>
                                </thead>
                            </table>
                        </form>
                    </div>

                </center>
            </div>
            <div class="panel-body">
                <hr>
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="1%" style="text-align: center">No.</th>
                            <th style="text-align: center">Ruangan</th>
                            <th style="text-align: center">OB</th>
                            <th style="text-align: center">Status OB</th>
                            <th style="text-align: center">Pengawas</th>
                            <th style="text-align: center">Status Pengawas</th>
                            <th style="text-align: center">Shift Waktu</th>
                            <th style="text-align: center">Tanggal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        <?php foreach ($laporan_list as $key=>$baris) { ?>
                            <tr>
                                <td style="text-align: center;"><b><?php echo $no++;?></b></td>
                                <td style="text-align: center;"><?php echo ucfirst($this->Mcrud->get_nama_ruangan($baris['id_ruangan']));?></td>
                                <td style="text-align: center;"><?php echo ucfirst($this->Mcrud->get_user_name_by_id($baris['id_ob'])); ?></td>
                                <td style="text-align: center;"><?php echo ucfirst($baris['status_ob']);?></td>
                                <td style="text-align: center;"><?php echo ucfirst($this->Mcrud->get_user_name_by_id($baris['id_pengawas']));?></td>
                                <td style="text-align: center;"><?php echo ucfirst($baris["status_pengawas"]);?></td>
                                <td style="text-align: center;"><?php echo $baris["waktu"];?></td>
                                <td style="text-align: center;"><?php echo tgl_indo($baris["tanggal"]);?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div style="text-align: center; font-weight: bold">
                        <a href="<?php echo $link1;?>/<?php echo $link2;?>/c.html"
                           class="" title="Download"
                           onclick="" target="_blank">
                            <i class="fa fa-print btn btn-danger" style="padding: 10px"> Download PDF </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
