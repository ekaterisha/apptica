<?php namespace apptica\apptica\Models;
use apptica\my_framework\Connect;

    class PreparedDataModel {
        public static function replaceData($result_queries) {

            $query = 'REPLACE INTO `apptica`.`prepared_data`(`date`, `category`, `position`) VALUES ' . implode(',', $result_queries);

            Connect::dbmass($query);
            return Connect::$error;
        }

        public static function receivingData($date) {

            $query = 'SELECT `category`,   `position` FROM `apptica`.`prepared_data` WHERE `DATE` = '.$date;
            return Connect::dbmass($query);

        }

    }
?>
