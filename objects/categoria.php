<?php

class Categoria
{

    // Nombres de variables de conexion y de tabla a BD
    private $conn;
    private $table_category = "categoria";
    private $table_product  = "producto";

    // Atributos de la tabla
    public $idcategoria;
    public $categoria;
    public $descripcion;
    public $estado;
    public $agregado;
    public $message = "";

    // Constructor con parametro $db como conexion a BD
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Crea una categoria
    public function create()
    {

        // consulta para insertar una categoria
        $query = " INSERT INTO " . $this->table_category . " SET  categoria=:categoria, descripcion=:descripcion, estado=:estado, agregado=:agregado ";

        // preparamos la consulta
        $stmt = $this->conn->prepare($query);

        // establecemos los valores a los parametros de la consulta
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":agregado", $this->agregado);

        // ejecutamos la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // usado para leer todas las categorías
    function readAll(){

        // seleccionamos toda la consulta
        $query = "SELECT * FROM " . $this->table_category . "";
         
            // preparamos la sentencia de la consulta
            $stmt = $this->conn->prepare( $query );
             
            // ejecutamos la consulta
            $stmt->execute();
             
            return $stmt;

    }


    // Lee todas las categorias
    public function readAllPaginate($where, $offset, $per_page)
    {

        // consulta para leer todas las categorias
        $query = "SELECT idcategoria, categoria, descripcion, estado FROM " . $this->table_category . " " . $where . " LIMIT " . $offset . "," . $per_page;

        // preparamos la consulta
        $stmt = $this->conn->prepare($query);

        // ejecutamos la consulta
        $stmt->execute();

        return $stmt;
    }


    // Lee una categoria
    public function readOne()
    {

        // consulta para leer una sola categoria
        $query = " SELECT categoria, descripcion FROM " . $this->table_category . " WHERE idcategoria=:idcategoria";

        // preparamos la consulta
        $stmt = $this->conn->prepare($query);

        // establecemos el valor al parámetro de la consulta
        $stmt->bindParam(":idcategoria", $this->idcategoria);

        // ejecutamos la consulta
        $stmt->execute();

        // obtenemos valores de la categoria
        $row               = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->categoria     = $row['categoria'];
        $this->descripcion = $row['descripcion'];

    }

    // usado para paginar los productos con categoria
    public function nRows($sWhere)
    {

        // consulta de obtención de numero de filas
        $query = "SELECT count(*) AS numrows FROM " . $this->table_category . " " . $sWhere;

        // preparamos la consulta
        $stmt = $this->conn->prepare($query);

        // ejecutamos la consulta
        $stmt->execute();

        // obtenemos la fila recuperada
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // establecemos valor a la propiedad de la clase
        $this->numrows = $row['numrows'];

        return $this->numrows;
    }

    // Actualiza una categoria
    public function update()
    {

        // consulta de actualizacion
        $query = "UPDATE " . $this->table_category . " SET categoria=:categoria, descripcion=:descripcion WHERE idcategoria=:idcategoria";

        // preparamos la sentencia de consulta
        $stmt = $this->conn->prepare($query);

        // establecemos los valores a los parametros de la consulta
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":idcategoria", $this->idcategoria);

        // ejecutamos la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Elimina una categoria
    public function delete()
    {

        // consulta para verificar vinculación con tabla producto
        $query_select = "SELECT * FROM " . $this->table_product . " WHERE idcategoria = ?";
        $stmt_select  = $this->conn->prepare($query_select);
        $stmt_select->bindParam(1, $this->idcategoria);
        $stmt_select->execute();
        $rowcount = $stmt_select->rowCount();

        if ($rowcount == 0) {

            // consulta de eliminación
            $query_delete = "DELETE FROM " . $this->table_category . " WHERE idcategoria = ?";

            // preparamos la consulta
            $stmt_delete = $this->conn->prepare($query_delete);

            // vinculamos el id del registro a eliminar
            $stmt_delete->bindParam(1, $this->idcategoria);

            // ejecutamos la consulta
            if ($stmt_delete->execute()) {
                $this->message = "Y";
            } else {
                $this->message = "N";
            }
        } else {
            $this->message = "V";
        }

        return $this->message;
    }
}
