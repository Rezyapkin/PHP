<h2>Отзывы</h2>
<p id="message">
<?=$message?></p>
<form action="" method="post">
    Оставьте отзыв: <br>
    <input id="fb_id" type="text" name="id" hidden>
    <input id="fb_name" type="text" name="name" placeholder="Ваше имя"><br>
    <textarea  id="fb_message" name="feedback" placeholder="Ваш отзыв" rows="5"></textarea><br>
    <input type="submit" value="Отправить" data-action="add" id="send_feedback">
</form>
<hr>
<div id="feedback">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/feedback.js"></script>