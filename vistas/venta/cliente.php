 <?php

 $search = strip_tags(trim($_GET['q'])); 
include '../../config/database.php';
include '../../objects/cliente.php';

$database  = new Database();
$db        = $database->getConnection();
$cliente = new Cliente($db);

$nombres_clientes = $cliente->readAllName($search);

echo  json_encode($nombres_clientes);