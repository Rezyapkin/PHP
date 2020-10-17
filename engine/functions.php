<?php


function prepareAuth($page, &$params) {

    $params['auth'] = false;

    if (isset($_GET['logout'])) {
        logout();
        if ($page == "profile") {
            //Если разлогинились из профиля - отправляем на страницу авторизации
            header('Location: /login');
        } else {    
            header('Location: '. URI); 
        }
        Die();
    }
    
    if (is_auth()) {
        $params['auth'] = true;
        $params['user_login'] = $_SESSION['login'];
        $params['user_name'] = $_SESSION['user_name'];
        $params['user_id'] = $_SESSION['user_id'];
        $params['is_admin'] = is_admin();
    } 
    
}

//Для каждой страницы готовим массив со своим набором переменных
//для подстановки их в соотвествующий шаблон
function prepareVariables(&$page, $action='', $id=0)
{
    $params = [];
    prepareAuth($page, $params);

    $params['count_in_cart'] = (int)getTotalCart($params)['count'];
    $params['layout'] = 'main';

    switch ($page) {
        case 'index':
            $params['auth_form'] = renderTemplate('auth', $params);
            break;
        
        case 'api':
            $api = URI_AR[2];
            $fileName = ROOT . "/api/{$api}.php";
            if (file_exists($fileName)) {
                include $fileName;
                Die();
            } else {
                header('HTTP/1.0 404 Not Found');
                header('Status: 404 Not Found');
                Die("API {$api} не существует.");
            }            
            break;
 
        case 'admin':
            if ($params['is_admin']) {
                $result = getOrders();
            }
                
            if ($result) {
                $params['order_items'] = $result;
                $params['orders'] = renderTemplate('orders', $params);
            } else {
                $params['error'] = 'Доступ запрещен!';    
            }    
            break;    
        case 'login':
            $page = 'auth';
            if ($_POST) {
                authInForm();
                if (!is_auth()) {
                } else {
                     $params['message'] = 'Не верная пара логин/пароль!'; 
                }  
            }   
            
            if (is_auth()) {
                header('Location: /');
                Die();
            }

            break;            

        case 'register': 
            if (!$_POST) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);  
            } else {
                $page = 'auth';

                if (!$_POST['current-password']) {
                    $params['message2'] = 'Пользователь не создан, т.к. поле пароль не заполнено';
                    break;
                }
                
                if (isLoginExist($_POST['login'])) {
                    $params['message2'] = "Пользователь с логином '{$_POST['login']}' существует";
                    break;                   
                }

                $result = registerUser();
                
                if ($result) {
                    $params['message2'] = "Пользователь {$_POST['login']} успешно создан! Вы можете авторизоваться.";                    
                } else {
                    $params['message2'] = 'Пользователь не был зарегистирован. Повторите попытку';
                }
                
            };
            break;    
        case 'makeOrder':
            if (!$_POST) {
                header('Location: /cart'); 
                Die(); 
            };
            $result = makeOrder($params);
            break;
        
        case 'order': 
            $result = getOrderParamsByUid(URI_AR[2]);
            if ($result) {
                $params['u_id'] = URI_AR[2];
                $params = array_merge($params, $result);
            } else {
                $params['error'] = 'Неверный ID';
            }
            break;

        case 'feedback':
            doFeedbackAction($action, $id, $params);
            $params['feedback'] = getAllFeedback();
            break;

        case 'profile':
            if (!$params['auth'] ) {
                $page = 'access_denied';
                $params['auth_form'] = renderTemplate('auth', $params);
            break;
            }

            if ($_POST['current-password']) {
                $lp = checkLoginPassword($params['user_login'], $_POST['current-password']);
                if (!$lp) {
                    $params['message'] = 'Не верная пара логин/пароль!';
                    break;
                }

                if (updateProfile()) {
                    $params['message'] = 'Данные вашего пофиля были успешно изменены.';
                    $params['no_error'] = '_disable';
                } else {
                    $params['message'] = 'Ошибка. Данные в профиле сохранены не были.';
                };
            }; 

            $result = getOrders();
            if ($result) {
                $params['order_items'] = $result;
                $params['orders'] = renderTemplate('orders', $params);      
            }
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
            
        case 'cart':
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