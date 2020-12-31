<?php namespace apptica\my_framework;

class Connect {
    protected static $mysqli;
    public static $error;

    protected static function mysqli($mysql_statement){
        if (!isset(self::$mysqli)){
            self::$mysqli = new \mysqli("127.0.0.1", "root");
            self::$mysqli->set_charset("utf8");
        }
        $mysqli = self::$mysqli;
        if (!$mysqli->connect_errno) {
            $result = $mysqli->query($mysql_statement);
            if ($result and !is_bool($result)) {
                $arr = array();
                while ($row = $result->fetch_assoc()){
                    $arr[] = $row;
                }
                $result->close();
                $mysqli->next_result();
                self::$error = 0;
                return $arr;
            } else {
                self::$error = 1;
                exit;
            }
        } else {
            self::$error = 1;
            // echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            exit;
        }
    }

    public static function dbmass($mysql_statement){
        return self::mysqli($mysql_statement);
    }
}

?>