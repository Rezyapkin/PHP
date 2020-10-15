<?php

function deleteCookieHash() {
    setcookie('hash', '', time()-3600, '/');    
}

function logout() {
    deleteCookieHash();
    clearDataAuthInSession();
}

function updateDataAuthInSession($login, $name, $id) {
    $_SESSION['login'] = $login;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_id'] = $id;
}

function clearDataAuthInSession() {
    unset($_SESSION['login']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
}

function is_auth() {
    //Если в сессии есть логин, то смысл стучаться к базе?
    if (!isset($_SESSION['login']) && isset($_COOKIE['hash'])) {
        $hash = $_COOKIE['hash'];
        $sql = "SELECT * FROM `users` WHERE `hash`='{$hash}'";
        $row = getAssocResult($sql);
        $user = $row['login'];
        if (!empty($user)) {
            updateDataAuthInSession($user, $row['name'], $row['id']);
        } else {
            //Если куки хэш не подошел, то удалим эту куку
            deleteCookieHash();
 
        };
    }
    return isset($_SESSION['login']);
}

function updateHashUser($user_id, $hash = '') {
    $sql = "UPDATE users SET cookie_hash = '{$hash}' WHERE `users`.`id` = {$user_id}";    
    if (executeSql($sql)) {
        //Если hash пустой, то убиваем куку
        setcookie("hash", $hash, time() + (isset($hash) ? 3600 : -3600), '/');
    }    
}

function authInForm() {
    auth($_REQUEST['login'], $_REQUEST['current-password'], $_REQUEST['save']);    
}

function checkLoginPassword($login, $pass) {
    $login = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($login)));
    $sql = "SELECT * FROM users WHERE login = '{$login}'";
    $row = getAssocResult($sql)[0];
    if (password_verify($pass, $row['password_hash'])) {
        return $row;
    } else NULL;
}

function updateProfile() {
    $login = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['login'])));
    $name = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['name'])));
    if ($_POST['new-password']) {
        $pass =  password_hash(mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['new-password']))), PASSWORD_DEFAULT); 
        $hash = uniqid(rand(), true);     
    }
    $name = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['name'])));

    $sql = "UPDATE users 
        SET
        `name` = '{$name}'"
        . (
            ($_POST['new-password']) ? ", password_hash = '{$pass}', cookie_hash = '{$hash}' " : ""
        ) . 
        " WHERE login = '{$login}'";
    $res = executeSql($sql);
    if ($res && $hash) {
        setcookie("hash", $hash, time() + 3600, '/');
    } 
    return $res;
}

function auth($login, $pass, $save = false) {
    $row = checkLoginPassword($login, $pass);
    if ($row) {
        updateDataAuthInSession($login, $row['name'], $row['id']);
        if ($save) {
            $hash = uniqid(rand(), true);  
            updateHashUser($row['id'], $hash); 
        } else {
            updateHashUser($row['id']);            
        };
        return true;
    }
    return false;
}
