<?php

$idcliente = isset($_GET['idcliente']) ? $_GET['idcliente'] : die('Error: No se encontró id de cliente.');

include '../../config/database.php';
include '../../objects/cliente.php';

$database               = new Database();
$db                     = $database->getConnection();
$cliente              = new Cliente($db);
$cliente->idcliente = htmlspecialchars($idcliente, ENT_QUOTES);

$cliente->readOne();

?>

<form id="update-cliente-form" action="#" method="POST">
	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-striped table-hover">
			<tr>
				<td>Cliente</td>
				<td><input class="form-control" type="text" name="nombres" value="<?php echo htmlspecialchars($cliente->nombres, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>Tipo de Documento</td>
				<td>
					<select name="tipo_documento" class="form-control">
						<?php if($cliente->tipo_documento == 'DNI') { ?>
							<option selected value="DNI">DNI</option>
							<option value="RUC">RUC</option>
						<?php } ?>
						<?php if($cliente->tipo_documento == 'RUC') { ?>
							<option value="DNI">DNI</option>
							<option  selected value="RUC">RUC</option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Número de Documento</td>
				<td><input class="form-control" type="text" name="num_documento" value="<?php echo htmlspecialchars($cliente->num_documento, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>Dirección</td>
				<td><input class="form-control" type="text" name="direccion" value="<?php echo htmlspecialchars($cliente->direccion, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>Telefono</td>
				<td><input class="form-control" type="text" name="telefono" value="<?php echo htmlspecialchars($cliente->telefono, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>E-Mail</td>
				<td><input class="form-control" type="text" name="email" value="<?php echo htmlspecialchars($cliente->email, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td><input type="hidden" name="idcliente" value="<?php echo $cliente->idcliente; ?>"></td>
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