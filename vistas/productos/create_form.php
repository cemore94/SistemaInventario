<?php
/*
 Se incluye el archivo que contiene la conexión a la BD y 
 el archivo que contiene la clase Product
*/
include_once '../../config/database.php';
include_once '../../objects/categoria.php';
include_once '../../objects/medida.php';
include_once '../../objects/producto.php';
 
// Se instancia la clase Database
$database = new Database();

// Se obtiene la Conexión de la BD
$db = $database->getConnection();
 
// Se instancia la clase Categoria y le pasamos como parámetro la conexión de la BD.
$categoria = new Categoria($db);
$stmt_categoria= $categoria->readAll();
$medida = new Medida($db);
$stmt_medida= $medida->readAll();
$producto = new Producto($db);
$lastid = $producto->getLastId()+1;

?>


<form id='create-product-form' action='#' method='post' border='0'>
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Codigo</td>
            <td><input type='text' readonly name='codigo' id="codigo" value="<?php echo $lastid; ?>"  class='form-control' required /></td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><input type='text' name='product' id="product" class='form-control' required="required" /></td>
        </tr>
        <tr>
            <td>Categoría</td>
            <td>
                <select class="form-control" name="idcategoria" id="idcategoria">
                <option value="0">-- Seleccionar Categoría --</option>
                    <?php
                        $categorias = $stmt_categoria->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($categorias as $cate) {
                        ?>
                            <option value="<?php echo $cate["idcategoria"]; ?>"><?php echo $cate["categoria"]; ?></option>
                            <?php
                        }
                        ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Unidad de Medida</td>
            <td>
                <select class="form-control" name="idunidad_medida" id="idunidad_medida">
                <option value="0">-- Seleccionar Unidad de Medida --</option>
                    <?php
                        $medidas = $stmt_medida->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($medidas as $medi) {
                        ?>
                            <option value="<?php echo $medi["idunidad_medida"]; ?>"><?php echo $medi["unidad"]; ?></option>
                            <?php
                        }
                        ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Unidades</td>
            <td>
                <div class="input-group">
                    <input type="number" name="unidades" id="unidades"  required="required" class="form-control" value="0">
                    <!--<span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                    <select class="form-control" name="select_unidad" required="">
                        <option value="Unidades">Unidades</option>
                        <option value="Paquetes">Paquetes</option>
                    </select>-->
                    <span class="input-group-btn">
                        <button type="button" onclick="change();" id="btn-change" data-click="0" style="height: 34px;" class="btn btn-success">U</button>
                    </span>

                </div>            
            </td>
        </tr>
        <tr>
            <td>Precio</td>
            <td><input type="text" name='precio' id="precio" class='form-control' required /></td>
        </tr>
        <tr>
            <td>Stock</td>
            <td><input type="text" name='stock' id="stock" class='form-control' required /></td>
        </tr>
        <tr>
            <td>Estado</td>
            <td>
                <select class="form-control" name="estado" id="estado">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </td>
        </tr>
        <!--
        <tr>
            <td>Imagen</td>
            <td><input type='file' name='imagen' class='form-control'/></td>
        </tr>
        -->
        <tr>
            <td></td>
            <td>                
                <button type='submit' class='btn btn-primary'>
                   <span class='glyphicon glyphicon-saved'></span> Registrar Producto
                </button>
            </td>
        </tr>
    </table>
</form>