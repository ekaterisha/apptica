<?php namespace apptica\apptica\Controllers;
use apptica\apptica\Models\PreparedDataModel;

    class AppTopCategoryController {

        public function getData(){

        // Пункт 1. Сбор и сохранение prepared данных для endpoint-а

            if (!empty($_GET)) {

                //оригинальная ссылка из постановки
                //$curl = 'https://api.apptica.com/package/top_history/1421444/1?date_from=2020-12-20&date_to=2020-12-22&B4NKGg=fVN5Q9KVOlOHDx9mOsKPAQsFBlEhBOwguLkNEDTZvKzJzT3l';

                //запрос к endpoint apptica по url
                //$curl = $_GET['url'];

                //запрос к endpoint apptica по переменным
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
                $error = PreparedDataModel::replaceData($result_queries);


                header('Content-type:application/json;charset=utf-8');
                http_response_code(200);

                if (!$error) {
                    echo json_encode(array('status_code' => 200, 'message' => 'ok, data received'));
                } else {
                    echo json_encode(array('status_code' => 200, 'message' => 'not ok, error'));
                }

            }
        // Пункт 1. Сбор и сохранение prepared данных для endpoint-а
        }

        public function AppTopCategory() {

        // Пункт 2. Endpoint для получения позиций в топ чарте маркета по категориям

            $date = '"'.$_GET['date'].'"';
            $topCat = PreparedDataModel::receivingData($date);

            $AppTopCat = [];

            foreach ($topCat as $item) {
                $AppTopCat[$item['category']] = $item['position'];
            }

            header('Content-type:application/json;charset=utf-8');
            http_response_code(200);
            echo json_encode(array('status_code' => 200,
                                    'message' => 'ok',
                                    'data' => $AppTopCat
                                    )
            );

        // Пункт 2. Endpoint для получения позиций в топ чарте маркета по категориям

        }
    }
?>