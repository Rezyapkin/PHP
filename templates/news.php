<h2>Новости</h2>
<?php foreach ($news as $value):?>
    <p><a href="/news/<?=$value['id']?>"><?=$value['title']?></a></p>
<? endforeach;?>