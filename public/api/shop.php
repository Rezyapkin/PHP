<?php

if (!is_admin()) {
    $response = ['error' => "Доступ к методу запрещен."];
} else {
    switch(URI_AR[3]) {
        case 'changeStatus':
            $status = getProtectStr($_POST['status']);
            $u_id = getProtectStr($_POST['u_id']);
            $result = changeStatus($u_id, $status);
            if ($result) {
                $response['result'] = 'OK';
            } else {
                $response = ['error' => "Не удалось изменить статус заказа!"];  
            }
            break;
        default:
            $response = ['error' => "Метод {$method} API не найден. Ознакомьтесь с документацией к API Shop."];     
    };
};        

echo json_encode($response); 