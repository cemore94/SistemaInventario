<?php

$idproveedor = isset($_GET['idproveedor']) ? $_GET['idproveedor'] : die('Error: No se encontró id de proveedor.');

include '../../config/database.php';
include '../../objects/proveedor.php';

$database               = new Database();
$db                     = $database->getConnection();
$proveedor              = new Proveedor($db);
$proveedor->idproveedor = htmlspecialchars($idproveedor, ENT_QUOTES);

$proveedor->readOne();

?>

<form id="update-proveedor-form" action="#" method="POST">
	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-striped table-hover">
			<tr>
				<td>Proveedor</td>
				<td><input class="form-control" type="text" name="nombres" value="<?php echo htmlspecialchars($proveedor->nombres, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>Tipo de Documento</td>
				<td>
					<select name="tipo_documento" class="form-control">
						<?php if($proveedor->tipo_documento == 'DNI') { ?>
							<option selected value="DNI">DNI</option>
							<option value="RUC">RUC</option>
						<?php } ?>
						<?php if($proveedor->tipo_documento == 'RUC') { ?>
							<option value="DNI">DNI</option>
							<option  selected value="RUC">RUC</option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Número de Documento</td>
				<td><input class="form-control" type="text" name="num_documento" value="<?php echo htmlspecialchars($proveedor->num_documento, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>Dirección</td>
				<td><input class="form-control" type="text" name="direccion" value="<?php echo htmlspecialchars($proveedor->direccion, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>Telefono</td>
				<td><input class="form-control" type="text" name="telefono" value="<?php echo htmlspecialchars($proveedor->telefono, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>E-Mail</td>
				<td><input class="form-control" type="text" name="email" value="<?php echo htmlspecialchars($proveedor->email, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td><input type="hidden" name="idproveedor" value="<?php echo $proveedor->idproveedor; ?>"></td>
				<td>
					<button type="submit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh"></span> Modificar
					</button>
					<button type="reset" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove-circle"></span>
					Cancelar
					</button>
				</td>
			</tr>
		</table>
	</div>
</form>