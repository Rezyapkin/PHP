function renderFeedBacks(id = 'feedback') {
    $.ajax({
        url: "/api/feedback.php",
        type: "GET",
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer) {
            let feedback = JSON.parse(answer);
            if (feedback.result) {
                document.getElementById(id).innerHTML = '';
                $("#send_feedback").val("Отправить");
                $("#send_feedback").data()['action'] = "add";
                $("#fb_name").val('');
                $("#fb_message").val('');
                for (feed in feedback.result) {
                    document.getElementById(id).insertAdjacentHTML("beforeend", `
                    <div data-name='${feedback.result[feed].name}' data-message='${feedback.result[feed].feedback}'>
                    <strong>${feedback.result[feed].name}</strong>: 
                    <div>
                        ${feedback.result[feed].feedback} <a href="" data-id='${feedback.result[feed].id}' class='edit'>[edit]</a> 
                        <a href="" data-id='${feedback.result[feed].id}' class='delete'>[x]</a>
                    </div>
                </div><hr>`);

                }

                setEventHandlers();                                        
            }
        }				
    })   
};



function setEventHandlers() {
    $(".edit").on('click', function(evt){
        var par = evt.target.parentElement.parentElement;
        $("#fb_name").val(par.dataset['name']);
        $("#fb_message").val(par.dataset['message']);
        $("#fb_id").val(evt.target.dataset['id']);
        $("#send_feedback").val("Изменить");
        $("#send_feedback").data()['action'] = "save";
        evt.preventDefault();
    });   

    $(".delete").on('click', function(evt){
        doFeedBack('delete', evt.target.dataset['id']);
        evt.preventDefault();
    });       
}

function doFeedBack(action, id) {
    var name = $("#fb_name").val();
    var feedback = $("#fb_message").val();  
    $.ajax({
        url: "/api/feedback.php",
        type: "POST",
        dataType : "json",
        data:{
            action: action,
            id: id,
            name: name,
            feedback: feedback,
        },
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer){
            if (answer.message) {
                document.getElementById('message').innerHTML = answer.message;   
            }	            
            if (answer.result) {
                renderFeedBacks();    
            }
            if (answer.error) {
                alert("Что-то пошло не так...");   
            }	            			
        }
    });    
}

$(document).ready(function() {
    renderFeedBacks();
    $("#send_feedback").on('click', function(evt){
        var id = $("#fb_id").val();
        doFeedBack($("#send_feedback").data()['action'], id);
        evt.preventDefault();
    });
});

