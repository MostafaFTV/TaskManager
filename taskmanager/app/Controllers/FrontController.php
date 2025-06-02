<?php

require_once 'app/models/task.php';
require_once 'config/database.php';

class FrontController
{
    private $db;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // اتصال به دیتابیس
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index()
    {
        require_once 'views/head.php';
        require_once 'views/home.php';
        require_once 'views/footer.php';
    }

    public function about()
    {
        require_once 'views/head.php';
        require_once 'views/about.php';
        require_once 'views/footer.php';
    }

    public function dashboard()
    {
        $this->checkAuth();
        $taskModel = new Task($this->db);
        $tasks = $taskModel->getTasksByUser($_SESSION['user_id']);

        require_once 'views/head.php';
        require_once 'views/dashboard.php';
        require_once 'views/footer.php';
    }

    public function markdone()
    {
        $this->checkAuth();
        $taskModel = new Task($this->db);
        $task_id = $_GET['id'] ?? null;

        if ($task_id && $taskModel->markAsDone($task_id, $_SESSION['user_id'])) {
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            echo "خطا در علامت‌گذاری تسک.";
        }
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }
    }
}
