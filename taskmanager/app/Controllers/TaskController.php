<?php

require_once 'app/models/task.php';

class TaskController
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    private function checkAuth()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?url=user/login");
            exit;
        }
    }

    public function index()
    {
        $this->checkAuth();

        $tasks = [];
        $keyword = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
            $keyword = trim($_POST['search']);
            $tasks = $this->taskModel->searchTasks($_SESSION['user_id'], $keyword);
        } else {
            $tasks = $this->taskModel->getTasksByUser($_SESSION['user_id']);
        }

        require_once 'views/head.php';
        require_once 'views/tasks.php';
        require_once 'views/footer.php';
    }

    public function create()
    {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $user_id = $_SESSION['user_id'];

            if ($this->taskModel->addTask($user_id, $title, $description)) {
                header('Location: index.php?url=task/index');
                exit;
            } else {
                $error = "خطا در افزودن تسک.";
            }
        }

        require_once 'views/head.php';
        require_once 'views/add_task.php';
        require_once 'views/footer.php';
    }

    public function delete()
    {
        $this->checkAuth();

        if (isset($_GET['id'])) {
            $task_id = (int) $_GET['id'];
            $this->taskModel->deleteTask($task_id);
        }

        header('Location: index.php?url=task/index');
        exit;
    }

    public function edit()
    {
        $this->checkAuth();

        if (!isset($_GET['id'])) {
            header('Location: index.php?url=task/index');
            exit;
        }

        $task_id = (int) $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);

            if ($this->taskModel->updateTask($task_id, $title, $description)) {
                header('Location: index.php?url=task/index');
                exit;
            } else {
                $error = "خطا در ویرایش تسک.";
            }
        }

        $tasks = $this->taskModel->getTasksByUser($_SESSION['user_id']);
        $task_to_edit = null;
        foreach ($tasks as $task) {
            if ($task['id'] == $task_id) {
                $task_to_edit = $task;
                break;
            }
        }

        if (!$task_to_edit) {
            header('Location: index.php?url=task/index');
            exit;
        }

        require_once 'views/head.php';
        require_once 'views/edit_task.php';
        require_once 'views/footer.php';
    }

    public function markdone()
    {
        $this->checkAuth();

        if (isset($_GET['id'])) {
            $task_id = (int) $_GET['id'];
            $this->taskModel->markAsDone($task_id, $_SESSION['user_id']);
        }

        header('Location: index.php?url=task/index');
        exit;
    }
}
