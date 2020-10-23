<?php if($error): ?>
    <h2>Неверная ссылка на заказ!</h2>
    <br>
     <p><a href="/" class="black-button">На главную</a></p>    
<?php else: ?>    
    <h2>Заказ №<?=$id?> от <?=$date?></h2>
    <?php if ($is_admin): ?>
        <p>Заказчик: <b><?=$name?></b></p>
        <p>Адрес: <b><?=$address?></b></p>
        <p>Телефон: <b><a href="tel:+<?=$address?>">+<?=$phone?></a></b></p>
        <form action="" method="post">
            <input type="text" name="order_u_id" id="order_u_id" hidden value="<?=$u_id?>">
            <label for="status">Статус:</label>
            <select name="status" id="order_status">
                <?php foreach($statuses as $st): ?>
                    <option <?=($st==$status)?"selected":""?>><?=$st?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" id="status-change" class="black-button">Изменить</button>
            <p id="order_message"></p>
        </form>
    <?php else: ?>
        <p>Статус: <b><?=$status?></b></p>    
    <?php endif; ?>    
    <hr>
    <h3>Состав заказа:</h3>
    <div>
        <?php foreach($items as $item): ?>
            <div class="cart__item">
                <div>
                    <a href="/catalog/<?=$item['id']?>"><?=$item['name']?></a>
                </div>    
                <div class="cart__item_right">    
                    <div><?=$item['quantity']?> X <?=$item['price']?> = <?=$item['total']?> &#8381;</div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <p>Сумма: <b><?=$total?>  &#8381;</b></p></b></p>
    <hr>
<?php endif; ?>  

<?php if ($is_admin): ?>
<script>

$(document).ready(function() {
    var elMessage = $("#order_message");
    $("#status-change").on('click', function(evt){
        var u_id = $("#order_u_id").val();
        var status = $("#order_status").val();  
        $.ajax({
            url: "/api/shop/changeStatus",
            type: "POST",
            dataType : "json",
            data:{
                'u_id': u_id,
                'status': status,
            },
            error: function() {elMessage.text("Что-то пошло не так...");},
            success: function(answer){           
            if (answer.result) {
                elMessage.text("Статус заказа изменен"); 
            }
            if (answer.error) {
                elMessage.text(answer.error);   
            }	            			
            }
        });    

        evt.preventDefault();
    });
});

</script>
<?php endif; ?>