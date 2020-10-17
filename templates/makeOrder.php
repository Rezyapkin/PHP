<?php if($id && $date): ?>
     <h2>Заказ №<?=$id?> успешно оформлен <?=$date?>.</h2>
     <p>Ожидайте, с вами свяжется наш менеджер!</p>
     <p>Вы можете отслеживать статус заказа по <a href="/order/<?=$u_id?>">ссылке</a>.</p>
     <br>
     <p><a href="/catalog" class="black-button">Продолжить покупки</a></p>
<?php else: ?>
    <h2><?=$error?></h2>         
    <br>
    <p><a href="/cart" class="black-button">Вернуться в корзину</a></p>
<?php endif; ?>    