<?php include_once("./template/header.php"); ?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Empleado</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="#">
							<i class="flaticon-home"></i>
						</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Forms</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Basic Form</a>
					</li>
				</ul>
			</div>
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
							<div class="d-flex align-items-center">
								<h4 class="card-title">LISTADO DE EMPLEADOS REGISTRADOS</h4>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>CODIGO</th>
											<th>DUI</th>
											<th>NOMBRES</th>
											<th>APELLIDOS</th>
											<th>AREA</th>
											<th>SURCURSAL</th>
											<th width="80">Estado</th>
											<th width="100">Acciones</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>CODIGO</th>
											<th>DUI</th>
											<th>NOMBRES</th>
											<th>APELLIDOS</th>
											<th>AREA</th>
											<th>SURCURSAL</th>
											<th width="80">Estado</th>
											<th width="100">Acciones</th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										$sql = "SELECT p.id,p.codigo,p.dui, p.nit, p.nombres, p.apellidos, p.genero,p.estado, a.nombre as id_area, s.nombre as id_sucursal from personal as p INNER JOIN sucursales as s on p.id_sucursal = s.id INNER JOIN areas as a on p.id_area = a.id_area ORDER BY p.id DESC";
										$ejecutar = $conexion->query($sql);
										$cont = 0;
										while ($reg = $ejecutar->fetch_assoc()) {
											$cont = $cont + 1;
											echo "<tr>";
											echo "<th scope='row'>" . ($reg["codigo"]) . "</th>";
											echo "<td>" . ($reg["dui"]) . "</td>";
											echo "<td>" . ($reg["nombres"]) . "</td>";
											echo "<td>" . ($reg["apellidos"]) . "</td>";
											echo "<td>" . ($reg["id_area"]) . "</td>";
											echo "<td>" . ($reg["id_sucursal"]) . "</td>";
											if ($reg["estado"] == 1) {
												# code...
												echo "<td><span class='badge badge-success'>Activo</span></td>";
											} else {
												# code...
												echo "<td><span class='label label-inverse'>Inactivo</span></td>";
											}
											?>
											<td><a name="edit"  <?php echo ('href="./emp_edit.php?id='.($reg["id"]).'"'); ?> class="btn btn-warning btn-sm edit_data"><i class='la flaticon-pencil'></i></a>
												<a name="edit" value="Delete" id="<?php echo ($reg["id"]); ?>" class="btn btn-danger btn-sm delete_data"><i class='la flaticon-cross' style="color:white;;" ></i></a></td>
											</tr>
										<?php  }
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once("./template/footer.php"); ?>
	<!-- Datatables -->
	<script src="./assets/assets/js/plugin/datatables/datatables.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#add-row').DataTable({
				"pageLength": 100,
				"order": [[ 0, "desc" ]]
			});

			$('.delete_data').click(function(e) {
				var id_emp = $(this).attr("id");
				swal({
					title: 'Borrar?',
					icon: "warning",
					text: "Seguro que deseas borrar! ",
					type: 'warning',
					buttons: {
						confirm: {
							text: 'Si, borrar',
							className: 'btn btn-success'
						},
						cancel: {
							visible: true,
							text: 'No, cancelar',
							className: 'btn btn-danger'
						}
					}
				}).then((Delete) => {
					if (Delete) {
						$.ajax({
							url: "./logica/emp_delete.php",
							type: "POST",
							data: {
								id_emp: id_emp
							},
							dataType: "html",
							success: function() {
								swal("Listo!", "Borrado con exito!", "success");
								location.reload();
							},
							error: function(xhr, ajaxOptions, thrownError) {
								swal("Error al borrar!", "Intente de nuevo", "error");
							}
						});
					} else {
						swal.close();
					}
				});
			});
		});
	</script>