  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user9.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Carlos Barrios</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <li class="<?php echo $active_inicio; ?> treeview">
          <a href="../../vistas/inicio/index.php">
            <i class="glyphicon glyphicon-home"></i> <span>Inicio</span>
            
          </a>
          
        </li>
        <li class="<?php echo $active_compranueva == 'active' ? $active_compranueva : $active_comprahistorial ;?> treeview">
          <a href="#">
            <i class="fa fa-truck"></i>
            <span>Compras</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $active_compranueva == 'active' ? 'active':'' ?>"><a href="../../vistas/compra/nueva.php"><i class="glyphicon glyphicon-shopping-cart"></i> Nueva Compra</a></li>
            <li class="<?php echo $active_comprahistorial == 'active' ? 'active':'' ?>"><a href="../../vistas/compra/"><i class="glyphicon glyphicon-th-list"></i> Historial de Compras</a></li>
            
          </ul>
        </li>
        <li class="<?php echo $active_ventanueva == 'active' ? $active_ventanueva : $active_ventahistorial ;?> treeview hidden">
          <a href="#">
            <i class="fa fa-cart-plus"></i>
            <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $active_ventanueva == 'active' ? 'active':'' ?>"><a href="../../vistas/venta/nueva.php"><i class="glyphicon glyphicon-shopping-cart"></i> Nueva Ventas</a></li>
            <li class="<?php echo $active_ventahistorial == 'active' ? 'active':'' ?>"><a href="../../vistas/venta/"><i class="glyphicon glyphicon-th-list"></i> Historial de Ventas</a></li>
            
          </ul>
        </li>
        <li class="<?php echo $active_productos;?> treeview">
          <a href="../../vistas/productos/index.php">
            <i class="fa fa-barcode"></i> <span>Productos</span>
          </a>
        </li>
        <li class="<?php echo $active_categorias;?> treeview">
          <a href="../../vistas/categorias/index.php">
            <i class="glyphicon glyphicon-tag"></i>
            <span>Categorias</span> 
          </a>
        </li>
        <li class="<?php echo $active_medidas;?> treeview">
          <a href="../../vistas/medidas/index.php">
            <i class="glyphicon glyphicon-th-large"></i>
            <span>Unidades de Medida</span> 
          </a>
        </li>
        <li class="<?php echo $active_proveedores == 'active' ? $active_proveedores : $active_clientes ;?> treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Contactos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $active_clientes == 'active' ? 'active':'' ?>"><a href="../../vistas/cliente/index.php"><i class="glyphicon glyphicon-user"></i> Clientes</a></li>
            <li class="<?php echo $active_proveedores == 'active' ? 'active':'' ?>"><a href="../../vistas/proveedor/index.php"><i class="glyphicon glyphicon-briefcase"></i> Proveedores</a></li>
            
          </ul>
        </li>
        <li class="<?php echo $active_ventanueva == 'active' ? $active_ventanueva : $active_administrarventas ;?> treeview">
          <a href="#">
            <i class="glyphicon glyphicon-usd"></i> <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $active_ventanueva == 'active' ? 'active':'' ?>"><a href="../../vistas/venta/nueva.php"><i class="fa fa-cart-plus"></i> Nueva Venta</a></li>
            <li class="<?php echo $active_administrarventas == 'active' ? 'active':'' ?>"><a href="../../vistas/venta/"><i class="fa fa-list-alt"></i> Administrar Facturas</a></li>
            
          </ul>
        </li>
        <li class="<?php echo $active_reportes;?> treeview">
          <a href="#">
            <i class="glyphicon glyphicon-signal"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-bar-chart"></i> Reporte de Ventas</a></li>
            <li><a href="#"><i class="fa fa-line-chart"></i> Reporte de Compras</a></li>
          </ul>
        </li>

        <li class="<?php echo $active_configuracion;?> treeview">
          <a href="#">
            <i class="fa fa-gear"></i> <span>Configuración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Perfil de la empresa</a></li>
          </ul>
        </li>
        <li class="<?php echo $active_accesos;?>treeview">
          <a href="#">
            <i class="fa fa-lock"></i> <span>Administar Accesos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Grupos de Usuarios</a></li>
            <li><a href="#"><i class="fa fa-users"></i> Usuarios</a></li>
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>



 

 