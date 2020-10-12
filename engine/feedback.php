<?php

// тип отзывов => таблица, которая хранит отзывов
$typesFeedback = [
    'site' => 'feedback',
    'product' => 'feedback_product',
];

//Решил сделать универсальные фукнции, получилось сложно наверно

function getTableFeedBack($type) {
    global $typesFeedback;    
    return $typesFeedback[$type];
}

function getAllFeedback($type = 'site', $c_id = null) {
    $table = getTableFeedBack($type);
    $sql = "SELECT * FROM {$table} " . ((is_null($c_id)) ? "" : " WHERE {$type}_id='{$c_id}' " ) . " ORDER BY id DESC";
    return getAssocResult($sql);
}

/*
$params = [
    'id' => ID отзыва,
    'type' => Тип таблицы с отзывами,
    'name' => Автор,
    'feedback' => Сообщение,
    'c_id' => к какому элементу таблицы оставлен отзыв
];
*/
function addFeedBack($params) {
    $type = getTableFeedBack($params['type']);
    if ($params['name'] && $params['feedback']) {

        if (isset($params['c_id'])) {
            $sql = "INSERT INTO {$type} (name, feedback) VALUES ('{$params["name"]}', '{$params["feedback"]}')";
        } else {
            $sql = "INSERT INTO {$type} (name, feedback, {$params['type']}_id) 
                VALUES ('{$params["name"]}', '{$params["feedback"]}', '{$params["c_id"]}')";
        };
        return executeSql($sql);
    } else return false;
}

function updateFeedBack($params) {
    $type = getTableFeedBack($params['type']);
    if ($params['name'] && $params['feedback']) {
        $sql = "UPDATE {$type} SET name='{$params["name"]}', feedback='{$params["feedback"]}' WHERE id='{$params["id"]}'";
        return executeSql($sql);
    } else {
        return false;
    };
}

function deleteFeedBack($params) {
    $type = getTableFeedBack($params['type']);
    $sql = "DELETE FROM {$type} WHERE id='{$params["id"]}'";
    return executeSql($sql);
}

function getFeedBackById($params) {
    $type = getTableFeedBack($params['type']);
    $sql = "SELECT * FROM {$type} WHERE id='{$params["id"]}'";
    return getAssocResult($sql)[0];
}

function doFeedbackAction($action, $params) {
    switch ($action) {
        case 'add':
            return addFeedBack($params);
            break;
    
        case 'save':
            return updateFeedBack($params);
            break;
    
        case 'delete':
            return deleteFeedBack($params);
            break;    
    
        case 'get':
            return getFeedBackById($params);
            break;

        default:
            return false;    
    
    }
}