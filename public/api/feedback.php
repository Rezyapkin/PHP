<?php

include $_SERVER['DOCUMENT_ROOT'] . '/../config/config.php';

if ($_POST) {
    $action = $_POST['action'];
    $id = (int)$_POST['id'];
    $result = doFeedbackAction($action, $id);
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
    $response['result'] = getAllFeedback();
	echo json_encode($response);
}