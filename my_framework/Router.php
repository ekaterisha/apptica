<?php namespace apptica\my_framework;

class Router {

    public static function run() {
        $r = isset($_GET["r"]) ? $_GET["r"] : 'AppTopCategoryController';
        $action = isset($_GET["action"]) ? $_GET["action"] : 'read';

        $name_controller = __NAMESPACE__.'\Controllers\\'.$r.'Controller';
        $controller = new $name_controller;
        $controller->$action();

    }
}


?>