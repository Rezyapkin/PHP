<?php


define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("TEMPLATES_DIR", ROOT . "/../templates/");
define("LAYOUTS_DIR", "layouts/");
define("ENGINE_DIR", ROOT . "/../engine/");
define("PRODUCT_IMG_DIR", ROOT . "/images/products/");
define("URI", explode('?',$_SERVER['REQUEST_URI'])[0]);
define("URI_AR",  explode('/',URI));

/* DB config */
define('HOST', 'localhost');
define('USER', 'test');
define('PASS', '12345');
define('DB', 'geekbrains');


