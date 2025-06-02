<?php

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // گرفتن تمام کاربران (بدون نمایش پسورد)
    public function getAllUsers()
    {
        $stmt = $this->conn->prepare("SELECT id, name, email, createdat FROM users ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // اضافه کردن کاربر جدید با پسورد هش شده
    public function addUser($name, $email, $password)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $hashed]);
    }
    public function findByEmail($email)
    {
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
