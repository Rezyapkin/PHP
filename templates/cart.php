<h2>Корзина</h2>
<div id="cart" class="cart">
</div>
<hr>
<div class="total_cart" id="total_cart"></div>
<div class="clearfix"></div>

<div class="auth-form" id="make_order">
<h3>Оформление заказа:</h3>
<form action="/makeOrder" method="post">
    <input type="text" name="name" placeholder="Ваше имя" required value="<?=$user_name?>">
    <input type="text" placeholder="Ваш номер телефона" class="phone" name="phone" required>
    <input type="text" placeholder="Адрес" name="address" required>
    <button type="submit" class="black-button">Оформить заказ</button>   
</form>
</div>
<script src="/js/jquery.inputmask.min.js"></script>
<script>
$(document).ready(function() {
    $(".phone").inputmask("+7 (999) 999-9999");
    renderCart('cart');
});
</script>