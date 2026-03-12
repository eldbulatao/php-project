<?php
namespace App\Models;
use Config\Database;

class Subject {
    private $conn;
    private $table = "subject";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM {$this->table}");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE subject_id=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($code, $title, $unit) {
        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table} (code, title, unit)
            VALUES (?, ?, ?)"
        );
        $stmt->bind_param("ssi", $code, $title, $unit);
        return $stmt->execute();
    }

    public function update($id, $code, $title, $unit) {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->table}
            SET code=?, title=?, unit=?
            WHERE subject_id=?"
        );
        $stmt->bind_param("ssii", $code, $title, $unit, $id);
        return $stmt->execute();
    }
}