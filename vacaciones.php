<?php include_once("./template/header.php"); ?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="row">

				<div class="col-md-12">
					<?php
					error_reporting(E_ALL ^ E_NOTICE);
					if ($_GET["error"] == "no") {
						echo "<div class='alert alert-primary alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
						echo "Registro Exitoso";
						echo "</div>";
					} else if ($_GET["error"] == "si") {
						echo "<div class='alert alert-danger alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
						echo "Error al registrar";
						echo "</div>";
					} else if ($_GET["error"] == "no_d") {
						echo "<div class='alert alert-danger alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
						echo "Registro eliminado con exito";
						echo "</div>";
					} else if ($_GET["error"] == "no_up") {
						echo "<div class='alert alert-primary alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
						echo "Actualizado con exito";
						echo "</div>";
					}


					?>
					<div class="card">
						<div class="card-header">
							<h1>Registrar Vacaciones Anuales</h1>
						</div>
						<div class="card-body">
							<form action="./logica/registro_todas_vacaciones.php" method="post">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="dui">Año</label>
													<input type="text" name="anio" class="form-control" required id="email2" placeholder="Ingrese Año">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label for="dui"></label>
													<button type="submit" class="btn btn-success form-control">Generar</button>
												</div>
											</div>
										</div>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once("./template/footer.php"); ?>
	<script src="./assets/assets/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#exampleFormControlSelect1').select2({
				theme: 'bootstrap4',
				width: 'style',
			});
		});
	</script>