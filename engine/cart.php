<?php

function getCartItems($params)
{
    $session_id = session_id();
    $sql = "SELECT cart.id as cart_id, product_id, name, quantity, price, quantity * price as total, image FROM cart 
        JOIN products on product_id = products.id WHERE quantity > 0 AND (session_id = '{$session_id}' " . 
        ((isset($params['user_id'])) ? "OR user_id = {$params['user_id']} " : "")  
        . ") ORDER BY cart_id";
    return getAssocResult($sql);
}

function getTotalCart($params) {
    $session_id = session_id();
    $sql = "SELECT SUM(quantity) as count, SUM(quantity * price) as sum FROM cart 
        JOIN products on product_id = products.id WHERE quantity > 0 AND (session_id = '{$session_id}' " . 
        ((isset($params['user_id'])) ? "OR user_id = {$params['user_id']} " : "") . ")";
    $res = getAssocResult($sql);
    return $res[0];    

}

function getCartItemByProductId($id, $user_id = null)
{
    $session_id = session_id();
    $sql = "SELECT cart.id as cart_id, product_id, name, quantity, price, quantity * price as total, image FROM cart 
        JOIN products on product_id = products.id WHERE products.id = '{$id}' AND (session_id = '{$session_id}' " . 
        ((isset($user_id)) ? "OR user_id = '{$user_id}' " : "")  
        . ") ORDER BY cart_id DESC";

    return getAssocResult($sql)[0];
}

function getCartItemByCartId($id, $user_id = null)
{
    $session_id = session_id();
    $sql = "SELECT cart.id as cart_id, product_id, name, quantity, price, quantity * price as total, image FROM cart 
        JOIN products on product_id = products.id WHERE cart.id = '{$id}' AND (session_id = '{$session_id}' " . 
        ((isset($user_id)) ? "OR user_id = '{$user_id}' " : "") . ")"; 
    return getAssocResult($sql)[0];
}

function addCartItem(&$params)
{
    $session_id = session_id();


    if (!$params['quantity']) {
        $params['quantity'] = 1;
    }    

    //Проверим есть ли такой же товар
    if ($params['cart_id']) {
        $product = getCartItemByCartId($params['cart_id'], $params['user_id']); 
    }

    if (!$product) {
        $product = getCartItemByProductId($params['product_id'], $params['user_id']);
        $params['cart_id'] = $product['cart_id'];
    }


    if ($product) {
        $params['quantity'] += $product['quantity'];
        return editCartItem($params);
    } else {
        $sql = "INSERT INTO cart (product_id, quantity, session_id, user_id)
        VALUES ((SELECT id FROM products WHERE id = '{$params['product_id']}'), '{$params['quantity']}', '{$session_id}', '" .
        (isset($params['user_id']) ? $params['user_id'] : 0) . "')";  
    }

    $result = executeSql($sql);

    if ($result && !$product) {
        $params['cart_id'] = mysqli_insert_id(getDb());
    }

    return $result;
}


function editCartItem(&$params)
{
    $session_id = session_id();

    if ($params['quantity'] <= 0) {     
        $result = deleteCartItem($params);
    }

    $sql = "UPDATE cart SET quantity = {$params['quantity']} WHERE (id='{$params['cart_id']}') 
         AND (session_id = '{$session_id}' " . 
         ((isset($params['user_id'])) ? "OR user_id = {$params['user_id']} " : "") . ")";        

    return executeSql($sql);
}   

function deleteCartItem(&$params)
{
    $session_id = session_id();

    $sql = "DELETE FROM cart WHERE (id = '{$params['cart_id']}') 
        AND (session_id = '{$session_id}' " . 
        ((isset($params['user_id'])) ? "OR user_id = {$params['user_id']} " : "")  
        . ") ";        
   
    return executeSql($sql);
}   

