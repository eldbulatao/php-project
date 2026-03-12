<?php
namespace Config;
use mysqli;

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "school";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db,
            3307
        );

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }
}
?>