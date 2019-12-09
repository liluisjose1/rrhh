<!DOCTYPE html>
<html lang="es" class="wf-lato-n4-active wf-lato-n7-active wf-flaticon-n4-inactive wf-simplelineicons-n4-active wf-fontawesome5solid-n4-active wf-fontawesome5regular-n4-active wf-fontawesome5brands-n4-active wf-lato-n3-active wf-lato-n9-active wf-active">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Control de Asistencia | RRHH</title>
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

<body class="login" onload="mueveReloj()">
	<div class="wrapper wrapper-login wrapper-login-full p-0">
		<div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-success-gradient">
			<center>
				<h2 class="text-white" id="fecha"></h2>
				<h1 style="font-size:60px;" class="text-white" id="reloj">Reloj</h1>
			</center>
			<div class="text-center">
				<img src="./assets/assets/img/bg-logo.png">
			</div>
			<p class="subtitle text-white op-7">CONTROL DE ASISTENCIA</p>
			<h1 class="title fw-bold text-white mb-3">ACOGUADALUPANA DE R.L.</h1>
		</div>
		<div style="zoom:160%" class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
			<div class="container container-login container-transparent animated fadeIn" style="display: block;">
				<h3 class="text-center">Registra tu asistencia</h3>
				<form action="#" id="form-registro" method="post">
					<div class="login-form">
						<div class="form-group">
							<label for="username" class="placeholder"><b>Hora</b></label>
							<input type="time" id="hora" value="<?php echo ($_GET["hora"]); ?>" name="hora" class="form-control" required="">
						</div>
						<div class="form-group">
							<label for="username" class="placeholder"><b>Código</b></label>
							<div class="position-relative">
								<input id="username" name="user_txt" type="password" class="form-control" required="">
								<div class="show-password">
									<i class="icon-eye"></i>
								</div>
							</div>
						</div>
						<div class="form-group form-action-d-flex mb-3">
							<button type="submit" id="registro" class="btn btn-success col-md-12 float-right mt-3 mt-sm-0 fw-bold">Registrar</button>
						</div>
					</div>
			</div>
		</div>

	</div>
	<script src="./assets/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="./assets/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="./assets/assets/js/core/popper.min.js"></script>
	<script src="./assets/assets/js/core/bootstrap.min.js"></script>
	<script src="./assets/assets/js/atlantis.min.js"></script>
	<!-- Sweet Alert -->
	<script src="assets/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<script>
		$(document).ready(function() {
			var f = new Date();
			document.getElementById("fecha").innerHTML=(f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear());

			$('#form-registro').submit(function(e) {
				user_txt = document.getElementById("username").value;
				hora = document.getElementById("hora").value;

				$.ajax({
					url: "./logica/ajax_personal_name.php",
					type: "POST",
					data: {
						user_txt: user_txt,
					},
					dataType: "json",
					success: function(data) {
						if (data["status"] == 1) {
							swal({
									title: hora,
									text: data["name"],
									icon: "warning",
									buttons: {
										confirm: {
											text: "Registrar",
											value: true,
											visible: true,
											className: "btn-success",
											closeModal: true
										},
										cancel: {
											text: "Cancelar",
											value: false,
											visible: true,
											className: "btn-danger",
											closeModal: true,
										}
									},
									dangerMode: true,
								})
								.then((isConfirm) => {
									if (isConfirm) {
										$.ajax({
											url: "./logica/emp_registro_horas.php",
											type: "POST",
											data: {
												user_txt: user_txt,
												hora: hora
											},
											dataType: "json",
											success: function(data) {
												if (data["status"] == 1) {
													swal({
														title: "Entrada exitosa de",
														text: data["name"],
														icon: "success",
														timer: 1500
													});
												} else if (data["status"] == 2) {
													swal({
														title: "Salida exitosa de",
														text: data["name"],
														icon: "success",
														timer: 1500
													});
												} else if (data["status"] == 3) {
													swal({
														title: "Ya se registró toda la jornada de",
														text: data["name"],
														icon: "warning",
														timer: 1500
													});
												} else {
													swal({
														icon: "error",
														title: "Empleado no existe",
														timer: 1500
													});
												}

												document.getElementById("username").value = "";
												$('#username').focus();
											},
											error: function(xhr, ajaxOptions, thrownError) {
												swal("Error al borrar!", "Intente de nuevo", "error");
											}
										});
									} else {}
								});
						} else {
							swal("Error!", "No existe el código", "error");

						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal("Error!", "No existe usuario", "error");
					}
				});
				e.preventDefault();
			});
		});
	</script>
	<script language="JavaScript">
		function mueveReloj() {
			momentoActual = new Date()
			hora = momentoActual.getHours()
			minuto = momentoActual.getMinutes()
			segundo = momentoActual.getSeconds()

			str_segundo = new String(segundo)
			if (str_segundo.length == 1)
				segundo = "0" + segundo

			str_minuto = new String(minuto)
			if (str_minuto.length == 1)
				minuto = "0" + minuto

			str_hora = new String(hora)
			if (str_hora.length == 1)
				hora = "0" + hora

			horaImprimible = hora + " : " + minuto + " : " + segundo

			document.getElementById("reloj").innerHTML = horaImprimible

			setTimeout("mueveReloj()", 1000)
		}
	</script>
</body>

</html>