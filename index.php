<!DOCTYPE html>
<html lang="es" class="wf-lato-n4-active wf-lato-n7-active wf-flaticon-n4-inactive wf-simplelineicons-n4-active wf-fontawesome5solid-n4-active wf-fontawesome5regular-n4-active wf-fontawesome5brands-n4-active wf-lato-n3-active wf-lato-n9-active wf-active">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inicio Sesión | RRHH</title>
	<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
	<link rel="icon" href="assets/assets/img/icon2.png" type="image/x-icon">

	<!-- Fonts and icons -->
	<script src="./assets/assets/js/plugin/webfont/webfont.min.js"></script>
	<link rel="stylesheet" href="./assets/assets/css/fonts.min.css" media="all">
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ['./assets/assets/css/fonts.min.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="./assets/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/assets/css/atlantis.css">
</head>

<body class="login">
	<div class="wrapper wrapper-login wrapper-login-full p-0">
		<div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-success-gradient">
			<div class="text-center">
				<img src="./assets/assets/img/bg-logo.png">
			</div>
			<h1 class="title fw-bold text-white mb-3">ACOGUADALUPANA DE R.L.</h1>
			<p class="subtitle text-white op-7">Sistema de Administración de Recursos Humanos</p>
		</div>
			<div style="zoom:160%" class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
				<div class="container container-login container-transparent animated fadeIn" style="display: block;">
					<h3 class="text-center">Inicio de Sesión</h3>
					<form action="./logica/control.php" method="post">
					<div class="login-form">
						<div class="form-group">
							<label for="username" class="placeholder"><b>Usuario</b></label>
							<input id="username" name="user_txt" type="text" class="form-control" required="">
						</div>
						<div class="form-group">
							<label for="password" class="placeholder"><b>Contraseña</b></label>
							<div class="position-relative">
								<input id="password" name="password" type="password" class="form-control" required="">
								<div class="show-password">
									<i class="icon-eye"></i>
								</div>
							</div>
						</div>
						<div class="form-group form-action-d-flex mb-3">
							<button type="submit" class="btn btn-success col-md-12 float-right mt-3 mt-sm-0 fw-bold">Iniciar</button>
						</div>
					</div>
					</form>
				</div>
			</div>
			
	</div>
	<script src="./assets/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="./assets/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="./assets/assets/js/core/popper.min.js"></script>
	<script src="./assets/assets/js/core/bootstrap.min.js"></script>
	<script src="./assets/assets/js/atlantis.min.js"></script>

</body>

</html>