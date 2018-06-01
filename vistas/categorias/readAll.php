 <?php

include '../../config/database.php';
include '../../objects/categoria.php';

$database  = new Database();
$db        = $database->getConnection();
$categoria = new Categoria($db);

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';


if ($action == 'ajax') {
    
    $q = strip_tags($_REQUEST['q'], ENT_QUOTES); 
    $aColumns = array('categoria');
    $sWhere = "";
    if ($_GET['q'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }

    $sWhere .= "ORDER BY idcategoria DESC";
    include '../../pagination/pagination.php';

    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $p_page = (isset($_REQUEST['per_page']) && !empty($_REQUEST['per_page'])) ? $_REQUEST['per_page'] : 0;
    $per_page = $p_page;
    $adjacents = 4;
    $offset = ($page - 1) * $per_page;
    $numrows = $categoria->nRows($sWhere);
    $val     = $per_page * $page;
    if ($val > $numrows) {
        $val = $numrows;
    }
    $total_pages = ceil($numrows / $per_page);
    $reload = 'index.php';
    $stmt         = $categoria->readAllPaginate($sWhere, $offset, $per_page);
    $hayRegistros = $stmt->rowCount();
    if ($hayRegistros > 0) {
            ?>
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-bordered table-hover">
                <tbody>
                  <tr>
                    <th>Id</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                  </tr>
                  <?php
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td id="categoria-id"><?php echo $row['idcategoria']; ?></td>
                      <td id="categoria"><?php echo $row['categoria']; ?></td>
                      <td><?php echo $row['descripcion']; ?></td>
                      <td><span class="label label-success"><?php echo $row['estado']; ?></span></td>
                      <td>
                        <button type="button" class="btn btn-info" id="btn-edit">Editar</button>
                        <button type="button" class="btn btn-danger" id="btn-remove">Eliminar</button>
                      </td>
                    </tr>
                  <?php
                  }
                 ?>

                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-sm-6">
                Mostrando  del <?php echo $offset + 1; ?> al <?php echo $val; ?> de <?php echo $numrows; ?> Registro(s)
              </div>
              <div class="col-sm-6">
                <span class='pull-right'>
                        <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                </span>
              </div>
            </div>
            <?php
    } else {
        ?>
          <div class="alert alert-info">No se encontró registros</div>
          <?php
    }
}

?>
