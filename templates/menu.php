<header class="header">
    <div class="header__login">
        <div></div>
        <?php if ($auth): ?>
            <a class="header__login-href" href="/profile"><?=$user_name?></a>            
        <?php else: ?>
            <a class="header__login-href" href="/login">Вход</a>
        <?php endif; ?>
    </div>
    <div class="header__bottom">    
    <div class="header__menu">
        <a href="/">Главная</a>
        <a href="/catalog">Каталог</a>
        <a href="/gallery">Галерея</a>
        <a href="/news">Новости</a>
        <a href="/feedback">Отзывы</a>
    </div>
    <div class="header__cart">
        <a id="header_cart" href="/cart">Корзина (<?=$count_in_cart?>)</a>
    </div> 
    </div>   
</header>