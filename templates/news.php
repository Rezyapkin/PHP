<h2>Новости</h2>
<?php foreach ($news as $value):?>
    <p><a href="/newsOne/?id=<?=$value['id']?>"><?=$value['title']?></a></p>
<? endforeach;?>