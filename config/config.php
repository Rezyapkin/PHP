<?php

$error_messages = [
    'OK' => 'Сообщение добавлено',
    'DELETE' => 'Сообщение удалено',
    'EDIT' => 'Сообщение изменено',
    'ERROR' => 'Ошибка'
];

define("TEMPLATES_DIR", "../templates/");
define("LAYOUTS_DIR", "layouts/");

/* DB config */
define('HOST', 'localhost');
define('USER', 'test');
define('PASS', '12345');
define('DB', 'geekbrains');

include "../engine/db.php";
include "../engine/log.php";
include "../engine/gallery.php";
include "../engine/news.php";
include "../engine/feedback.php";
include "../engine/functions.php";