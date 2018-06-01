 <?php

include '../../config/database.php';
include '../../objects/producto.php';

$database  = new Database();
$db        = $database->getConnection();
$producto = new Producto($db);

$lista_productos = $producto->todos();

echo  json_encode($lista_productos);