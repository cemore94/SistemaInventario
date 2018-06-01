<?php

include '../../config/database.php';
include '../../objects/cliente.php';

$database  = new Database();
$db        = $database->getConnection();
$cliente = new Cliente($db);

$cliente->nombres     = $_POST['nombres'];
$cliente->tipo_documento = $_POST['tipo_documento'];
$cliente->num_documento = $_POST['num_documento'];
$cliente->direccion = $_POST['direccion'];
$cliente->telefono = $_POST['telefono'];
$cliente->email = $_POST['email'];
$cliente->idcliente = $_POST['idcliente'];

$cliente->update();
