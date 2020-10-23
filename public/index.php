<?php
//Точка входа в приложение, сюда мы попадаем каждый раз когда загружаем страницу

//Первым делом подключим файл с константами настроек
//TODO Сделать пути абсолютными

session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
include ROOT . "/../engine/lib_autoload.php";
define("URI", explode('?',$_SERVER['REQUEST_URI'])[0]);
define("URI_AR",  explode('/',URI));

//Читаем параметр page из url, чтобы определить, какую страницу-шаблон
//хочет увидеть пользователь, по умолчанию это будет index


if (is_numeric(URI_AR[2])) {
    $id = (int)URI_AR[2];
} else  {
    $id = (int)URI_AR[3];
}

if (URI_AR[1] == "") {
    $page = 'index';
} else {
    $page = URI_AR[1];
}

$params = prepareVariables($page, $action, $id);

echo render($page, $params);


