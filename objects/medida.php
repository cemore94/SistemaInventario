<?php

class Medida
{

    // Nombres de variables de conexion y de tabla a BD
    private $conn;
    private $table_medida = "unidad_medida";
    private $table_producto  = "producto";

    // Atributos de la tabla
    public $idunidad_medida;
    public $unidad;
    public $abreviatura;
    public $equivalencia;
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
        $query = " INSERT INTO " . $this->table_medida . " SET  unidad=:unidad, abreviatura=:abreviatura ";

        // preparamos la consulta
        $stmt = $this->conn->prepare($query);

        // establecemos los valores a los parametros de la consulta
        $stmt->bindParam(":unidad", $this->unidad);
        $stmt->bindParam(":abreviatura", $this->abreviatura);

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
        $query = "SELECT * FROM " . $this->table_medida . "";
         
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
        $query = "SELECT idunidad_medida, unidad, abreviatura FROM " . $this->table_medida . " " . $where . " LIMIT " . $offset . "," . $per_page;

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
        $query = " SELECT unidad, abreviatura FROM " . $this->table_medida . " WHERE idunidad_medida=:idunidad_medida";

        // preparamos la consulta
        $stmt = $this->conn->prepare($query);

        // establecemos el valor al parámetro de la consulta
        $stmt->bindParam(":idunidad_medida", $this->idunidad_medida);

        // ejecutamos la consulta
        $stmt->execute();

        // obtenemos valores de la categoria
        $row               = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->unidad      = $row['unidad'];
        $this->abreviatura = $row['abreviatura'];

    }

    // usado para paginar los productos con unidad
    public function nRows($sWhere)
    {

        // consulta de obtención de numero de filas
        $query = "SELECT count(*) AS numrows FROM " . $this->table_medida . " " . $sWhere;

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

    public function getEquivalencia(){

        $query = "SELECT equivalencia AS valor FROM " . $this->table_medida . " WHERE idunidad_medida=:idunidad_medida ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idunidad_medida", $this->idunidad_medida );
        
        $stmt->execute();        
        $row = $stmt->fetch();
        $valor = $row['valor'];

        return $valor;

    }



    // Actualiza una categoria
    public function update()
    {

        // consulta de actualizacion
        $query = "UPDATE " . $this->table_medida . " SET unidad=:unidad, abreviatura=:abreviatura WHERE idunidad_medida=:idunidad_medida";

        // preparamos la sentencia de consulta
        $stmt = $this->conn->prepare($query);

        // establecemos los valores a los parametros de la consulta
        $stmt->bindParam(":unidad", $this->unidad);
        $stmt->bindParam(":abreviatura", $this->abreviatura);
        $stmt->bindParam(":idunidad_medida", $this->idunidad_medida);

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
        $query_select = "SELECT * FROM " . $this->table_producto . " WHERE idunidad_medida = ?";
        $stmt_select  = $this->conn->prepare($query_select);
        $stmt_select->bindParam(1, $this->idunidad_medida);
        $stmt_select->execute();
        $rowcount = $stmt_select->rowCount();

        if ($rowcount == 0) {

            // consulta de eliminación
            $query_delete = "DELETE FROM " . $this->table_medida . " WHERE idunidad_medida = ?";

            // preparamos la consulta
            $stmt_delete = $this->conn->prepare($query_delete);

            // vinculamos el id del registro a eliminar
            $stmt_delete->bindParam(1, $this->idunidad_medida);

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