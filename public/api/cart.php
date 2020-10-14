<?php


function doActionCart($method) {

    $errors_cart_messages = [
        'getItems' => 'Ошибка получения товаров из корзины',
        'addItem' => 'Ошибка добавления товара в корзину',
        'deleteItem' => 'Ошибка удаления товара из корзины',
        'editItem' => 'Ошибка изменения товара в корзине',
        'getTotal' => 'Ошибка получения итоговых значений корзины',
   ];
   
   $actions_cart_messages = [
       'addItem' => 'add',
       'deleteItem' => 'delete',
       'editItem' => 'edit',
   ];

    //API работает как c GET, так и с POST
    $params['action'] = $actions_cart_messages[$method];
    $params['cart_id'] = (int)$_REQUEST['cart_id'];
    $params['product_id'] = (int)$_REQUEST['product_id'];
    $params['quatntity'] = (int)$_REQUEST['quatntity'];

    switch ($method) {
        case 'getItems':
            $result = getCartItems($params);  
            $finish = 1;
            break;

        case 'addItem':
            $result = addCartItem($params);    
            break;

        case 'deleteItem':
            $result = deleteCartItem($params); 
            break;

        case 'editItem':
            $result = editCartItem($params); 
            break;
    
        case 'getTotal':
            $response = ['result' => getTotalCart($params)];
            break;
    
        default:
            $response = ['error' => "Метод {$method} API не найден. Ознакомьтесь с документацией к API Cart."];     
    }

    if ($result) {
        $response = ['result' => $result];
        
        if (!$finish) {
            $response = ['action' => $params['action'],
                         'id' => $params['cart_id'],
                         'result' => getCartItemByCartId($params['cart_id']),
                        ];    
       };

    } else if (!$response) {
        $response = ['error' => $errors_cart_messages[$method]];
    }

    echo json_encode($response); 
}

doActionCart(URI_AR[3]);