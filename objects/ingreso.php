<?php
class Ingreso{
     
    // Nombres de las tablas y de la conexion a la BD
    private $conn;
    private $table_ingreso = "ingreso";
    private $table_proveedor= "proveedor";
    private $table_di= "detalle_ingreso";
     
    public $idingreso;
    public $nombres;
    public $tipo_comprobante;
    public $serie_comprobante;
    public $num_comprobante;
    public $fecha_hora;
    public $impuesto;
    public $monto_compra;
    public $estado;
    public $message;

    public $idarticulo;
    public $cantidad;

    public $numrows;
     
    public function __construct($db){
        $this->conn = $db;
    }
    
    function create(){
    
        $query = "INSERT INTO " . $this->table_ingreso . " SET idproveedor=:idproveedor, tipo_comprobante=:tipo_comprobante, serie_comprobante=:serie_comprobante, num_comprobante=:num_comprobante, fecha_hora=:fecha_hora, impuesto=:impuesto, monto_compra=:monto_compra, estado=:estado ";

        $stmt = $this->conn->prepare($query);
         
        $stmt->bindParam(":idproveedor", $this->idproveedor);
        $stmt->bindParam(":tipo_comprobante", $this->tipo_comprobante);
        $stmt->bindParam(":serie_comprobante", $this->serie_comprobante);
        $stmt->bindParam(":num_comprobante", $this->num_comprobante);
        $stmt->bindParam(":fecha_hora", $this->fecha_hora);
        $stmt->bindParam(":impuesto", $this->impuesto);
        $stmt->bindParam(":monto_compra", $this->monto_compra);
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

            " . $this->table_ingreso . ".idingreso,
            " . $this->table_ingreso . ".fecha_hora,
            " . $this->table_proveedor . ".nombres,
            " . $this->table_ingreso . ".tipo_comprobante,
            " . $this->table_ingreso . ".serie_comprobante,
            " . $this->table_ingreso . ".num_comprobante,
            " . $this->table_ingreso . ".impuesto,
            " . $this->table_ingreso . ".monto_compra,
            " . $this->table_ingreso . ".estado
            FROM "
            . $this->table_ingreso . "
            INNER JOIN " . $this->table_proveedor . " ON " . $this->table_ingreso . ".idproveedor = " . $this->table_proveedor . ".idproveedor " . $sWhere . " LIMIT " . $offset. "," . $per_page . "";
         
        // preparamos la consulta
        $stmt = $this->conn->prepare( $query );
             
        // ejecutamos la consulta
        $stmt->execute();

             
        return $stmt;
    }

     function nRows($sWhere){

        $query = "SELECT count(*) AS numrows FROM ". $this->table_ingreso . " INNER JOIN " . $this->table_proveedor . " ON " . $this->table_ingreso . ".idproveedor = " . $this->table_proveedor . ".idproveedor " . $sWhere;
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch();
        $this->numrows = $row['numrows'];

        return $this->numrows;
    }

    function show(){
        $query = "SELECT
            " . $this->table_ingreso . ".fecha_hora,
            " . $this->table_proveedor . ".nombres,
            " . $this->table_ingreso . ".tipo_comprobante,
            " . $this->table_ingreso . ".serie_comprobante,
            " . $this->table_ingreso . ".num_comprobante,
            " . $this->table_ingreso . ".monto_compra
            FROM "
            . $this->table_ingreso . "
            INNER JOIN " . $this->table_proveedor . " ON " . $this->table_ingreso . ".idproveedor=" . $this->table_proveedor . ".idproveedor WHERE idingreso=:idingreso" ;

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":idingreso", $this->idingreso);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->fecha_hora = $row['fecha_hora'];
        $this->nombres = $row['nombres'];
        $this->tipo_comprobante = $row['tipo_comprobante'];
        $this->serie_comprobante = $row['serie_comprobante'];
        $this->num_comprobante = $row['num_comprobante'];
        $this->monto_compra = $row['monto_compra'];


    }

}