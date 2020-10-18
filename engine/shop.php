<?php

//
function newOrderfromCart($params=[]) {
    $u_id = uniqid(rand(), true); 
    $user_id = (int)$_SESSION['user_id'];
    $session_id = session_id();
    $db = GetDb();
    mysqli_begin_transaction($db);
    $sqls = [];
    $sqls[] = "INSERT INTO orders(user_id, name, phone, address, u_id) 
        VALUES ('{$user_id}', '{$params['name']}', '{$params['phone']}', '{$params['address']}', '{$u_id}')";
        
    $sqls[] = "INSERT INTO order_items(order_id, product_id, quantity, price) 
        SELECT (SELECT id from orders WHERE u_id='{$u_id}'), product_id, quantity, price FROM cart 
        JOIN products on product_id = products.id WHERE quantity > 0 AND (session_id = '{$session_id}' " . 
        ((isset($params['user_id'])) ? "OR user_id = {$params['user_id']} " : "")  
        . ") ORDER BY cart.id";

    
    $sqls[] = "DELETE FROM cart WHERE session_id = '{$session_id}' " . ((isset($params['user_id'])) ? " OR user_id = {$params['user_id']} " : "");
    
    foreach ($sqls as $sql) {
        $result = executeSql($sql);
        if (!result) {
            break;
        }
    } 

    if ($result) {
        mysqli_commit($db);
        $result = getAssocResult("SELECT id, date, u_id FROM orders WHERE u_id='{$u_id}'")[0];
    } else {
        mysqli_rollback($db);        
    }   
    return $result;
}

function makeOrder(&$params = [])
{
    $params_api['name'] = getProtectStr($_POST['name']);
    $params_api['phone'] = preg_replace("/[^0-9]/", '', $_POST['phone']);
    $params_api['address'] = getProtectStr($_POST['address']);
    $result = false;

    $no_fill = [];
    foreach ($params_api as $key => $value) {
        if (!$value) {
            $no_fill[] = $key;
        }
    }    
    if (count($no_fill) > 0) {
        $params['error'] = (count($no_fill) == 1) ? "Поле {$no_fill[0]} не заполнено" : ("Следующие поля не заполнены: " . implode(', ',$no_fill));
    }

    $result = newOrderfromCart($params_api);
    if ($result) {
        $params = array_merge($params, $result);    
        $params['count_in_cart'] = 0;   
    } else {
        $params['error'] = "К сожалению, заказ не был создан. Повторите попытку.";
    };

    return $result;
   
}

function getOrderStatuses() {
    $res = [];
    $sql = "SHOW COLUMNS FROM orders LIKE 'status'";
    $result = getAssocResult($sql);
    if ($result) {
        preg_match('#^enum\((.*?)\)$#ism', $result[0]['Type'], $matches);
        $res = str_getcsv($matches[1], ",", "'");
    }   
    return $res;
}

function getOrderParamsByUid($uid) {
    $par = [];
    $uid = getProtectStr($uid); 
    $sql = "SELECT orders.id, date, status, name, address, phone, SUM(order_items.quantity * order_items.price) as total FROM orders 
        JOIN order_items ON orders.id=order_items.order_id 
        WHERE u_id='{$uid}' 
        GROUP BY orders.id, date, status, name, address, phone";
    $par = getAssocResult($sql)[0];
    if ($par) {
        $sql = "SELECT product_id as id, products.name, order_items.quantity, order_items.price, order_items.quantity * order_items.price as total FROM order_items 
            JOIN products ON product_id=products.id WHERE order_id='{$par['id']}'";
        $result = getAssocResult($sql);  
        if (!$result) {
            return false;
        }
        $par['items'] = $result;
        $par['statuses'] = getOrderStatuses();  
    }
    return $par;
}

function changeStatus($u_id, $status) {
    if (!is_admin()) {
        return false;
    }    
    $sql = "UPDATE orders SET status='{$status}' WHERE u_id='{$u_id}'";
    return executeSql($sql);
}

function getOrders($only_user_orders = true, $count = 20) {
    $is_admin = is_admin();
    if (!is_auth() || !is_admin) {
        return false;
    }    
    $user_id = (int)$_SESSION['user_id'];

    $sql = "SELECT orders.u_id, orders.id, date, status, SUM(order_items.quantity * order_items.price) as total FROM orders 
        JOIN order_items ON orders.id=order_items.order_id " . 
        ((!$is_admin || $only_user_orders) ? " WHERE (NOT user_id = '0') AND user_id='{$user_id}' " : "")
        . "GROUP BY orders.u_id, orders.id, date, status
        ORDER BY date DESC LIMIT {$count}";

    return getAssocResult($sql); 
}
