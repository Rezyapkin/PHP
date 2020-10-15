<?php if($auth):?>
    <p>Добро пожаловать <a href="/profile"><?=$user_name?></a>!</p>
    <br>
    <a href="?logout" class="black-button">Выйти</a>
<?php else:?>
    <?=$auth_form?>
<?php endif; ?>    
