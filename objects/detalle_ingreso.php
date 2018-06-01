<?php
class DetalleIngreso{
     
    // Nombres de las tablas y de la conexion a la BD
    private $conn;
    private $table_di = "detalle_ingreso";
    private $table_producto = "producto";
     
    public $iddetalle_ingreso;
    public $idingreso;
    public $idproducto;
    public $producto;
    public $cantidad;
    public $precio_compra;
    public $precio_venta;
    public $monto;

    public $numrows;
     
    public function __construct($db){
        $this->conn = $db;
    }
    
    function create(){
    
        $query = "INSERT INTO " . $this->table_di . " SET  idingreso=:idingreso, idproducto=:idproducto, cantidad=:cantidad, precio_compra=:precio_compra, precio_venta=:precio_venta, monto=:monto ";

        $stmt = $this->conn->prepare($query);
         
        $stmt->bindParam(":idingreso", $this->idingreso);
        $stmt->bindParam(":idproducto", $this->idproducto);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":precio_compra", $this->precio_compra);
        $stmt->bindParam(":precio_venta", $this->precio_venta);
        $stmt->bindParam(":monto", $this->monto);
        
        if($stmt->execute()){
            return true;    
        }else{
            return false;
        }

    }

    function show(){

        $query = "SELECT
            " . $this->table_di . ".cantidad,
            " . $this->table_di . ".precio_compra,
            " . $this->table_di . ".precio_venta,
            " . $this->table_di . ".monto,
            " . $this->table_producto . ".producto
            FROM "
            . $this->table_di . "
            INNER JOIN " . $this->table_producto . " ON " . $this->table_di . ".idproducto = " . $this->table_producto . ".idproducto WHERE idingreso=:idingreso";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":idingreso", $this->idingreso);
        $stmt->execute();

        return $stmt;
    }   

}