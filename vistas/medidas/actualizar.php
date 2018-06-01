<?php

include '../../config/database.php';
include '../../objects/medida.php';

$database  = new Database();
$db        = $database->getConnection();
$medida = new Medida($db);

$medida->unidad      = $_POST['unidad'];
$medida->abreviatura = $_POST['abreviatura'];
$medida->idunidad_medida = $_POST['idunidad_medida'];

$medida->update();