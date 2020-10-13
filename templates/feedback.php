<h2>Отзывы</h2>
<p id="message">
<?=$message?></p>
<form class="form-feedback" action="" method="post">
    Оставьте отзыв: <br>
    <input id="fb_id" type="text" name="id" hidden>
    <input id="fb_type" type="text" name="type" hidden value="<?=$type?>">
    <input id="fb_c_id" type="text" name="с_id" hidden value="<?=$id?>">
    <input id="fb_name" type="text" name="name" placeholder="Ваше имя"><br>
    <textarea  id="fb_message" name="feedback" placeholder="Ваш отзыв" rows="5"></textarea><br>
    <button type="submit" data-action="add" id="send_feedback" class="black-button">Отправить</button>
</form>
<hr>
<div id="feedback">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/feedback.js"></script>