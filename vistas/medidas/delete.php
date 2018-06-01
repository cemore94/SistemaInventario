<?php 
include '../../config/database.php';
include '../../objects/medida.php';

$database = new Database();
$db = $database->getConnection();
$medida = new Medida($db);

$medida->idunidad_medida = $_POST['medida_id'];
$message = $medida->delete();
echo $message;
?>