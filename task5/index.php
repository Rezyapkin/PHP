<?
$about = renderTemplate('about','Привет мир!');
$menu = renderTemplate('menu');

echo renderTemplate('main', $about, $menu);

function renderTemplate($page, $content = "", $menu = "") {
    ob_start();
    $filename = $page . ".php";
    if (file_exists($filename)) {
        include $page . ".php";
    }
    return ob_get_clean();
}
