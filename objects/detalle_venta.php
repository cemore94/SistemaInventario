<?php
class DetalleVenta{
     
    // Nombres de las tablas y de la conexion a la BD
    private $conn;
    private $table_dv = "detalle_venta";
    private $table_producto = "producto";
     
    public $iddetalle_venta;
    public $idventa;
    public $idproducto;
    public $producto;
    public $cantidad;
    public $precio_venta;
    public $descuento;
    public $monto;

    public $numrows;
     
    public function __construct($db){
        $this->conn = $db;
    }
    
    function create(){
    
        $query = "INSERT INTO " . $this->table_dv . " SET  idventa=:idventa, idproducto=:idproducto, cantidad=:cantidad, precio_venta=:precio_venta, descuento=:descuento, monto=:monto ";

        $stmt = $this->conn->prepare($query);
         
        $stmt->bindParam(":idventa", $this->idventa);
        $stmt->bindParam(":idproducto", $this->idproducto);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":precio_venta", $this->precio_venta);
        $stmt->bindParam(":descuento", $this->descuento);
        $stmt->bindParam(":monto", $this->monto);
        
        if($stmt->execute()){
            return true;    
        }else{
            return false;
        }

    }

    function show(){

        $query = "SELECT
            " . $this->table_dv . ".cantidad,
            " . $this->table_dv . ".precio_venta,
            " . $this->table_dv . ".descuento,
            " . $this->table_dv . ".monto,
            " . $this->table_producto . ".producto
            FROM "
            . $this->table_dv . "
            INNER JOIN " . $this->table_producto . " ON " . $this->table_dv . ".idproducto = " . $this->table_producto . ".idproducto WHERE idventa=:idventa";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":idventa", $this->idventa);
        $stmt->execute();

        return $stmt;
    }   

}