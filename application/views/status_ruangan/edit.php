<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>
<!-- Main content -->
<!-- <div class="content-wrapper"> -->
  <!-- Content area -->
  <!-- <div class="content"> -->

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Pengguna</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama" class="form-control" value="<?php echo $pengguna['nama']; ?>" placeholder="Nama" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Whatsapp</label>
                    <div class="col-lg-9">
                      <input type="text" name="whatsapp" class="form-control" value="<?php echo $pengguna['whatsapp']; ?>" placeholder="Whatsapp" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Role</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="role" required>
                        <option value="">- Pilih -</option>
                        <option value="kadivmin" <?php if($pengguna['role'] == 'kadivmin'){ echo "selected";} ?>>Kepala Divisi Administrasi</option>
                        <option value="pengawas" <?php if($pengguna['role'] == 'pengawas'){ echo "selected";} ?>>Pengawas</option>
                        <option value="penanggungjawab" <?php if($pengguna['role'] == 'penanggungjawab'){ echo "selected";} ?>>Penanggung Jawab</option>
                        <option value="MR.CLEAN" <?php if($pengguna['role'] == 'MR.CLEAN'){ echo "selected";} ?>>Mr. Clean</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                      <input type="text" name="username" class="form-control" value="<?php echo $pengguna['username']; ?>" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password" class="form-control" value="<?php echo $pengguna['password']; ?>" placeholder="Password" required>
					  <i style="color: red;">*Password tidak boleh kosong.</i>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Re-Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password2" class="form-control" value="<?php echo $pengguna['password']; ?>" placeholder="Konfirmasi Password" required>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo $link1; ?>/<?php echo $link2; ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

