<?php 

include '../../config/database.php';
include '../../objects/proveedor.php';

$database = new Database();
$db = $database->getConnection();
$proveedor = new Proveedor($db);

$proveedor->idproveedor = $_POST['proveedor_id'];
$message = $proveedor->delete();
echo $message;
?>