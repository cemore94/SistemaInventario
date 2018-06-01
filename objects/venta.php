<?php
class Venta{
     
    // Nombres de las tablas y de la conexion a la BD
    private $conn;
    private $table_venta = "venta";
    private $table_cliente= "cliente";
    private $table_dv= "detalle_venta";
     
    public $idventa;
    public $nombres;
    public $tipo_comprobante;
    public $serie_comprobante;
    public $num_comprobante;
    public $fecha_hora;
    public $impuesto;
    public $total_venta;
    public $estado;
    public $message;


    public $cantidad;

    public $numrows;
     
    public function __construct($db){
        $this->conn = $db;
    }
    
    function create(){
    
        $query = "INSERT INTO " . $this->table_venta . " SET idcliente=:idcliente, tipo_comprobante=:tipo_comprobante, serie_comprobante=:serie_comprobante, num_comprobante=:num_comprobante, fecha_hora=:fecha_hora, impuesto=:impuesto, total_venta=:total_venta, estado=:estado ";

        $stmt = $this->conn->prepare($query);
         
        $stmt->bindParam(":idcliente", $this->idcliente);
        $stmt->bindParam(":tipo_comprobante", $this->tipo_comprobante);
        $stmt->bindParam(":serie_comprobante", $this->serie_comprobante);
        $stmt->bindParam(":num_comprobante", $this->num_comprobante);
        $stmt->bindParam(":fecha_hora", $this->fecha_hora);
        $stmt->bindParam(":impuesto", $this->impuesto);
        $stmt->bindParam(":total_venta", $this->total_venta);
        $stmt->bindParam(":estado", $this->estado);
            
        if($stmt->execute()){
           $lastid =  $this->conn->lastInsertId();   
           return $lastid;
        }else{
            return false;
        }

    }

    // usado para leer los productos con categoria
    function readAll($sWhere, $offset , $per_page){
        
        // seleccionamos toda la consulta
        $query = "SELECT

            " . $this->table_venta . ".idventa,
            " . $this->table_venta . ".fecha_hora,
            " . $this->table_cliente . ".nombres,
            " . $this->table_venta . ".tipo_comprobante,
            " . $this->table_venta . ".serie_comprobante,
            " . $this->table_venta . ".num_comprobante,
            " . $this->table_venta . ".impuesto,
            " . $this->table_venta . ".total_venta,
            " . $this->table_venta . ".estado
            FROM "
            . $this->table_venta . "
            INNER JOIN " . $this->table_cliente . " ON " . $this->table_venta . ".idcliente = " . $this->table_cliente . ".idcliente " . $sWhere . " LIMIT " . $offset. "," . $per_page . "";
         
        // preparamos la consulta
        $stmt = $this->conn->prepare( $query );
             
        // ejecutamos la consulta
        $stmt->execute();

             
        return $stmt;
    }

     function nRows($sWhere){

        $query = "SELECT count(*) AS numrows FROM ". $this->table_venta . " INNER JOIN " . $this->table_cliente . " ON " . $this->table_venta . ".idcliente = " . $this->table_cliente . ".idcliente " . $sWhere;
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch();
        $this->numrows = $row['numrows'];

        return $this->numrows;
    }

    function show(){
        $query = "SELECT
            " . $this->table_venta . ".fecha_hora,
            " . $this->table_cliente . ".nombres,
            " . $this->table_venta . ".tipo_comprobante,
            " . $this->table_venta . ".serie_comprobante,
            " . $this->table_venta . ".num_comprobante,
            " . $this->table_venta . ".total_venta
            FROM "
            . $this->table_venta . "
            INNER JOIN " . $this->table_cliente . " ON " . $this->table_venta . ".idcliente=" . $this->table_cliente . ".idcliente WHERE idventa=:idventa" ;

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":idventa", $this->idventa);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->fecha_hora = $row['fecha_hora'];
        $this->nombres = $row['nombres'];
        $this->tipo_comprobante = $row['tipo_comprobante'];
        $this->serie_comprobante = $row['serie_comprobante'];
        $this->num_comprobante = $row['num_comprobante'];
        $this->total_venta = $row['total_venta'];


    }

}