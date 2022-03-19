<?php
$level  = $this->session->userdata('level');
?>
<!-- begin #content -->
<!-- <div id="content" class="content dashboard"> -->
	<!-- begin breadcrumb -->
	<!-- <ol class="breadcrumb pull-right">
	  <li class="active">Dashboard</li>
	</ol> -->
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<!-- Dashboard Superadmin dan Koordinator Wilayah -->
	

	<div class="card border-0 p-20 shadow overflow-hidden">
		<div class="card-body">
			<h1 class="page-header">Kebersihan Ruangan</h1>
			<h5><?php echo $this->Mcrud->hari_id(date('d-m-Y')); ?>, <?php echo $this->Mcrud->tgl_id(date('d-m-Y'),'full'); ?></h5>
			<hr class="mt-15 mb-15">
			<div class="c-content-accordion-1 c-theme dashboard-all">
				<div class="panel-group" id="accordion" role="tablist">
					<?php
						foreach ($waktu as $key):
					?>
					<div class="panel panel-info">
						<div class="panel-heading" role="tab" id="heading<?php echo $key; ?>">
							<h4 class="panel-title">
								<a class="c-font-bold c-font-19"  data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key; ?>"><?php echo strtoupper($key); ?></a>
							</h4>
						</div>
						<div id="collapse<?php echo $key; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $key; ?>">
							<div class="panel-body c-font-18">
								<div class="row">
									<?php foreach ($status[$key] as $subkey => $subval):?>
										<div class="col-md-2 col-xs-4 text-center">
											<a href="<?php
												if ($subval['status_ob'] == 'BELUM' && $subval['status_pengawas'] == 'BELUM') {
													echo "status_ruangan/v/t/" . hashids_encrypt($subval['id_ruangan']);
												} elseif ($subval['status_ob'] == 'SUDAH' && $subval['status_pengawas'] == 'SUDAH') {
													echo "status_ruangan/v/d/" . hashids_encrypt($subval['id_status_ruangan']);
												} elseif ($subval['status_ob'] == 'SUDAH' && $subval['status_pengawas'] == 'BELUM') {
													if ($level == 'PENGAWAS') {
														echo "status_ruangan/v/e/" . hashids_encrypt($subval['id_status_ruangan']);
													} else {
														echo "status_ruangan/v/d/" . hashids_encrypt($subval['id_status_ruangan']);
													}
												}
												?>">
												<div class="room-icon 
													<?php if ($subval['status_ob'] == 'BELUM' && $subval['status_pengawas'] == 'BELUM') {
														echo 'icon-red';
													} elseif ($subval['status_ob'] == 'SUDAH' && $subval['status_pengawas'] == 'BELUM') {
														echo 'icon-yellow';
													} elseif ($subval['status_ob'] == 'SUDAH' && $subval['status_pengawas'] == 'SUDAH') {
														echo 'icon-green';
													}?>
												"></div>
												<div class="room-text"><?php echo $subval['nama_ruangan']; ?></div>
											</a>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
						<?php endforeach; ?>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-md-2 col-xs-4 text-center">
					<a href="">
						<div class="room-icon"></div>
						<div class="room-text">Ruang Kakanwil</div>
					</a>
				</div>
				<div class="col-md-2 col-xs-4 text-center">
					<a href="">
						<div class="room-icon"></div>
						<div class="room-text">Ruang Kakanwil</div>
					</a>
				</div>
				<div class="col-md-2 col-xs-4 text-center">
					<a href="">
						<div class="room-icon"></div>
						<div class="room-text">Ruang Kakanwil</div>
					</a>
				</div>
				<div class="col-md-2 col-xs-4 text-center">
					<a href="">
						<div class="room-icon"></div>
						<div class="room-text">Ruang Kakanwil</div>
					</a>
				</div>

			</div> -->
			
		</div>
	</div>


</div>
<!-- end #content -->

