<?php
    include 'config.php';
?>

<script
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

   <input type="text" id="val1" value="">
   <select id = 'operation'>
       <?php foreach($operations as $key => $value): ?>
       <option><?=$key?></option>
       <?php endforeach; ?>
   </select>
   <input type="text" id="val2" value="">
   <button class='action'> = </button>
   <input type="text" id="val3" value=""><br>

<script>

$(document).ready(function(){
    $(".action").on('click', function(){
        var operand1 = $("#val1").val()
        var operand2 = $("#val2").val()
        var operation = $("#operation").val()

        $.ajax({
            url: "calc.php",
            type: "POST",
			dataType : "json",
            data:{
                operand1: operand1,
                operand2: operand2,
                operation: operation,
            },
            error: function() {alert("Что-то пошло не так...");},
            success: function(answer){
           	$('#val3').val(answer.result);				
            }
            
        })
    });

});
</script>

	