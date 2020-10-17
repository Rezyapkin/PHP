<div class="auth-form">
<p class="error_message<?=$no_error?>"><?=$message?></p>    
<h3>Профиль пользователя</h3>
<form action="/profile" method="post">
    <input type="text" name="login" placeholder="Логин" required readonly value="<?=$user_login?>">
    <input type="text" name="name" placeholder="Ваше имя" required value="<?=$user_name?>">
    <input type="password" name="new-password" placeholder="Новый пароль (не обязательно)">
    <input type="password" name="current-password" placeholder="Текущий пароль" required>
    <div class="auth-form__bottom">
        <button type="submit" id="btn-login" class="black-button">Изменить</button>
        <a href="?logout" class="black-button">Выйти</a>
    </div>    
</form>
</div>
<hr>
<?=$orders?>