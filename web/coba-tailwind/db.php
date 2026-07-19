<?php
class db {
    private $host = "localhost";
    private $user ="root";
    private $pass = "";
    private $db = "db_finance_book";
    private $port = "3306";

    public $conn;
    public function __construct(){
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db, $this->port);
        if ($this->conn->connect_error) {
            die ("Connection failde: ".mysqli_connect_error());
        }
    }
}
?>