<?php namespace apptica\my_framework;

class Router {

    public static function run() {
        $controller = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");

        $name_controller = 'apptica\apptica\Controllers\\'.$controller.'Controller';
        $file_path = __DIR__
            .DIRECTORY_SEPARATOR
            .'..'
            .DIRECTORY_SEPARATOR
            .'apptica'
            .DIRECTORY_SEPARATOR
            .'Controllers'
            .DIRECTORY_SEPARATOR
            .ucfirst($controller).'Controller.php';

        if (is_file($file_path)) {
            $controller = new $name_controller;

            $method = $_SERVER["REQUEST_METHOD"];
            switch ($method) {
                case 'GET':
                    $controller->getData();
                    break;
                case 'POST':
                    $controller->putData();
                    break;
                default:
                    $controller->notFound();
                    break;
            }
        }
    }
}


?>