<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $conn;
    private $table = "users";

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function getAll()
    {
        $result = $this->conn->query("SELECT * FROM {$this->table}");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function findByUsername($username)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE username=?"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($username, $password, $type, $createdBy)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table}
             (username, password, account_type, created_on, created_by)
             VALUES (?, ?, ?, NOW(), ?)"
        );

        $stmt->bind_param("sssi", $username, $hash, $type, $createdBy);
        return $stmt->execute();
    }

    public function update($id, $username, $type, $updatedBy)
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->table}
             SET username=?, account_type=?, updated_on=NOW(), updated_by=?
             WHERE id=?"
        );

        $stmt->bind_param("ssii", $username, $type, $updatedBy, $id);
        return $stmt->execute();
    }

    public function changePassword($id, $newPassword, $updatedBy)
    {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "UPDATE {$this->table}
             SET password=?, updated_on=NOW(), updated_by=?
             WHERE id=?"
        );

        $stmt->bind_param("sii", $hash, $updatedBy, $id);
        return $stmt->execute();
    }
}