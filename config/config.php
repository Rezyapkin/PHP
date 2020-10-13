<?php


define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("TEMPLATES_DIR", ROOT . "/../templates/");
define("LAYOUTS_DIR", "layouts/");
define("PRODUCT_IMG_DIR", ROOT . "/images/products/");


/* DB config */
define('HOST', 'localhost');
define('USER', 'test');
define('PASS', '12345');
define('DB', 'geekbrains');

include ROOT . "/../engine/db.php";
include ROOT . "/../engine/log.php";
include ROOT . "/../engine/gallery.php";
include ROOT . "/../engine/news.php";
include ROOT . "/../engine/catalog.php";
include ROOT . "/../engine/feedback.php";
include ROOT . "/../engine/functions.php";
include ROOT . "/../engine/cart.php";
