<?php namespace apptica;
use apptica\my_framework\Router;

$loader_path = __DIR__ . DIRECTORY_SEPARATOR . 'my_framework' . DIRECTORY_SEPARATOR . 'Loader.php';
include_once ($loader_path);
spl_autoload_register(__NAMESPACE__.'\my_framework\Loader::load_class');

set_time_limit(0);
ini_set('memory_limit', '2048M');
ini_set('display_errors', 1);

    function vardump($var) {
        echo '<pre>';
            var_dump($var);
        echo '</pre>';
        die();
    }

Router::run();

?>