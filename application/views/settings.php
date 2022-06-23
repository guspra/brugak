<?php
$username = $this->session->userdata('username');
$level = $this->session->userdata('level');
$nama = $this->session->userdata('nama');
$id_dipa = $this->session->userdata('id_dipa');

$foto_settings = "img/user/settings.png";
if ($level == 'obh') {
    $foto_k = $d_k->foto_obh;
    if ($foto_k != '') {
        if (file_exists("$foto_k")) {
            $foto_profile = $foto_k;
        }
    }
}
?>
<!-- Main content -->
<!-- <div class="content-wrapper"> -->

<!-- Content area -->
<!-- <div class="content"> -->

<!-- Dashboard content -->
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-flat">
            <div class="panel-body">
                <center>
                    <img src="<?php echo $foto_settings; ?>" alt="<?php echo $nama; ?>" class="img-circle" width="176">
                </center>
            </div>
        </div>

        <div class="panel panel-flat">
            <div class="panel-body">
                <fieldset class="content-group">
                    <legend class="text-bold"><i class="icon-user"></i>
                        SETTINGS PAGE
                    </legend>
                </fieldset>
            </div>
        </div>

    </div>


</div>
<!-- /dashboard content -->


<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/panel/plugin/datetimepicker/jquery.datetimepicker.css"/>
<script src="assets/panel/plugin/datetimepicker/jquery.datetimepicker.js"></script>
<script>
    $('#tgl_1').datetimepicker({
        lang: 'en',
        timepicker: false,
        format: 'd-m-Y'
    });
</script>
