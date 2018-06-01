 <?php

 $search = strip_tags(trim($_GET['q'])); 
include '../../config/database.php';
include '../../objects/proveedor.php';

$database  = new Database();
$db        = $database->getConnection();
$proveedor = new Proveedor($db);

$nombres_proveedores = $proveedor->readAllName($search);

echo  json_encode($nombres_proveedores);