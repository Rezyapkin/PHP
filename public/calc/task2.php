<?php
    include 'config.php';
?>

<script
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

   <input type="text" id="val1" value="">
   <input type="text" id="val2" value="">
   <?php foreach($operations as $key => $value): ?>
       <button class='action' id='<?=$value?>'> <?=$key?> </button>
       <?php endforeach; ?>
   </select>   
   <input type="text" id="val3" value=""><br>

<script>

$(document).ready(function(){
    $(".action").on('click', function(el){
        var operand1 = $("#val1").val()
        var operand2 = $("#val2").val()

        $.ajax({
            url: "calc.php",
            type: "POST",
			dataType : "json",
            data:{
                operand1: operand1,
                operand2: operand2,
                operation: el.target.id,
            },
            error: function() {alert("Что-то пошло не так...");},
            success: function(answer){
           	$('#val3').val(answer.result);				
            }
            
        })
    });

});
</script>