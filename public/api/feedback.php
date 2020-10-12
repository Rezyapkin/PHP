<?php

global $typesFeedback;

$messages = [
    'add' => 'Отзыв опубликован',
    'save' => 'Отзыв изменен',
    'delete' => 'Отзыв удален',        
];

if ($_POST) {
    $action = $_POST['action'];

    $params = [
        'id' => is_null($_POST['id']) ?  null : (int)$_POST['id'],
        'type' => ($typesFeedback[$_POST['type']]) ? $_POST['type'] : 'site',
        'name' => mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['name']))),
        'feedback' => mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['feedback']))),
        'c_id' => isset($_POST['c_id']) ? (int)$_POST['c_id'] : null, //это id элемента к которому оставляются отзывы
    ];
    $result = doFeedbackAction($action, $params);
    if ($result) {
        if ($action == 'add') {
            $params['id'] = mysqli_insert_id(getDb());
        }
        $params['action'] = $action;
        $response = ['result'=> $params];

        if ($messages[$action]) {
            $response['message'] = $messages[$action];    
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