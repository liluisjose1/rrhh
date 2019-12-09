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
						echo "<i class='fas fa-door-closed'></i> El registro se ralizó con exito";
						echo "</div>";
					} else if ($_GET["error"] == "si") {
						echo "<div class='alert alert-danger alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
						echo "<i class='fas fa-user-times'></i> Error al registrar";
						echo "</div>";
					} else if ($_GET["error"] == "all_j") {
						echo "<div class='alert alert-danger alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
						echo "<i class='fas fa-file-excel'></i> Ya se registraron todas las jornadas";
						echo "</div>";
					}


					?>
					<div class="card">
						<div class="card-header">
							<div class="card-title"><b>Registro de Jornada Laboral</b></div>
						</div>
						<form action="./logica/emp_registro_horas_admin.php" method="post">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 col-lg-12">
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="fecha">Entrada</label>
															<input type="time" id="hora_e" name="entrada_t1" class="form-control" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="fecha">Salida</label>
															<input type="time" id="hora_s" name="salida_t1" class="form-control" required placeholder="Ingrese Fecha">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="fecha">Fecha</label>
													<input type="date" name="fecha" class="form-control" required id="fecha" placeholder="Ingrese Fecha">
												</div>
											</div>
										</div>
										<hr style="background-color: #8d9498 !important; height: 5px; border-radius: 25px;">
										<div class="row">
											<div class="col-md-12">
												<div class="table-responsive">
													<table class="table table-hover">
														<thead>
															<tr role="row">
																<th scope="col">Código</th>
																<th scope="col">Area</th>
																<th scope="col">Nombre</th>
																<th>
																	<div class="custom-control custom-checkbox">
																		<input type="checkbox" class="custom-control-input" id="customCheck1">
																		<label class="custom-control-label" for="customCheck1">Seleccionar</label>
																	</div>
																</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$sql = "SELECT a.nombre as area ,p.codigo, CONCAT(p.nombres,' ',p.apellidos) as nombre FROM personal as p, areas as a WHERE p.id_area=a.id_area ORDER BY p.id_area															";
															$ejecutar = $conexion->query($sql);
															while ($reg = $ejecutar->fetch_assoc()) { ?>
																<tr role="row">
																	<td><?php echo ($reg["codigo"]); ?></td>
																	<td><?php echo ($reg["area"]); ?></td>
																	<td><?php echo ($reg["nombre"]); ?></td>
																	<td>
																		<input type="checkbox" class="checkb" value="<?php echo ($reg["codigo"]); ?>" name="codigo[]" />
																	</td>
																</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-action">
								<button type="submit" class="btn btn-success">Guardar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once("./template/footer.php"); ?>
	<script src="./assets/assets/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#customCheck1').click(function() {
				$('.checkb').each(function() {
					$(this).click();
				})
			});
		});
	</script>