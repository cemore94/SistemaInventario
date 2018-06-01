<?php
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/producto.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$producto = new Producto($db);
 
$producto->idproducto=$_POST['idproducto'];
$message = $producto->delete();
echo $message;
?>