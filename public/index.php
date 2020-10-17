<?php
//Точка входа в приложение, сюда мы попадаем каждый раз когда загружаем страницу

//Первым делом подключим файл с константами настроек
//TODO Сделать пути абсолютными

session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
include ROOT . "/../engine/lib_autoload.php";

//Читаем параметр page из url, чтобы определить, какую страницу-шаблон
//хочет увидеть пользователь, по умолчанию это будет index

$url_array = explode('/', explode('?',$_SERVER['REQUEST_URI'])[0]); //Видеоизменил для работы с GET параметрами

if (is_numeric($url_array[2])) {
    $id = (int)$url_array[2];
} else  {
    $id = (int)$url_array[3];
}

if ($url_array[1] == "") {
    $page = 'index';
} else {
    $page = $url_array[1];
}

$params = prepareVariables($page, $action, $id);

echo render($page, $params);


