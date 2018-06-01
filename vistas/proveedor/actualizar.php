<?php

include '../../config/database.php';
include '../../objects/proveedor.php';

$database  = new Database();
$db        = $database->getConnection();
$proveedor = new Proveedor($db);

$proveedor->nombres     = $_POST['nombres'];
$proveedor->tipo_documento = $_POST['tipo_documento'];
$proveedor->num_documento = $_POST['num_documento'];
$proveedor->direccion = $_POST['direccion'];
$proveedor->telefono = $_POST['telefono'];
$proveedor->email = $_POST['email'];
$proveedor->idproveedor = $_POST['idproveedor'];

$proveedor->update();
