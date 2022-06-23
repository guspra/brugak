<!DOCTYPE html>
<?php
$username   = $this->session->userdata('username');
$level   = $this->session->userdata('level');
$nama	= $this->session->userdata('nama');

$foto = "img/user/user-default.png";

$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?= $judul_web; ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="<?php echo $this->Mcrud->judul_web(); ?> " name="description" />
	<meta content="CV. Esotechno" name="author" />
	<meta name="keywords" content="CV. Esotechno, <?php echo $this->Mcrud->judul_web(); ?>">
	<base href="<?php echo base_url();?>"/>
	<link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/panel/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="assets/panel/css/animate.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/panel/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="assets/panel/css/style-gue.css" rel="stylesheet">
	<link href="assets/panel/css/custom.css" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="assets/panel/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="assets/panel/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="assets/panel/plugins/morris/morris.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/panel/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/panel/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js"></script>



</head>
<body>

<style type="text/css"></style>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed in"> <!--page-sidebar-minified-->
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<!-- <div class="navbar-header">
					
				</div> -->
				<!-- end mobile sidebar expand / collapse button -->

				<!-- begin header navigation right -->
<!--                judul header pada bagian paling atas-->
				<a href="" class="navbar-brand"><span class="navbar-logo"><center><b>BRUGAKKU</b></center></a>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle icon" aria-expanded="false">
							<i class="ion-ios-bell"></i>
<!--                            dirubahjo-->
							<span class="label" id="jml_notif_bell"><?= $jml_notif; ?></span>
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown" id="notif_bell"></ul>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<span class="user-image online">
								<img src="<?php echo $foto;?>" alt="" />
							</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
<!--                            baris href=profile.hmtl dan href=settings.html merujuk ke rute yg didefinisikan di routes.php-->
							<li <?php if($menu=='profile'){echo " class='active'";}?>><a href="profile.html">Profile</a></li>
							<li class="divider"></li>
                            <li <?php if($menu=='settings'){echo " class='active' ";}?>><a href="settings.html">Setting</a></li>
							<li class="divider"></li>
							<li><a href="web/logout.html">Logout</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->

		<!-- begin #sidebar -->
		
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image col-md-4">
							<a href="profile"><img src="<?php echo $foto;?>" alt="" /></a>
						</div>
						<div class="info col-md-8">
							<?php echo ucwords($nama); ?>
							<small><?php echo ucwords($level); ?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->

<!--                INI MENU SIDEBAR-->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header"><big>MENU NAVIGASI</big></li>
					<li class="has-sub<?php if($menu=='users' AND $sub_menu=='' or $menu=='dashboard'){echo " active";} ?>">
						<a href="dashboard.html">
						    <i class="fa fa-th-large"></i>
						    <span>Dashboards</span>
					   </a>
					</li>
					<?php if ($level == 'superadmin'):?>
<!--                    jika level = superadmin MAKA ditambahkan tampilan side-bar menu 'data pengguna' dibawah ini-->
						<li class="has-sub<?php if($menu=='datapengguna' AND $sub_menu=='' or $menu=='datapengguna'){echo " active";} ?>">
<!--							ini nembak ke controller Datapengguna.php lalu ke 'function v'-->
                            <a href="datapengguna/v.html">
								<i class="fa fa-users"></i> <span>Data Penggunasnya</span>
							</a>
						</li>
					<?php endif; ?>
					<li class="has-sub<?php if($menu=='laporan_harian'){echo " class='active'";} ?>">
