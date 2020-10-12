<?php

include $_SERVER['DOCUMENT_ROOT'] . '/../config/config.php';

//По заданию было сказано, что нужно заменить отзывами к товарам. Предлагаю сделать универсальный API, который будет работать и с общими отзывами и с отзывами товаров


if ($_POST) {

    $action = $_POST['action'];
    $type = ($typesFeedback[$_POST['type']]) ? $_POST['type'] : 'site';
    $c_id = isset($_POST['c_id']) ? (int)$_POST['c_id'] : null;

    $id = (int)$_POST['id'];
    $result = doFeedbackAction($action, $id, $type, $c_id);
    if ($result) {
        $response = ['result'=> $result];

        switch ($action) {
            case 'add':
                $response['message'] = "Отзыв опубликован";
                break;
        
            case 'save':
                $response['message'] = "Отзыв изменен";
                break;
        
            case 'delete':
                $response['message'] = "Отзыв удален";
                break;    

            }   

        echo json_encode($response);        
    } else {
        $response = ['error' => 'Операция не выполнена'];
        echo json_encode($response);            
    }

} else {
    $type = $_GET['type'];
    $c_id = $_GET['c_id'];    
    $response['result'] = getAllFeedback(($typesFeedback[$type]) ? $type : 'site', $c_id);   
	echo json_encode($response);
}