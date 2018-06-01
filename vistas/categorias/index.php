<?php 
include '../../layouts/header.php';

$active_inicio="";
$active_comprasnueva="";
$active_comprahistorial="";
$active_productos="";
$active_categorias="active";
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

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="page-header" style="border-bottom-color: #3c8dbc;  border-bottom-width: 2px;">
        <h4 class="text-info box-title" id="page-title">Lista de categorias</h4>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
            <div id="loader-pages"><img src="../../dist/img/ajax-loader1.gif"></div>
        </div>       
        <div class="col-lg-6 col-md-6 col-xs-9 col-sm-9">
          <button style="display:none;" type="button" class="btn btn-success  btn-sm pull-right" id="btn-list"><span class="glyphicon glyphicon-list"></span>  Mostrar  categorias</button>
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary btn-sm" id="btn-new"><span class="glyphicon glyphicon-pencil"></span> Nuevo</button>
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" id="btn-select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Mostrar <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right">
              <li class="active" onclick="per_page(10);" id="10"><a href="#">10</a></li>
              <li onclick="per_page(25);" id="25"><a href="#">25</a></li>
              <li onclick="per_page(50)" id="50"><a href="#">50</a></li>
              <li onclick="per_page(100)" id="100"><a href="#">100</a></li>
              <li onclick="per_page(1000000)" id="1000000"><a href="#">Todos</a></li>
            </ul>
          </div>
        </div>
        <input type="hidden" id="per_page" value="10">
      </div>
    </section>
     <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
          <div class="box">
            <div class="box-header" id="cab">
              <div class="row">
                <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
                  <div class="input-group input-group-sm" style="width: 250px;">
                     <input type="text" name="table_search" id="q"  onkeyup="load(1);" class="form-control pull-right" placeholder="Buscar por nombre ...">
                     <div class="input-group-btn">
                       <button type="button" class="btn btn-success" ><i class="fa fa-search"></i></button>
                     </div>
                  </div> 
                </div>
                <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                  <div class="text-center" id="loader"></div>
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class="main"><!-- main --></div>
              <div class="other"><!-- other --></div>
            </div>
          </div>
        </div>
      </div>
    </section>
   </div>

 <?php 
 	include '../../layouts/footer.php';
 ?>

 <script type="text/javascript" src="../../dist/js/categoria.js"></script>