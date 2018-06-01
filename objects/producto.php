<?php
class Producto{
     
    private $conn;
    private $table_producto = "producto";
    private $table_categoria= "categoria";
    private $table_medida= "unidad_medida";
    private $table_di= "detalle_ingreso";
     
    public $idproducto;
    public $idcategoria;
    public $idunidad_medida;
    public $producto;
    public $paquetes;
    public $unidades;
    public $precio;
    public $stock;
    public $estado;
    public $imagen;
    public $message;
    public $numrows;
     
    public function __construct($db){
        $this->conn = $db;
    }
    
    function create(){

        $query = "INSERT INTO " . $this->table_producto . " SET idcategoria=:idcategoria, idunidad_medida=:idunidad_medida, producto=:producto, paquetes=:paquetes, unidades=:unidades, precio=:precio, stock=:stock, estado=:estado ";
         
        $stmt = $this->conn->prepare($query);
     
        // vinculamos los valores a los parametros de la consulta
        $stmt->bindParam(":producto", $this->producto);
        $stmt->bindParam(":idcategoria", $this->idcategoria);
        $stmt->bindParam(":idunidad_medida", $this->idunidad_medida);
        $stmt->bindParam(":paquetes", $this->paquetes);
        $stmt->bindParam(":unidades", $this->unidades);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":estado", $this->estado);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function todos(){

        $query = "SELECT
            *    
            FROM "
            . $this->table_producto . "
            INNER JOIN " . $this->table_categoria . " ON " . $this->table_producto . ".idcategoria = "
            . $this->table_categoria . ".idcategoria  INNER JOIN " . $this->table_medida . " ON " 
            . $this->table_producto . ".idunidad_medida = " . $this->table_medida . ".idunidad_medida group by "
            . $this->table_producto . ".idproducto order by " . $this->table_producto . ".idproducto asc";
         
        $stmt = $this->conn->prepare( $query );
             
        $stmt->execute();
        $i = 0;
        $arr = array();
        while ($row = $stmt->fetch()){
            $arr[$i] = $row;
            $i++;
        }
        return $arr;             
    }

    function readAll($sWhere, $offset , $per_page){

        $query = "SELECT

            " . $this->table_producto . ".idproducto,
            " . $this->table_producto . ".idcategoria,
            " . $this->table_producto . ".idunidad_medida,
            " . $this->table_producto . ".producto,
            " . $this->table_producto . ".precio,
            " . $this->table_producto . ".stock,
            " . $this->table_producto . ".estado,
            " . $this->table_categoria . ".categoria,
            " . $this->table_medida . ".unidad
            FROM "
            . $this->table_producto . "
            INNER JOIN " . $this->table_categoria . " ON " . $this->table_producto . ".idcategoria = " . $this->table_categoria . ".idcategoria  INNER JOIN " . $this->table_medida . " ON " . $this->table_producto . ".idunidad_medida = " . $this->table_medida . ".idunidad_medida " . $sWhere . " LIMIT " . $offset. "," . $per_page . "";
         
        $stmt = $this->conn->prepare( $query );
             
        $stmt->execute();
             
        return $stmt;
    }

    public function countAll(){
        
        $query = "SELECT idproducto FROM " . $this->table_producto . "";
        
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        
        $num = $stmt->rowCount();
        
        return $num;
    }

    function readOne(){
         
        $query = "SELECT producto, idcategoria, idunidad_medida, precio, stock, estado FROM  " . $this->table_producto . " WHERE  idproducto = ?  LIMIT  0,1";
     
        $stmt = $this->conn->prepare( $query );
         
        $stmt->bindParam(1, $this->idproducto);
         
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $this->producto = $row['producto'];
        $this->idcategoria = $row['idcategoria'];
        $this->idunidad_medida = $row['idunidad_medida'];
        $this->precio = $row['precio'];
        $this->stock = $row['stock'];
        $this->estado = $row['estado'];
    }

     function nRows($sWhere){
         
        $query = "SELECT count(*) AS numrows FROM " . $this->table_producto . " INNER JOIN " . $this->table_categoria . " ON " . $this->table_producto . ".idcategoria = " . $this->table_categoria . ".idcategoria INNER JOIN " . $this->table_medida . " ON " . $this->table_producto . ".idunidad_medida = " . $this->table_medida . ".idunidad_medida " . $sWhere ."";

        $stmt = $this->conn->prepare( $query );
           
        $stmt->execute();
     
        $row = $stmt->fetch();

        $this->numrows = $row['numrows'];

        return $this->numrows;
    }


    function update(){
     
        $query = "UPDATE " . $this->table_producto . " SET producto=:producto, idcategoria=:idcategoria, idunidad_medida=:idunidad_medida, precio=:precio, stock=:stock, estado=:estado WHERE idproducto=:idproducto";
     
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':producto', $this->producto);
        $stmt->bindParam(':idcategoria', $this->idcategoria);
        $stmt->bindParam(':idunidad_medida', $this->idunidad_medida);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':idproducto', $this->idproducto);
         
        if($stmt->execute()){
            return true;
        }else{
            return false;
            
        }
    }

    function delete(){
     
        $query = "DELETE FROM " . $this->table_producto . " WHERE idproducto = ?";

        $stmt = $this->conn->prepare($query);
         
        $stmt->bindParam(1, $this->idproducto);
     
        if($stmt->execute()){
            return $this->message = "Y";
        }else{
            return $this->message = "N";
        }
    }

    function getLastId(){

        $query = "SELECT max(idproducto)  AS ultimo FROM " .$this->table_producto;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch();
        $u = $row['ultimo'];

        return $u;


        }

}