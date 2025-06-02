<?php
require_once 'config/database.php';

class User
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // ثبت نام کاربر جدید
    public function register($username, $password)
    {
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // ورود کاربر
    public function login($username, $password)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            return true;
        }
        return false;
    }
}
