<?php
//Точка входа в приложение, сюда мы попадаем каждый раз когда загружаем страницу

//Первым делом подключим файл с константами настроек
//TODO Сделать пути абсолютными
include "../config/config.php";

//Читаем параметр page из url, чтобы определить, какую страницу-шаблон
//хочет увидеть пользователь, по умолчанию это будет index

$url_array = explode('/', $_SERVER['REQUEST_URI']);

if (is_numeric($url_array[2])) {
    $id = (int)$url_array[2];
} else {

    $id = (int)$url_array[3];
}

if ($url_array[1] == "") {
    $page = 'index';
} else {
    $page = explode('?', $url_array[1])[0];
}

$params = prepareVariables($page, $action, $id);

echo render($page, $params);
