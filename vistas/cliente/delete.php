<?php 


include '../../config/database.php';
include '../../objects/categoria.php';

$database = new Database();
$db = $database->getConnection();
$categoria = new Categoria($db);

$categoria->idcategoria = $_POST['categoria_id'];
$message = $categoria->delete();
echo $message;
?>