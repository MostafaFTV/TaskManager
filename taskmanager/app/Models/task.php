<?php
require_once 'config/database.php';

class Task
{
    private $conn;
    private $table_name = "tasks";

    public $id;
    public $user_id;
    public $title;
    public $description;
    public $status;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // دریافت همه تسک‌های کاربر
    public function getTasksByUser($user_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // افزودن تسک جدید
    public function addTask($user_id, $title, $description)
    {
        $query = "INSERT INTO " . $this->table_name . " (user_id, title, description) VALUES (:user_id, :title, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);

        return $stmt->execute();
    }

    // تغییر وضعیت تسک (مثلاً از pending به completed)
    public function updateStatus($task_id, $status)
    {
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :task_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':task_id', $task_id);

        return $stmt->execute();
    }

    // حذف تسک
    public function deleteTask($task_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :task_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':task_id', $task_id);

        return $stmt->execute();
    }
    // ویرایش عنوان و توضیحات تسک
    public function updateTask($task_id, $title, $description)
    {
    $query = "UPDATE " . $this->table_name . " SET title = :title, description = :description WHERE id = :task_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':task_id', $task_id);

    return $stmt->execute();
    }
    public function searchTasks($user_id, $keyword)
    {
    $query = "SELECT * FROM " . $this->table_name . " 
              WHERE user_id = :user_id AND title LIKE :keyword 
              ORDER BY created_at DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $kw = "%" . $keyword . "%";
    $stmt->bindParam(':keyword', $kw);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function markAsDone($task_id, $user_id)
    {
    $query = "UPDATE " . $this->table_name . " SET status = 'done' WHERE id = :id AND user_id = :user_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $task_id);
    $stmt->bindParam(':user_id', $user_id);
    return $stmt->execute();
    }



}
