<?php


$errors_cart_messages = [
    'getItems' => 'Ошибка получения товаров из корзины',
    'addItem' => 'Ошибка добавления товара в корзину',
    'deleteItem' => 'Ошибка удаления товара из корзины',
    'editItem' => 'Ошибка изменения товара в корзине',
    'subItem' => 'Ошибка уменьшения количества товара в корзине',
    'getTotal' => 'Ошибка получения итоговых значений корзины',
];
   

//API работает как c GET, так и с POST
$params['action'] = $actions_cart_messages[$method];
$params['cart_id'] = (int)$_REQUEST['cart_id'];
$params['product_id'] = (int)$_REQUEST['product_id'];
$params['quantity'] = (int)$_REQUEST['quantity'];
if ($params['quantity'] == 0) {
    $params['quantity'] = 1;
}

switch (URI_AR[3]) {
    case 'getItems': 
        $response = ['result' => getCartItems($params)];
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

    case 'subItem':
        $params['quantity'] = - $params['quantity'];
        $result = addCartItem($params); 
        break;    

    case 'getTotal':
        $response = ['result' => getTotalCart($params)];
        break;
    
    default:
        $response = ['error' => "Метод {$method} API не найден. Ознакомьтесь с документацией к API Cart."];     
}

if ($result) {
    $response = [
        'result' => [
            'id' => $params['cart_id'],
            'total' => getTotalCart($params),
            'current_item' => getCartItemByCartId($params['cart_id']),
        ],
    ];    

    } else if (!$response) {
        $response = ['error' => $errors_cart_messages[$method]];
    }

    echo json_encode($response); 
