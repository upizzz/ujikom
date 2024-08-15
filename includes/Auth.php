<?php
require_once 'database.php';

class Auth {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        $query = "SELECT id, password, role FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password, $role);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['role'] = $role;
                return true;
            }
        }
        return false;
    }

    public function register($name, $email, $password, $role = 'user') {
        $query = "INSERT INTO " . $this->table_name . " (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
        return $stmt->execute();
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit(); // Selalu gunakan exit setelah header redirect
    }

    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }
}
?>
