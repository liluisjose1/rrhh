<?php include_once("./template/header.php"); ?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">REPORTES DE INCAPACIDAD</h4>
							</div>
						</div>
						<div class="card-body">
							<form action="./reports/rango_fecha_empleado_incapacidad.php" method="post" target="_blank">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="dui">Fecha desde</label>
											<input type="date" name="f_desde" class="form-control" required id="email2" placeholder="Ingrese numero de DUI">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="dui">Fecha hasta</label>
											<input type="date" name="f_hasta" class="form-control" required id="email2" placeholder="Ingrese numero de DUI">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="dui"></label>
											<br>
											<button type="submit" class="btn btn-success form-control">Generar</button>
										</div>
									</div>
								</div>
							</form>
							<form action="./reports/rango_fecha_empleado_inc.php" method="post" target="_blank">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="exampleFormControlSelect1">Empleado</label>
											<select class="form-control" required name="id_personal" id="exampleFormControlSelect1">
												<option value="">Selecione un empleado</option>
												<?php
												$sql = "SELECT codigo, CONCAT(nombres,' ',apellidos) as nombre FROM personal ORDER BY id_area";
												$ejecutar = $conexion->query($sql);
												$cont = 0;
												while ($reg = $ejecutar->fetch_assoc()) {
													echo "<option value=" . $reg["codigo"] . ">" . $reg["codigo"] . " - " . $reg["nombre"] . "</option>";
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group ">
											<label for="dui">Fecha desde</label>
											<input type="date" name="f_desde" class="form-control" required id="email2" placeholder="Ingrese numero de DUI">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="dui">Fecha hasta</label>
											<input type="date" name="f_hasta" class="form-control" required id="email2" placeholder="Ingrese numero de DUI">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="dui"></label>
											<button type="submit" class="btn btn-success form-control">Generar</button>
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