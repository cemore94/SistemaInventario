<?php
include_once '../../config/database.php';
include_once '../../objects/producto.php';
 
$database = new Database();
$db = $database->getConnection();
 
$producto = new Producto($db);
 
$producto->codigo=$_POST['codigo'];
$producto->producto=$_POST['producto'];
$producto->idcategoria=$_POST['idcategoria'];
$producto->idunidad_medida=$_POST['idunidad_medida'];
$producto->precio=$_POST['precio'];
$producto->stock=$_POST['stock'];
$producto->estado=$_POST['estado'];
//$producto->imagen=$_POST['imagen'];
$producto->idproducto=$_POST['idproducto'];

$producto->update();

?>