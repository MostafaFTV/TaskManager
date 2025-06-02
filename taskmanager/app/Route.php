<?php

class Route
{
    public function handleRequest()
    {
        $url = isset($_GET['url']) ? explode('/', $_GET['url']) : ['task', 'index'];

        $controllerName = ucfirst($url[0]) . 'Controller';
        $methodName = isset($url[1]) ? $url[1] : 'index';

        $controllerFile = 'app/controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                    return;
                }
            }
        }

        // صفحه 404
        http_response_code(404);
        echo "<h1>404 - صفحه مورد نظر پیدا نشد</h1>";
    }
}
