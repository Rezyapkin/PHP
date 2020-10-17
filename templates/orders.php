<?php if($error): ?>
    <h2><?=$error?></h2>
<?php else: ?>
    <h2>Перечень заказов</h2>
    <table cellspacing="0">
        <tr>
            <th>Дата/время</td>
            <th>№ заказа</th>
            <th>Сумма</th>
            <th>Статус</th>
        </tr>        
        <?php foreach($order_items as $item): ?>
            <tr>
                <td><a href="/order/<?=$item['u_id']?>"><?=$item['date']?></a></td>
                <td><?=$item['id']?></td>
                <td><?=$item['total']?> &#8381;</td>
                <td><?=$item['status']?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>    