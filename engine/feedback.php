<?php

function getAllFeedback() {
    $sql = "SELECT * FROM feedback ORDER BY id DESC";
    return getAssocResult($sql);
}

function addFeedBack() {
    $name = mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['name'])));
    $feedback = mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['feedback'])));   
    if ($name && $feedback) {
    $sql = "INSERT INTO feedback (name, feedback) VALUES ('{$name}', '{$feedback}')";
    return executeSql($sql);
    } else return false;
}

function updateFeedBack($id) {
    $name = mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['name'])));
    $feedback = mysqli_real_escape_string(getDb(), (string)htmlspecialchars(strip_tags($_POST['feedback'])));   
    if ($name && $feedback) {
    $sql = "UPDATE feedback SET name='{$name}', feedback='{$feedback}' WHERE id='{$id}'";
    return executeSql($sql);
    } else return false;
}

function deleteFeedBack($id) {
    $sql = "DELETE FROM feedback WHERE id='{$id}'";
    return executeSql($sql);
}

function getFeedBackById($id) {
    $sql = "SELECT * FROM feedback WHERE id ='{$id}'";
    return getAssocResult($sql)[0];
}    

function doFeedbackAction($action, $id) {
switch ($action) {
    case 'add':
        return addFeedBack();
        break;

    case 'save':
        return updateFeedBack($id);
        break;

    case 'delete':
        return deleteFeedBack($id);
        break;    

    case 'get':
        return getFeedBackById($id);
        break;

    }
}