<?php namespace apptica\my_framework;

class Loader {
    public static $root_dir = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;

    public static function load_class($class){
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = self::$root_dir.$class.'.php';
        if (file_exists($file)) {
            include_once($file);
        }
    }
}

?>