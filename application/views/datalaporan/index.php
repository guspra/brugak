<script type="text/javascript">
    $(document).ready(function(){

        $('.date-picker').datepicker().next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        $("#simpan_krs").click(function(){
            var tgl_krs = $("#isi_krs").val();

            if(!$("#isi_krs").val()){
                $.gritter.add({
                    title: 'Peringatan..!!',
                    text: 'Tanggal KRS tidak boleh kosong',
                    class_name: 'gritter-error'
                });
                $("#isi_krs").focus();
                return false;
                // return false();
            }

            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/home/update_krs",
                data	: "tgl_krs="+tgl_krs,
                cache	: false,
                success	: function(data){
                    $.gritter.add({
                        title: 'Peringatan..!!',
                        text: data,
                        class_name: 'gritter-error'
                    });
                }
            });
        });

        $("#simpan_wisuda").click(function(){
            var tgl_wisuda = $("#isi_wisuda").val();

            if(!$("#isi_wisuda").val()){
                $.gritter.add({
                    title: 'Peringatan..!!',
                    text: 'Tanggal KRS tidak boleh kosong',
                    class_name: 'gritter-error'
                });
                $("#isi_wisuda").focus();
                // return false();
                return false;
            }

            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/home/update_wisuda",
                data	: "tgl_wisuda="+tgl_wisuda,
                cache	: false,
                success	: function(data){
                    $.gritter.add({
                        title: 'Peringatan..!!',
                        text: data,
                        class_name: 'gritter-error'
                    });
                }
            });
        });
    });
</script>
<div class="widget-box ">
    <div class="widget-header">
        <h4 class="lighter smaller">
            <i class="icon-exclamation-sign"></i>
            Pilih
            <small style="background-color: antiquewhite ; font-weight: bold">
                Range Tanggal
            </small>
        </h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">
                <form class="form-horizontal" name="my-form" id="my-form">

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Tanggal Awal</label>
                        <div style="height: 2px"></div>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" name="isi_krs" id="isi_krs" value="<?php echo $tgl_awal;?>" class="span6 date-picker"  data-date-format="dd-mm-yyyy"/>
                                <span class="add-on">
                                <i class="icon-calendar"></i>
                            </span>
                            </div>
<!--                            <button type="button" name="simpan_krs" id="simpan_krs" class="btn btn-mini btn-info">-->
<!--                                <i class="icon-save"></i> Simpan-->
<!--                            </button>-->
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Tanggal Akhir</label>
                        <div style="height: 2px;"></div>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" name="isi_wisuda" id="isi_wisuda" value="<?php echo $tgl_akhir;?>" class="span6 date-picker"  data-date-format="dd-mm-yyyy"/>
                                <span class="add-on">
                                <i class="icon-calendar"></i>
                            </span>
                            </div>
                            <div style="height: 10px">

                            </div>
                            <button style="font-weight: bold" type="button" name="simpan_wisuda" id="simpan_wisuda" class="btn btn-mini btn-info">
                                <i class="icon-save"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- wg body -->
    </div> <!--wg-main-->
</div>   