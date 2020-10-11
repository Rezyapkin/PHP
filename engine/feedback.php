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
    return getAssocResult($sql);
}    

function doFeedbackAction($action, $id, &$params) {
switch ($action) {
    case 'add':
        if (addFeedBack()) {
             header("Location: /feedback?message=OK");
        } else {
            header("Location: /feedback?message=ERROR");
        }    
        break;

    case 'save':
        if (updateFeedBack($id)) {
            header("Location: /feedback?message=EDIT");
        } else {
            header("Location: /feedback?message=ERROR");
        }
        break;

    case 'delete':
        if (deleteFeedBack($id)) {
            header("Location: /feedback?message=DELETE");
        } else {
            header("Location: /feedback?message=ERROR");
        }
        break;    

    case 'edit':
        $result = getFeedBackById($id);
        if ($result) {
            $params['fb_name'] = $result[0]['name'];
            $params['fb_message'] = $result[0]['feedback'];
            $params['button'] = 'Изменить';
            $params['action'] = 'save/' . $id;
            
        } else {
            header("Location: /feedback");
        }
        break;

    }

}