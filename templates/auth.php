<div class="auth-form">
<p class="error_message"><?=$message?></p>    
<h3>Вход</h3>
<form action="/login" method="post">
    <input type="text" name="login" placeholder="Логин" required>
    <input type="password" name="current-password" placeholder="Пароль" required>
    <div class="auth-form__bottom">
        <div>
             <label for='save'>Запомнить</label> 
             <input type='checkbox' name='save' id='save'>
        </div>
        <button type="submit" id="btn-login" class="black-button">Вход</button>
    </div>
</form>
</div>
<br>
<div class="auth-form">
<p class="error_message"><?=$message2?></p>    
<h3>Регистрация</h3>
<form action="/register" method="post">
    <input type="text" name="name" placeholder="Имя" required>
    <input type="text" name="login" placeholder="Логин" required>
    <input type="password" name="current-password" placeholder="Пароль" required>
    <div class="auth-form__bottom">
        <button type="submit" id="btn-login" class="black-button">Регистрация</button>
    </div>
</form>
</div>