<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<meta name="description" content="">
	<title><?php echo $title; ?></title>
	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo assets('theme/deskapp/images/apple-touch-icon.png'); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo assets('theme/deskapp/images/favicon-32x32.png'); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo assets('theme/deskapp/images/favicon-16x16.png'); ?>">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo assets('theme/deskapp/css/core.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo assets('theme/deskapp/css/icon-font.min.css'); ?>">
	<!-- Datatables-->
	<link rel="stylesheet" type="text/css" href="<?php echo assets('theme/deskapp/css/datatables/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo assets('theme/deskapp/css/datatables/responsive.bootstrap4.min.css'); ?>">
	<!-- sweetalert2 -->
   	<link rel="stylesheet" type="text/css" href="<?php echo assets('theme/deskapp/css/sweetalert2/sweetalert2.css'); ?>">
	<!-- toastr-->
	<link rel="stylesheet" type="text/css" href="<?php echo assets('theme/deskapp/css/toastr/toastr.min.css'); ?>">
	<!-- style-->
	<link rel="stylesheet" type="text/css" href="<?php echo assets('theme/deskapp/css/style.css'); ?>">
	<!-- personalizado-->
	<link rel="stylesheet" type="text/css" href="<?php echo assets('theme/deskapp/css/custom.css'); ?>">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');

	</script>
</head>

<body>
<!--
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="<?php echo assets('theme/deskapp/images/deskapp-logo.svg'); ?>" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>
-->
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="dist/images/img.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="dist/images/photo1.jpg" alt="">
										<h3>Lea R. Frith</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="dist/images/photo2.jpg" alt="">
										<h3>Erik L. Richards</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="dist/images/photo3.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="dist/images/photo4.jpg" alt="">
										<h3>Renee I. Hansen</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="dist/images/img.jpg" alt="">
										<h3>Vicki M. Coleman</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">

						<?php 
							$image = ($user->foto != '') ? assets('images/' . $user->foto) : assets('avatar/avatar.jpg'); 
							$fullName = $user->nome;
							$firstName = explode(" ", $fullName);
						?>

							<img src="<?php echo $image; ?>" alt="" style="width:50px; height: 50px; border-radius: 50%;">
						</span>
						<span class="user-name"><?php echo $firstName[0]; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="#"><i class="dw dw-user1"></i> Perfil</a>
						<a class="dropdown-item" href="#"><i class="dw dw-settings2"></i> Configurações</a>
						<a class="dropdown-item" href="#"><i class="dw dw-help"></i> Ajuda</a>
						<a class="dropdown-item" href="<?php echo url('/logout'); ?>"><i class="dw dw-logout"></i>Sair</a>
					</div>
				</div>
			</div>
		</div>
	</div>
