<?php

include_once '../../config/database.php';
include_once '../../objects/venta.php';
include_once '../../objects/detalle_venta.php';
 
$database = new Database();
$db = $database->getConnection();
$venta = new Venta($db);
 
$venta->idcliente=$_POST['idcliente'];
$venta->tipo_comprobante=$_POST['tipo_comprobante'];
$venta->serie_comprobante=$_POST['serie_comprobante'];
$venta->num_comprobante=$_POST['num_comprobante'];
date_default_timezone_set('America/Lima');
$venta->fecha_hora = date('Y-m-d H:i:s');
$venta->impuesto = '18';
$venta->total_venta = $_POST['monto_total'];
$venta->estado='Activo';

$idventa  = $venta->create();


$productos = json_decode($_POST['productos']);

foreach($productos as $producto ){
	$detalle = new DetalleVenta($db);
	$detalle->idventa = $idventa;
	$detalle->idproducto = $producto->idproducto;
	$detalle->cantidad = $producto->cantidad;
	$detalle->precio_venta = $producto->precio_venta;
	$detalle->descuento = $producto->descuento;
	$detalle->monto = $producto->subtotal;
	$detalle->create();
}

header("Location: index.php");

?>
