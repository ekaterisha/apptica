<?php namespace apptica;
use apptica\my_framework\Router;
use apptica\my_framework\Connect;

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

    // Пункт 1. Сбор и сохранение prepared данных для endpoint-а

    //оригинальная ссылка из постановки
    //$url = 'https://api.apptica.com/package/top_history/1421444/1?date_from=2020-12-20&date_to=2020-12-22&B4NKGg=fVN5Q9KVOlOHDx9mOsKPAQsFBlEhBOwguLkNEDTZvKzJzT3l';
    //запрос к endpoint
    //http://apptica/index.php?applicationId=1421444&countryId=1&date_from=2020-12-20&date_to=2020-12-22
    $url = 'https://api.apptica.com/package/top_history';
    $applicationId = $_GET['applicationId'];
    $countryId = $_GET['countryId'];
    $dateFrom = $_GET['date_from'];
    $dateTo = $_GET['date_to'];
    $hash_key = 'B4NKGg';
    $hash_value = 'fVN5Q9KVOlOHDx9mOsKPAQsFBlEhBOwguLkNEDTZvKzJzT3l';
    $curl = $url . '/' . $applicationId . '/' . $countryId . '?date_from=' . $dateFrom . '&date_to=' . $dateTo . '&' . $hash_key . '=' . $hash_value;

    $prepared = file_get_contents($curl, false);
    $data = json_decode($prepared, true);


foreach ($data['data'] as $category => $data_arrays){

    $result = array_map('min', call_user_func_array('array_merge_recursive', $data_arrays));
    $str =
        implode(',',
            array_map(
                function ($k, $v) use($category) {
                    return '("'.$k.'",'.$category.','.$v.')';
                },
                array_keys($result),
                array_values($result)
            )
        )
    ;
    $result_queries[] = $str;

}

$query = 'REPLACE INTO `apptica`.`prepared_data`(`date`, `category`, `position`) VALUES ' . implode(',', $result_queries);
// vardump($query);

Connect::dbmass($query);
// vardump($query);
// die();


header('Content-type:application/json;charset=utf-8');
http_response_code(200);
echo json_encode(array('status_code' => 200, "message" => 'ok, data received'));
    // Пункт 1. Сбор и сохранение prepared данных для endpoint-а

    // Пункт 2. Endpoint для получения позиций в топ чарте маркета по категориям
    //$date = $_GET['date'];
    // Пункт 2. Endpoint для получения позиций в топ чарте маркета по категориям

// Router::run();

?>