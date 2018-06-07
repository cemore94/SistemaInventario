<?php

class Database
{

    private $host     = "localhost";
    private $db_name  = "sanesol";
    private $user     = "test_con";
    private $password = "coti2018$";

    public $conn;

    public function getConnection()
    {

        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->user, $this->password);
        } catch (PDOException $e) {
            echo "Connection Error:" . $e->getMessage();
        }
        return $this->conn;
    }

}
