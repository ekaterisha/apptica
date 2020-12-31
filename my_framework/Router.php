<?php namespace apptica\my_framework;

class Router {

    public static function run() {
        $r = isset($_GET["r"]) ? $_GET["r"] : 'AppTopCategory';
        $action = isset($_GET["action"]) ? $_GET["action"] : 'AppTopCategory';

        $name_controller = 'apptica\apptica\Controllers\\'.$r.'Controller';
        $controller = new $name_controller;
        $controller->$action();

    }
}


?>