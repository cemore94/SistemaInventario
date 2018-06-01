<?php 

include '../../config/database.php';
include '../../objects/categoria.php';

$database = new Database();
$db = $database->getConnection();
$categoria = new Categoria($db);

$categoria->categoria = $_POST['categoria'];
$categoria->descripcion = $_POST['descripcion'];
$categoria->estado = 'Activo';
$categoria->agregado = date('d-m-Y s:i:H A');

$categoria->create();

?>