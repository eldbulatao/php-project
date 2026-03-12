<?php
namespace App\Models;
use Config\Database;

class User {
    private $conn;
    private $table = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    // GET ALL USERS
    public function getAll() {
        $result = $this->conn->query("SELECT * FROM {$this->table}");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // GET USER BY ID
    public function getById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // FIND BY USERNAME (for login)
    public function findByUsername($username) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE username=?"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // CREATE USER
    public function create($username, $password, $type, $created_by) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table}
             (username, password, account_type, created_on, created_by)
             VALUES (?, ?, ?, NOW(), ?)"
        );

        $stmt->bind_param("sssi", $username, $hash, $type, $created_by);
        return $stmt->execute();
    }

    // UPDATE USER (without password)
    public function update($id, $username, $type) {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->table}
             SET username=?, account_type=?, updated_on=NOW(), updated_by=?
             WHERE id=?"
        );

        $stmt->bind_param("ssii", $username, $type, $_SESSION['user_id'], $id);
        return $stmt->execute();
    }

    // CHANGE PASSWORD
    public function changePassword($id, $newPassword) {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "UPDATE {$this->table}
             SET password=?, updated_on=NOW(), updated_by=?
             WHERE id=?"
        );

        $stmt->bind_param("sii", $hash, $_SESSION['user_id'], $id);
        return $stmt->execute();
    }
}