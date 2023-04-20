<?php
class DatabaseConnect
{
    private $conn = null;

    public function __construct()
    {
        $host = "localhost";
        $db = "debt";
        $user = "root";
        $pass = "";
        $port = "3306";

        try {
            $this->conn = new PDO("mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db", $user, $pass);
        } catch (PDOException $e) {
            die(json_encode(array("success" => false, "message" => $e->getMessage())));
        }
    }

    public function connect()
    {
        return $this->conn;
    }
}
