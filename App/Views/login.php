
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
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
	<link rel="stylesheet" type="text/css" href="<?php echo assets('theme/deskapp/css/style.css'); ?>">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="<?php echo assets('theme/deskapp/images/logo-dark.png'); ?>" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
<!--					<li><a href="register.html">Register</a></li>-->
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="<?php echo assets('theme/deskapp/images/login-page-img.png'); ?>" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login</h2>


						</div>
						
						<form action="<?php echo url('login/submit'); ?>" method="post" id="login-form">
							
							<div id="login-results"></div>

							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" name="user" placeholder="Usuário">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" name="password" placeholder="**********">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Relembre-me</label>
									</div>
								</div>
								<div class="col-6">
<!--									<div class="forgot-password"><a href="forgot-password.html">Forgot Password</a></div>-->
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>
									
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="<?php echo assets('theme/deskapp/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/core.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/script.min.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/process.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/layout-settings.js'); ?>"></script>
</body>
</html>

<script>
	$(function() {
		var flag = false;
		var loginResults = $('#login-results');
		
		$('#login-form').on('submit', function(event) {
			event.preventDefault();
			
			if (flag === true) {
				return false;
			}
			
			form = $(this);
			requestUrl = form.attr('action');
			requestMethod = form.attr('method');
			requestData = form.serialize();
			
			$.ajax({
				url: requestUrl,
				type: requestMethod,
				data: requestData,
				dataType: 'json',
				beforeSend: function() {
					flag = true;
					$('button').attr('disabled', true);
					loginResults.removeClass().addClass('alert alert-info').html('Aguarde processando...');
				},
				success: function(results) {
					
					if (results.errors) {
						flag = false;
						loginResults.removeClass().addClass('alert alert-danger').html(results.errors);
						$('button').removeAttr('disabled');
					} else if (results.success) {
						loginResults.removeClass().addClass('alert alert-success').html(results.success);
						setTimeout(function(){
							if (results.redirect) {
								window.location.href = results.redirect; 
							}
						}, 2000);
					}
				}
			});
		});
	});
</script>













