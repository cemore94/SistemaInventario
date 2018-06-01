<?php

$categoria_id = isset($_GET['categoria_id']) ? $_GET['categoria_id'] : die('Error: No se encontró id de categoria.');

include '../../config/database.php';
include '../../objects/categoria.php';

$database               = new Database();
$db                     = $database->getConnection();
$categoria              = new Categoria($db);
$categoria->idcategoria = htmlspecialchars($categoria_id, ENT_QUOTES);

$categoria->readOne();

?>

<form id="update-category-form" action="#" method="POST">
	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-striped table-hover">
			<tr>
				<td>Categoria</td>
				<td><input class="form-control" type="text" name="categoria" value="<?php echo htmlspecialchars($categoria->categoria, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td>Descripción</td>
				<td><input class="form-control" type="text" name="descripcion" value="<?php echo htmlspecialchars($categoria->descripcion, ENT_QUOTES); ?>" required>
				</td>
			</tr>
			<tr>
				<td><input type="hidden" name="idcategoria" value="<?php echo $categoria->idcategoria; ?>"></td>
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