<?php

class Proveedor
{

    private $conn;
    private $table_proveedor  = "proveedor";
    private $table_ven  = "proveedor";

    public $idproveedor;
    public $nombres;
    public $tipo_documento;
    public $num_documento;
    public $direccion;
    public $telefono;
    public $email;
    public $message = "";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {

        $query = " INSERT INTO " . $this->table_proveedor . " SET  nombres=:nombres, tipo_documento=:tipo_documento, num_documento=:num_documento, direccion=:direccion, telefono=:telefono,
        email=:email ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombres", $this->nombres);
        $stmt->bindParam(":tipo_documento", $this->tipo_documento);
        $stmt->bindParam(":num_documento", $this->num_documento);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readAll()
    {
        $query = "SELECT * FROM " . $this->table_proveedor . "";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    function readAllName($q){
        
        $query = "SELECT idproveedor, nombres FROM " .$this->table_proveedor . " WHERE  nombres LIKE :search ";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute(array(':search'=>"%".$q."%"));

        $list = $stmt->fetchall(PDO::FETCH_ASSOC);

        if(count($list)>0){
            foreach ($list as $key => $value) {
                $data[] = array('id' => $value['idproveedor'], 'text' => $value['nombres']);
            }
        } else {
           $data[] = array('id' => '0', 'text' => 'No se encontró registros');
        }

        return $data;
    }

    public function readAllPaginate($where, $offset, $per_page)
    {
        $query = "SELECT idproveedor, nombres, tipo_documento, num_documento, telefono, email FROM " . $this->table_proveedor . " " . $where . " LIMIT " . $offset . "," . $per_page;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function readOne()
    {

        $query = " SELECT nombres, tipo_documento, num_documento,  direccion, telefono, email FROM " . $this->table_proveedor . " WHERE idproveedor=:idproveedor";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idproveedor", $this->idproveedor);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->nombres = $row['nombres'];
        $this->tipo_documento = $row['tipo_documento'];
        $this->num_documento  = $row['num_documento'];
        $this->direccion = $row['direccion'];
        $this->telefono  = $row['telefono'];
        $this->email = $row['email'];

    }

    public function nRows($sWhere)
    {

        $query = "SELECT count(*) AS numrows FROM " . $this->table_proveedor . " " . $sWhere;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->numrows = $row['numrows'];

        return $this->numrows;
    }

    public function update()
    {

        $query = "UPDATE " .$this->table_proveedor. " SET nombres=:nombres, tipo_documento=:tipo_documento, num_documento=:num_documento, direccion=:direccion, telefono=:telefono, email=:email WHERE idproveedor=:idproveedor";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombres", $this->nombres);
        $stmt->bindParam(":tipo_documento", $this->tipo_documento);
        $stmt->bindParam(":num_documento", $this->num_documento);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":idproveedor", $this->idproveedor);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query_select = "SELECT * FROM " . $this->table_proveedor . " WHERE idproveedor = ?";
        $stmt_select  = $this->conn->prepare($query_select);
        $stmt_select->bindParam(1, $this->idproveedor);
        $stmt_select->execute();
        $rowcount = $stmt_select->rowCount();

        if ($rowcount != 0) {

            $query_delete = "DELETE FROM " . $this->table_proveedor . " WHERE idproveedor = ?";
            $stmt_delete = $this->conn->prepare($query_delete);
            $stmt_delete->bindParam(1, $this->idproveedor);
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
