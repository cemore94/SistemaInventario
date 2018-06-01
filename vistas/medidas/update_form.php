<?php

$medida_id = isset($_GET['medida_id']) ? $_GET['medida_id'] : die('Error: No se encontró id de unidad de medida.');

include '../../config/database.php';
include '../../objects/medida.php';

$database = new Database();
$db = $database->getConnection();
$medida = new Medida($db);
$medida->idunidad_medida = htmlspecialchars($medida_id, ENT_QUOTES);

$medida->readOne();

?>

<form id="update-medida-form" action="#" method="POST">
	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-striped table-hover">
			<tr>
				<td>Nombre</td>
				<td><input class="form-control" type="text" name="unidad" value="<?php echo htmlspecialchars($medida->unidad, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>Abreviatura</td>
				<td><input class="form-control" type="text" name="abreviatura" value="<?php echo htmlspecialchars($medida->abreviatura, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td><input type="hidden" name="idunidad_medida" value="<?php echo $medida->idunidad_medida; ?>"></td>
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