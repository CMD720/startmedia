<?php
require_once 'classes/RaceResultClass.php';

function combine_results_races($array)
{
    $result_arr = [];
    $countAtt = count($array);
    $i = 0;

    while ($i < $countAtt) {
        $temp = [];
        $temp['id'] = $array[$i]['id'];
        foreach ($array as $k => $v) {
            if ($array[$i]['id'] == $v['id']) {
                $temp[] = $v['result'];
            }
            if ($k == $countAtt - 1) {
                $result_arr[] = $temp;
            }
        }
        $i++;
    }
    return $result_arr;
}

function array_unique_custom($array, $key)
{
    $temp_array = [];
    $key_array = [];

    foreach ($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[] = $val[$key];
            $temp_array[] = $val;
        }
    }
    return $temp_array;
}

function create_race_result_class ($object_car, $result_arr) {
    $race_result_arr = [];
    foreach ($object_car as $key => $value){
        $temp_att = [];
        foreach ($result_arr as $key_att => $value_att){
            if($value->id == $value_att['id']){
                for($i=0; $i<count($value_att)-1; $i++){
                    $temp_att[] = $value_att[$i];
                }
            }
        }
        $race_result_arr[] = new RaceResultClass($value->id, $value->name, $value->city, $value->car, $key, $temp_att);
    }
    unset($value);

    return $race_result_arr;
}

function get_race_data () {
    $cars_data = file_get_contents("data_cars.json");
    $attempts_data = file_get_contents("data_attempts.json");
    $object_car = json_decode($cars_data);
    $att_array = json_decode($attempts_data, true);

    $result_arr = array_unique_custom(combine_results_races($att_array),'id');
    $race_resut_data = create_race_result_class($object_car, $result_arr);

    return $race_resut_data;
}

function sort_object_by($object_for_sort, $sort_by){
    usort($object_for_sort, function($object1,$object2) use ($sort_by){
        if($object1->$sort_by == $object2->$sort_by) return 0;
        return ($object1->$sort_by > $object2->$sort_by) ? -1 : 1;});

    return $object_for_sort;
}
function sort_object_by_attempts($object_for_sort, $sort_by, $attempt_nmb){
    usort($object_for_sort, function($object1,$object2) use ($sort_by, $attempt_nmb){
        if($object1->$sort_by($attempt_nmb) == $object2->$sort_by($attempt_nmb)) return 0;
        return ($object1->$sort_by($attempt_nmb) > $object2->$sort_by($attempt_nmb)) ? -1 : 1;});

    return $object_for_sort;
}
