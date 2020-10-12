<?php


//Для каждой страницы готовим массив со своим набором переменных
//для подстановки их в соотвествующий шаблон
function prepareVariables(&$page, $action='', $id=0)
{
    $params = [];
    $params['layout'] = 'main';

    switch ($page) {
        case 'index':
            $params['name'] = 'admin';
            break;

        case 'feedback':
            global $error_messages;
            $params['message'] = $error_messages[$_GET['message']];
            $params['action'] = 'add';
            $params['button'] = 'Отправить';

            doFeedbackAction($action, $id, $params);

            $params['feedback'] = getAllFeedback();

            break;

        case 'gallery':
            if ($_POST) {
                uploadFile();
            }

            $params['gallery'] = getGallery();
            break;

        case 'news':
            if ($id > 0) {
                $params['news'] = getOneNews($id);
                if ($params['news']) {
                    $page = 'newsOne';
                    break;  
                }              
            }
            $params['news'] = getNews();
            break;

        case 'catalog':
            if ($id > 0) {
                $params['product'] = getProductById($id);
                if ($params['product']) {
                    $page = 'catalogOne';
                    $params['feedback'] = renderTemplate('feedback',['id' => $id, 'type' => 'product']);
                    break;  
                }              
            } 
            $params['catalog'] = getProducts();
            break;    

        default:
            header('HTTP/1.0 404 Not Found');
            header('Status: 404 Not Found');
            $page = '404';

    }
    return $params;
}

//Функция, возвращает текст шаблона $page с подстановкой переменных
//из массива $params, содержимое шабона $page подставляется в
//переменную $content главного шаблона layout для всех страниц
function render($page, array $params = [])
{
    return renderTemplate(LAYOUTS_DIR . $params['layout'], [
        'menu' => renderTemplate('menu', $params),
        'content' => renderTemplate($page, $params)
    ]);
}


//Функция возвращает текст шаблона $page с подставленными переменными из
//массива $params, просто текст
function renderTemplate($page, array $param = [])
{
    ob_start();
    //params
    //[
    // 'menu' => '<a>...
    // 'content' => 'Добро пожало
    //]
    // foreach ($params as $key => $value) {
    //     $$key = $value;
    // }
    if (!is_null($param)) {
        extract($param);
    }


    $fileName = TEMPLATES_DIR . $page . ".php";


    if (file_exists($fileName)) {
        include $fileName;
    } else {
        Die("Страницы {$fileName} не существует.");
    }


    return ob_get_clean();
}