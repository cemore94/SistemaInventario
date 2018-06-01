<?php

include_once '../../config/database.php';
include_once '../../objects/ingreso.php';
include_once '../../objects/detalle_ingreso.php';
 
$database = new Database();
$db = $database->getConnection();
$ingreso = new Ingreso($db);
 
$ingreso->idproveedor=$_POST['idproveedor'];
$ingreso->tipo_comprobante=$_POST['tipo_comprobante'];
$ingreso->serie_comprobante=$_POST['serie_comprobante'];
$ingreso->num_comprobante=$_POST['num_comprobante'];
date_default_timezone_set('America/Lima');
$ingreso->fecha_hora = date('Y-m-d H:i:s');
$ingreso->impuesto = '18';
$ingreso->monto_compra = $_POST['monto_total'];
$ingreso->estado='Activo';

$idingreso  = $ingreso->create();


$productos = json_decode($_POST['productos']);

foreach($productos as $producto ){
	$detalle = new DetalleIngreso($db);
	$detalle->idingreso = $idingreso;
	$detalle->idproducto = $producto->idproducto;
	$detalle->cantidad = $producto->cantidad;
	$detalle->precio_compra = $producto->precio;
	$detalle->precio_venta = $producto->precioventa;
	$detalle->monto = $producto->subtotal;
	$detalle->create();
}

header("Location: index.php");
?>
