<?php

/*
Стукрутра меню:
[
    [title: название пункта меню, url: гиперсслыка, items (опционально): 
        [массив подменю]]
    ...
]
*/

function print_list($list) {
    echo '<ul>';
    foreach($list as $list_item) {
        echo '<li>';
        if ($list_item['url']) {
            echo "<a href='{$list_item['url']}'>{$list_item['title']}</a>";
        } else {
            echo $list_item['title'];
        }    
        if (array_key_exists('items', $list_item) && is_array($list_item['items']))
            print_list($list_item['items']);
        echo '</li>';
    }
    echo "</ul>";
} 

print_list($menu_list);