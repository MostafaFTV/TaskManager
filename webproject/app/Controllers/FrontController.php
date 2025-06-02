<?php

class FrontController
{
    public function home()
    {
        require_once __DIR__ . '/../../config/database.php';
        require_once __DIR__ . '/../models/user.php';
        require_once __DIR__ . '/../models/post.php';
        require_once __DIR__ . '/../models/related_post.php';
        require_once __DIR__ . '/../models/post_view.php';
        require_once __DIR__ . '/../../helper/functions.php';

        $conn = connect();

        $userModel = new User($conn);
        $postModel = new Post($conn);
        $relatedPostModel = new RelatedPost($conn);
        $postViewModel = new PostView($conn);

        // کاربران
        $users = $userModel->getAllUsers();

        // پست‌ها: صفحه‌بندی
        $page = $_GET['post_page'] ?? 1;
        $page = max(1, (int)$page);
        $perPage = 5;
        $offset = ($page - 1) * $perPage;

        $allPosts = $postModel->getAllPosts();
        $totalPosts = count($allPosts);
        $posts = array_slice($allPosts, $offset, $perPage);

        $relations = $relatedPostModel->getAllRelations();
        $postViews = $postViewModel->getAllViews();

        // ساخت ماتریس احتمال و بردار ویژه
        list($A, $postIDs) = buildProbabilityMatrix($conn);
        $importance = powerIteration($A);

        require_once __DIR__ . '/../../views/head.php';
        require_once __DIR__ . '/../../views/home.php';
        require_once __DIR__ . '/../../views/footer.php';
    }

    public function about()
    {
        require_once __DIR__ . '/../../views/head.php';
        require_once __DIR__ . '/../../views/about.php';
        require_once __DIR__ . '/../../views/footer.php';
    }

    public function login()
    {
        require_once __DIR__ . '/../../config/database.php';
        require_once __DIR__ . '/../models/user.php';
        session_start();

        $conn = connect();
        $userModel = new User($conn);

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']];
                header("Location: /webproject/dashboard");
                exit;
            } else {
                $error = "ایمیل یا رمز عبور اشتباه است.";
            }
        }

        require_once __DIR__ . '/../../views/head.php';
        require_once __DIR__ . '/../../views/login.php';
        require_once __DIR__ . '/../../views/footer.php';
    }

    public function register()
    {
        require_once __DIR__ . '/../../config/database.php';
        require_once __DIR__ . '/../models/user.php';
        session_start();

        $conn = connect();
        $userModel = new User($conn);

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($userModel->findByEmail($email)) {
                $error = "این ایمیل قبلاً ثبت شده است.";
            } else {
                $userModel->addUser($name, $email, $password);
            
                // دریافت دوباره کاربر با id
                $user = $userModel->findByEmail($email);
                
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ];
            
                header("Location: /webproject/dashboard");
                exit;
            }
            
        }

        require_once __DIR__ . '/../../views/head.php';
        require_once __DIR__ . '/../../views/register.php';
        require_once __DIR__ . '/../../views/footer.php';
    }

    public function dashboard()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /webproject/login");
            exit;
        }

        require_once __DIR__ . '/../../config/database.php';
        require_once __DIR__ . '/../models/post.php';

        $conn = connect();
        $postModel = new Post($conn);
        $posts = $postModel->getPostsByUser($_SESSION['user']['id']);

        require_once __DIR__ . '/../../views/head.php';
        require_once __DIR__ . '/../../views/dashboard.php';
        require_once __DIR__ . '/../../views/footer.php';
    }

    public function add_post()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /webproject/login");
            exit;
        }

        require_once __DIR__ . '/../../config/database.php';
        require_once __DIR__ . '/../models/post.php';

        $conn = connect();
        $postModel = new Post($conn);

        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $user_id = $_SESSION['user']['id'];

            if ($postModel->addPost($user_id, $title, $content)) {
                $message = "پست با موفقیت اضافه شد.";
            } else {
                $message = "خطا در افزودن پست.";
            }
        }

        require_once __DIR__ . '/../../views/head.php';
        require_once __DIR__ . '/../../views/add_post.php';
        require_once __DIR__ . '/../../views/footer.php';
    }

    public function delete_post()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /webproject/login");
            exit;
        }

        require_once __DIR__ . '/../../config/database.php';
        require_once __DIR__ . '/../models/post.php';

        $conn = connect();
        $postModel = new Post($conn);

        $post_id = $_GET['id'] ?? null;

        if ($post_id) {
            $postModel->deletePost($post_id, $_SESSION['user']['id']);
        }

        header("Location: /webproject/dashboard");
        exit;
    }

    public function edit_post()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /webproject/login");
            exit;
        }

        require_once __DIR__ . '/../../config/database.php';
        require_once __DIR__ . '/../models/post.php';

        $conn = connect();
        $postModel = new Post($conn);

        $post_id = $_GET['id'] ?? null;
        $message = '';

        if (!$post_id) {
            header("Location: /webproject/dashboard");
            exit;
        }

        $post = $postModel->getPostById($post_id, $_SESSION['user']['id']);

        if (!$post) {
            $message = "پست پیدا نشد یا متعلق به شما نیست.";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $postModel->updatePost($post_id, $_SESSION['user']['id'], $title, $content);
            header("Location: /webproject/dashboard");
            exit;
        }

        require_once __DIR__ . '/../../views/head.php';
        require_once __DIR__ . '/../../views/edit_post.php';
        require_once __DIR__ . '/../../views/footer.php';
    }
}
