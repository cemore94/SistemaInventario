<?php

$idingreso = isset($_GET['idingreso']) ? $_GET['idingreso'] : die('Error: No se encontró id de ingreso.');

include '../../config/database.php';
include '../../objects/ingreso.php';
include '../../objects/detalle_ingreso.php';

$database  = new Database();
$db        = $database->getConnection();
$ingreso = new Ingreso($db);
$ingreso->idingreso = htmlspecialchars($idingreso, ENT_QUOTES);
$ingreso->show();

$di = new DetalleIngreso($db);
$di->idingreso = htmlspecialchars($idingreso, ENT_QUOTES);
$stmt = $di->show();
?>

<div class="box-body">              
  <div class="box">
    <div class="box-body">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-10">
          <div class="form-group">
            <label>Proveedor</label>
            <p><?php echo htmlspecialchars($ingreso->nombres, ENT_QUOTES); ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Fecha</label>
            <p><?php echo htmlspecialchars($ingreso->fecha_hora, ENT_QUOTES); ?></p>
          </div>
        </div>
      </div>                        
      <div class="row">                        
        <div class="col-md-4">
          <div class="form-group">
            <label for="tipo_comprobante">Tipo de Comprobante</label>
            <p><?php echo htmlspecialchars($ingreso->tipo_comprobante, ENT_QUOTES); ?></p>
          </div>
        </div>                        
        <div class="col-md-4">
          <div class="form-group">
            <label for="serie_comprobante">Serie de Comprobante</label>
            <p><?php echo htmlspecialchars($ingreso->serie_comprobante, ENT_QUOTES); ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">                          
            <label for="num_comprobante">Número de Comprobante</label>
            <p><?php echo htmlspecialchars($ingreso->num_comprobante, ENT_QUOTES); ?></p>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="table-responsive">
        <table id="detalles" class="table table-striped table-bordered">
          <thead>
            <tr class="info">

              <th>PRODUCTO</th>
              <th>CANTIDAD</th>
              <th>PRECIO DE COMPRA</th>
              <th>PRECIO DE VENTA</th>
              <th>SUBTOTAL</th>
            </tr>
          </thead>
          <tbody>                     
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
              <td><?php echo $row['producto'] ?></td>
              <td><?php echo $row['cantidad'] ?></td>
              <td><?php echo $row['precio_compra'] ?></td>
              <td><?php echo $row['precio_venta'] ?></td>
              <td><?php echo $row['monto'] ?></td>
            </tr>
            <?php
              }
            ?>
            <tr>
              <td colspan="4" class="text-right"><b>Total:</b></td>
              <td><?php echo htmlspecialchars($ingreso->monto_compra, ENT_QUOTES); ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>