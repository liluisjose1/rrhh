<?php include_once("./template/header.php"); ?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="row">
				<div class="col-md-12">

					<div class="card">
						<div class="card-header">
							<div class="card-title"><b>Registro empleado</b></div>
						</div>
						<form action="./logica/emp_save.php" method="post">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 col-lg-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="dui">DUI</label>
													<input type="text" name="dui" class="form-control" id="email2" placeholder="Ingrese numero de DUI">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="nit">NIT</label>
													<input type="text" name="nit" class="form-control" id="email2" placeholder="Ingrese numero de NIT">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="nombres">Nombres</label>
													<input type="text" name="nombres" class="form-control" required id="email2" placeholder="Ingrese nombre">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="dui">Apellidos</label>
													<input type="text" name="apellidos" class="form-control" required id="email2" placeholder="Ingrese Apellidos">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="exampleFormControlSelect1">Sexo</label>
													<select class="form-control" name="genero" id="exampleFormControlSelect1">
														<option value=""></option>
														<option value="1">Masculino</option>
														<option value="2">Femenino</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="f_nacimiento">Fecha de Nacimiento</label>
													<input type="date" name="fecha_nacimiento" class="form-control" id="email2" placeholder="Nacimiento">
												</div>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<label for="direecion">Dirección</label>
													<input type="text" name="direccion" class="form-control" id="email2" placeholder="Ingrese Dirección">
												</div>
											</div>
										</div>
										<hr width="75%">
										<h2><b>Sucursal</b></h2>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="fecha_ingreso">Fecha de Ingreso</label>
													<input type="date" name="fecha_ingreso" class="form-control" id="email2" placeholder="Ingreso">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="exampleFormControlSelect1">Sucursal</label>
													<select class="form-control" name="id_sucursal" id="exampleFormControlSelect1">
														<option value=""></option>
														<?php
														$sql = "SELECT * FROM sucursales";
														$ejecutar = $conexion->query($sql);
														$cont = 0;
														while ($reg = $ejecutar->fetch_assoc()) {
															echo "<option value=" . $reg["id"] . ">" . $reg["nombre"] . "</option>";
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="exampleFormControlSelect1">Area</label>
													<select class="form-control" name="id_area" id="exampleFormControlSelect1">
														<option value=""></option>
														<?php
														$sql = "SELECT * FROM areas";
														$ejecutar = $conexion->query($sql);
														$cont = 0;
														while ($reg = $ejecutar->fetch_assoc()) {
															echo "<option value=" . $reg["id_area"] . ">" . $reg["nombre"] . "</option>";
														}
														?>
													</select>
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