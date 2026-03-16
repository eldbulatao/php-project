<?php

namespace App\Models;

use App\Core\Database;

class Program
{
    private $conn;
    private $table = "program";

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    // GET ALL
    public function getAll()
    {
        $result = $this->conn->query("SELECT * FROM {$this->table}");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // GET BY ID
    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE program_id=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // CREATE
    public function create($code, $title, $years)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table} (code, title, years)
             VALUES (?, ?, ?)"
        );
        $stmt->bind_param("ssi", $code, $title, $years);
        return $stmt->execute();
    }

    // UPDATE
    public function update($id, $code, $title, $years)
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->table}
             SET code=?, title=?, years=?
             WHERE program_id=?"
        );
        $stmt->bind_param("ssii", $code, $title, $years, $id);
        return $stmt->execute();
    }
}