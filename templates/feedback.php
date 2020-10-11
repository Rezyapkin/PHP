<h2>Отзывы</h2>

<?=$message?>
<form action="/feedback/<?=$action?>/" method="post">
    Оставьте отзыв: <br>
    <input type="text" name="name" placeholder="Ваше имя" value="<?=$fb_name?>"><br>
    <textarea name="feedback" placeholder="Ваш отзыв" rows="5"><?=$fb_message?></textarea><br>
    <input type="submit" value="<?=$button?>">
</form>
<hr>
<?php foreach ($feedback as $value): ?>
    <div>
        <strong><?=$value['name']?></strong>: 
        <div>
            <?=$value['feedback']?> <a href="/feedback/edit/<?=$value['id']?>">[edit]</a> 
            <a href="/feedback/delete/<?=$value['id']?>">[x]</a>
        </div>
    </div>
    <hr>
<?php endforeach;?>