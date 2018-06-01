<?php

include_once '../../config/database.php';
include_once '../../objects/producto.php';
include_once '../../objects/medida.php';
 
$database = new Database();
$db = $database->getConnection();
$producto = new Producto($db);
$um = new Medida($db);

$producto->producto=$_POST['product'];
$producto->idcategoria=$_POST['idcategoria'];
$producto->idunidad_medida=$_POST['idunidad_medida'];
$um->idunidad_medida=$_POST['idunidad_medida'];
$equivalencia = $um->getEquivalencia();
$total_unidades = $_POST['unidades'];
$select_unidad = $_POST['select_unidad'];
// Inicio algoritmo
if($select_unidad == 'U'){
	$paquetes = $total_unidades / $equivalencia;  // 30 / 4 = 7
	$unidades = $total_unidades % $equivalencia;  // 30 % 4 = 2
	$sep = explode(".", $paquetes);
	$sep = $sep[0];
}else{
	$sep =  $total_unidades * $equivalencia;
	$unidades = 0;
}
// Fín algoritmo
$producto->paquetes = $sep;
$producto->unidades = $unidades;
$producto->precio=$_POST['precio'];
$producto->stock=$_POST['stock'];
$producto->estado=$_POST['estado'];

$producto->create();
?>