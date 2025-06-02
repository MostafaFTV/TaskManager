<?php

// گرفتن نام صفحه از URL - مثل localhost/webproject/about
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'login':
        case 'register':
        case 'dashboard':
            require_once 'controllers/FrontController.php';
            $controller = new FrontController();
            $controller->$page(); // مثل login(), register(), dashboard()
            break;
        
    case 'home':
    case 'about':
        require_once __DIR__ . '/controllers/FrontController.php';
        $controller = new FrontController();
        $controller->$page(); // صدا زدن متد با نام صفحه
        break;

    default:
        require_once __DIR__ . '/../views/404.php';
        break;
    case 'logout':
            session_start();
            session_unset();
            session_destroy();
            header("Location: /webproject/login");
            break;
    case 'add_post':
                require_once 'controllers/FrontController.php';
                $controller = new FrontController();
                $controller->add_post();
                break;
    case 'delete_post':
                require_once 'controllers/FrontController.php';
                $controller = new FrontController();
                 $controller->delete_post();
                break;
    case 'edit_post':
                require_once 'controllers/FrontController.php';
                $controller = new FrontController();
                $controller->edit_post();
                break;
                
        
}
