<?php 
include '../../layouts/header.php';

$active_inicio="";
$active_compranueva="active";
$active_comprahistorial="";
$active_productos="";
$active_categorias="";
$active_medidas="";
$active_proveedores="";
$active_clientes="";
$active_ventanueva="";
$active_administrarventas="";
$active_facturacion="";
$active_reportes="";
$active_configuracion="";
$active_accesos="";

include '../../layouts/sidebar.php';

?>
  <style type="text/css">
    .fc{
      padding-right: 30px;
    }
    .fc + .glyphicon {
      position: absolute;
      right: 0;
      padding: 8px 27px;
    } 
  </style>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="compraApp" ng-controller="compraController" >
  <!-- Main content -->
  <section class="content">
    <!-- COLOR PALETTE -->
    <div class="box box-default color-palette-box">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-tag"></i> Nueva Compra</h3>
      </div>
      <form method="post" action="registrar.php" id="create-ingreso-form">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              
                <div class="box box-info">
                  <div class="box-header box-header-background-light with-border">
                    <h3 class="box-title">Detalles de Compra</h3>
                  </div>
                  <div class="box-background">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Proveedor</label>                            
                            <select name="idproveedor" class="form-control select2 select2-hidden-accessible" name="supplier_id" id="supplier_id" required="" tabindex="-1" aria-hidden="true">
                            <option value="">Selecciona Proveedor</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Fecha</label>
                            <div class="input-group">
                              <input type="text" class="form-control datepicker" name="fecha_hora" 
                              value="<?php date_default_timezone_set("America/Lima"); echo date('d-m-Y h:i:s A');?>" readonly="">
                              <span class="input-group-btn ">
                                <button class="btn btn-default " type="button"><i class="fa fa-calendar "></i></button>
                              </span>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Agregar productos</label>
                            <button  ng-click="cargarProductos()" type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#listaProductos"><i class="fa fa-search"></i> Buscar productos</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">                        
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="tipo_comprobante">Tipo de Comprobante</label>
                            <select name="tipo_comprobante" class="form-control" required="">
                                <option value="RUC">RUC</option>
                                <option value="DNI">DNI</option>
                                <option value="PAS">PAS</option>
                            </select>
                          </div>
                        </div>                        
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="serie_comprobante">Serie de Comprobante</label>
                            <input type="text" name="serie_comprobante" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">                          
                            <label for="num_comprobante">Número de Comprobante</label>
                            <input type="text" name="num_comprobante" class="form-control" required>
                          </div>
                        </div>
                      </div>
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
                      <th class="text-center"><i class="fa fa-gear fa-fw"></i></th>
                      <th>PRODUCTO</th>
                      <th>CANTIDAD</th>
                      <th>PRECIO DE COMPRA</th>
                      <th>PRECIO DE VENTA</th>
                      <th>SUBTOTAL</th>
                    </tr>
                  </thead>
                  <tbody>                     
                      <tr ng-repeat="pd in productosAdd">
                        <td class="text-center"><a href="javascript:void(0);" ng-click="eliminarProducto($index)" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-fw"></i></button></td>
                        <td>{{ pd.producto }}</td>
                        <td>{{ pd.cantidad }}</td>
                        <td>{{ pd.precio | currency:'S/.'}}</td>
                        <td>{{ pd.precioventa | currency:'S/.'}}</td>
                        <td>{{ pd.subtotal | currency:'S/.'}}</td>
                      </tr>
                      <tr>
                        <td colspan="5" class="text-right"><b>Total:</b></td>
                        <td>{{ getTotal() | currency:'S/.' }}</td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="box-footer" id="guardar">
            <input type="text" name="productos" class="hidden"  value="{{ productosAdd }}">
            <input type="hidden" name="monto_total"  value="{{ getTotal() }}">
            <button type="submit" class="btn btn-success pull-right " id="registrar-compra"><i class="fa fa-floppy-o"></i> Registrar Compra</button>
          </div>
        </div>
      <!-- /.box-body -->
      </form>
    </div>
    <!-- /.box -->
    <?php
    include '../../modals/cargaProductosCompra.php';
    ?>
  </section>
  <!-- /.content -->
</div>

<?php 
include '../../layouts/footer.php';
?>
<script type="text/javascript" src="../../dist/js/angular.min.js"></script>

<script type="text/javascript" src="../../dist/js/ingreso_detalle.js"></script>

<script type="text/javascript" src="../../dist/js/dirPagination.js"></script>

<script>
  $(function () {
        //Initialize Select2 Elements
    $(".select2").select2();
    //datepicker
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
       endDate: '-1d',
      autoclose: true
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $( ".select2" ).select2({        
    ajax: {
      url: "proveedor.php",
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term // search term
        };
      },
      processResults: function (data) {
        // parse the results into the format expected by Select2.
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data
        return {
          results: data
        };
      },
      cache: true 
    },
    minimumInputLength: 2
    })
   //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    });

</script>

<script type="text/javascript">
    
</script>


</body>
</html>