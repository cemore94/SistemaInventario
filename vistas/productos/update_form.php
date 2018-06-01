<?php
// get product id
$idproducto=isset($_GET['idproducto']) ? $_GET['idproducto'] : die('ERROR: Product ID no encontrado.');

include_once '../../config/database.php';
include_once '../../objects/producto.php';
include_once '../../objects/categoria.php';
include_once '../../objects/medida.php';

$database = new Database();
$db = $database->getConnection();

$producto = new Producto($db);
$producto->idproducto=$idproducto;
$producto->readOne();

$idcategoria= $producto->idcategoria;
$idunidad_medida = $producto->idunidad_medida;

?>
<form id='update-producto-form' action='#' method='post' border='0'>
    <table class='table table-bordered table-hover'>
        <tr>
            <td>Código</td>
            <td><input type='text' name='codigo' class='form-control' value='<?php echo htmlspecialchars($producto->codigo, ENT_QUOTES); ?>' required /></td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><input type='text' name='producto' class='form-control' value='<?php echo htmlspecialchars($producto->producto, ENT_QUOTES); ?>' required /></td>
        </tr>
        <tr>
            <td>Categoría</td>
            <td>
                <select class="form-control" name="idcategoria">
                    <option value="0">-- Seleccionar Categoría --</option>
                    <?php
                    $categoria = new Categoria($db);
                    $stmt= $categoria->readAll();
                    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categorias as $cate) {
                        if($idcategoria == $cate["idcategoria"]){
                            ?>
                            <option value="<?php echo $cate["idcategoria"]; ?>" selected="selected"><?php echo $cate["categoria"]; ?></option>
                            <?php
                        }else{
                            ?>
                            <option value="<?php echo $cate["idcategoria"]; ?>"><?php echo $cate["categoria"]; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Unidad de Medida</td>
            <td>
                <select class="form-control" name="idunidad_medida">
                    <option value="0">-- Seleccionar Unidad de Medida --</option>
                    <?php
                    $medida = new Medida($db);
                    $stmt= $medida->readAll();
                    $medidas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($medidas as $medi) {
                        if($idunidad_medida == $medi["idunidad_medida"]){
                            ?>
                            <option value="<?php echo $medi["idunidad_medida"]; ?>" selected><?php echo $medi["unidad"]; ?></option>
                            <?php
                        }else{
                            ?>
                            <option value="<?php echo $medi["idunidad_medida"]; ?>"><?php echo $medi["unidad"]; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Precio</td>
            <td><input type='number' name='precio' class='form-control' value='<?php echo htmlspecialchars($producto->precio, ENT_QUOTES); ?>' required /></td>
        </tr>
        <tr>
            <td>Stock</td>
            <td><input type='number' name='stock' class='form-control' value='<?php echo htmlspecialchars($producto->stock, ENT_QUOTES); ?>' required /></td>
        </tr>
        <tr>
            <td>Estado</td>
            <td>
                <select class="form-control" name="estado">
                    <option value="Activo" <?php echo $producto->estado == 'Activo' ? 'selected' : '' ?> >Activo</option>
                    <option value="Inactivo" <?php echo $producto->estado == 'Inactivo' ? 'selected' : '' ?> >Inactivo</option>
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
            <td>
                <input type='hidden' name='idproducto' value='<?php echo $idproducto ?>' /> 
            </td>
            <td>
                <button type='submit' class='btn btn-primary'>
                    <span class='glyphicon glyphicon-edit'></span> Guardar Cambios
                </button>
            </td>
        </tr>
    </table>
</form>