<!--						<a href="datapengguna/v.html">-->
						<a href="checklist_kebersihan/v.html">
							<i class="fa fa-calendar-check-o"></i> <span>Checklist Kebersihan</span>
						</a>
					</li>

                    <!--ditambahkan jo kondisi-->
                    <?php if($this->session->userdata('level')=='superadmin'){?>
                        <!--menu list dikosongkan jika role bukan 'superadmin'-->
                        <li class="has-sub<?php if($menu=='reports' AND $sub_menu=='' or $menu=='reports'){echo " active";} ?>">
                            <!--                        baris dibawah mengarah ke controllers Datapengguna, dan function 'function v' -->
                            <!--						<a href="datapengguna/v.html">-->
                            <a href="reports/v.html">
                                <!--						<a href="datapengguna/cetak_laporan.html">-->
                                <i class="fa fa-file-text"></i> <span>Laporan Bulanans</span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if($this->session->userdata('level')=='MR.CLEAN'){?>
                        <!--menu list dikosongkan jika role bukan 'superadmin'-->
                        <li class="has-sub<?php if($menu=='reports' AND $sub_menu=='' or $menu=='reports'){echo " active";} ?>">
                            <!--                        baris dibawah mengarah ke controllers Datapengguna, dan function 'function v' -->
                            <!--						<a href="datapengguna/v.html">-->
                            <a href="reports/v.html">
                                <!--						<a href="datapengguna/cetak_laporan.html">-->
                                <i class="fa fa-file-text"></i> <span>Laporan Bulanans</span>
                            </a>
                        </li>
                    <?php } ?>

<!--                    <li class="has-sub--><?php //if($menu=='reports' AND $sub_menu=='' or $menu=='reports'){echo " active";} ?><!--">-->
<!--<!--                        baris dibawah mengarah ke controllers Datapengguna, dan function 'function v' -->-->
<!--<!--						<a href="datapengguna/v.html">-->-->
<!--						<a href="reports/v.html">-->
<!--<!--						<a href="datapengguna/cetak_laporan.html">-->-->
<!--							<i class="fa fa-file-text"></i> <span>Laporan Bulanans</span>-->
<!--						</a>-->
<!--					</li>-->
						
					<!-- <li class="has-sub <?php //if($menu=='laporan_harian' OR $menu=='laporan_bulanan'){echo " active";} ?>">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-check-square bg-gray"></i>
							<span>Laporan Kebersihan</span>
						</a>
						<ul class="sub-menu">
							<li <?php //if($menu=='laporan_harian'){echo " class='active'";} ?>>
								<a href="dipa/v.html">
									<i class="fa fa-file-text"></i> <span>Checklist Kebersihan</span>
								</a>
							</li>
							<li <?php //if($menu=='laporan_bulanan'){echo " class='active'";} ?>>
								<a href="rpd">
									<i class="fa fa-calendar-check-o"></i> <span>Laporan Bulanan</span>
								</a>
							</li>
						</ul>
					</li> -->
				<!-- </ul> -->

					<li class="nav-header"></li>
					<li>
						<a href="web/logout.html">
							<div class="icon-img">
						    <i class="fa fa-sign-out bg-red-darker"></i>
						    </div>
						    <span>Logouts</span>
						</a>
					</li>
					    <!-- begin sidebar minify button -->
					<!-- <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-left"></i> <span></span></a></li> -->
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->

		<div id="content" class="content dashboard">
		<!-- Header mobile -->
		<div class="header-mobile">
			<div class="card border-0 p-20 shadow overflow-hidden bg-gray-800 text-white">
				<div class="card-body">
					<div class="row text-center">
						<div class="col-md-4 col-sm-4 col-xs-4 main-menu">
							<a href="datapengguna/v.html" class="btn-main-menu">
								<div class="btn-icon icon-pengguna">
									<i class="fa fa-users"></i>
								</div>
								<div class="btn-text">
									<span>Data Pengguna</span>
								</div>
							</a>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4 main-menu">
							<a href="datapengguna/v.html" class="btn-main-menu">
								<div class="btn-icon icon-checklist">
									<i class="fa fa-check-square"></i>
								</div>
								<div class="btn-text">
									<span>Checklist Kebersihan</span>
								</div>
							</a>
						</div>

						<div class="col-md-4 col-sm-4 col-xs-4 main-menu">
							<a href="datapengguna/v.html" class="btn-main-menu">
								<div class="btn-icon icon-file">
									<i class="fa fa-file-text"></i>
								</div>
								<div class="btn-text">
									<span>Laporan Bulanan</span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Header mobile -->
