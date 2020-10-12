<?php

// тип отзывов => таблица, которая хранит отзывов
$typesFeedback = [
    'site' => 'feedback',
    'product' => 'feedback_product',
];

//Решил сделать универсальные фукнции, получилось сложно наверно

function getAllFeedback($type = 'site', $c_id = null) {
    global $typesFeedback;
    $sql = "SELECT * FROM {$typesFeedback[$type]} " . ((is_null($c_id)) ? "" : " WHERE {$type}_id='{$c_id}' " ) . " ORDER BY id DESC";
    return getAssocResult($sql);
}

function addFeedBack($type = 'site', $c_id = null) {
    global $typesFeedback;
    $name = mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['name'])));
    $feedback = mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['feedback'])));   
    if ($name && $feedback) {
        if (is_null($c_id)) {
            $sql = "INSERT INTO {$typesFeedback[$type]} (name, feedback) VALUES ('{$name}', '{$feedback}')";
        } else {
            $sql = "INSERT INTO {$typesFeedback[$type]} (name, feedback, {$type}_id) VALUES ('{$name}', '{$feedback}', '{$c_id}')";
        };
        return executeSql($sql);
    } else return false;
}

function updateFeedBack($id, $type = 'site') {
    global $typesFeedback;
    $name = mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['name'])));
    $feedback = mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['feedback'])));   
    if ($name && $feedback) {
    $sql = "UPDATE {$typesFeedback[$type]} SET name='{$name}', feedback='{$feedback}' WHERE id='{$id}'";
    return executeSql($sql);
    } else return false;
}

function deleteFeedBack($id, $type = 'site') {
    global $typesFeedback;
    $sql = "DELETE FROM {$typesFeedback[$type]} WHERE id='{$id}'";
    return executeSql($sql);
}

function getFeedBackById($id, $type = 'site') {
    global $typesFeedback;
    $sql = "SELECT * FROM {$typesFeedback[$type]} WHERE id ='{$id}'";
    return getAssocResult($sql)[0];
}    

function doFeedbackAction($action, $id, $type = 'site', $c_id = null) {
switch ($action) {
    case 'add':
        return addFeedBack($type, $c_id);
        break;

    case 'save':
        return updateFeedBack($id, $type);
        break;

    case 'delete':
        return deleteFeedBack($id, $type);
        break;    

    case 'get':
        return getFeedBackById($id, $type);
        break;

    }
}