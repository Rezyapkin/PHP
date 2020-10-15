let feedbacks = document.getElementById('feedback');

//Очистить форму отзыва
function clearFormFeedBack() {
    $("#send_feedback").text("Отправить");
    $("#send_feedback").data()['action'] = "add";
    $("#fb_name").val('');
    $("#fb_message").val('');
}

//Шаблон отзыва
function templateFeedBack(fb) {
    return `
    <div data-name='${fb.name}' data-message='${fb.feedback}' data-id='${fb.id}' id='${"fb_"+fb.id}'>
       <strong>${fb.name}</strong>: 
       <div>
           ${fb.feedback} <a href="" data-id='${fb.id}' class='edit black-button black-button_sm'>Править</a> 
           <a href="" data-id='${fb.id}' class='delete black-button  black-button_sm'>Х</a>
        </div>
        <hr>
    </div>`;

}

//Отрисовывает все отзывы
function renderFeedBack(id = 'feedback') {
    var tp = $("#fb_type").val();
    var c_id = $("#fb_c_id").val();
    $.ajax({
        url: "/api/feedback" + ((tp) ? ("?type=" + tp + "&c_id=" + c_id) : ""),
        type: "GET",
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer) {
            let feedback = JSON.parse(answer);
            if (feedback.result) {
                document.getElementById(id).innerHTML = '';
                for (feed in feedback.result) {
                    feedbacks.insertAdjacentHTML("beforeend", templateFeedBack(feedback.result[feed]));
                }
                setEventHandlers();  
                clearFormFeedBack();                                      
            }
        }				
    })   
};

//Переходит  в режим редактирования отзыва
function setEditMode(dataset) {
    $("#fb_name").val(dataset['name']);
    $("#fb_message").val(dataset['message']);
    $("#fb_id").val(dataset['id']);
    $("#send_feedback").text("Изменить");
    $("#send_feedback").data()['action'] = "save";    
}    

//Навесить обработчики изменения и удаления отзыва
function setEventHandlers() {
    $(".edit").off('click');
    $(".edit").on('click', function(evt){
        var par = evt.target.parentElement.parentElement;
        setEditMode(par.dataset);
        evt.preventDefault();
    });   

    $(".delete").off('click');
    $(".delete").on('click', function(evt){
        doFeedBack('delete', evt.target.dataset['id']);
        evt.preventDefault();
    });       
}

//Изменить список отзывов AJAX
function correctFeedBack(params) {
    var el = $("#fb_"+params.id);
    switch (params.action) {
        case 'delete':
            el.remove();
            break;
        case 'save':
            el.replaceWith(templateFeedBack(params));
            setEventHandlers();
            break;
        case 'add':
            feedbacks.insertAdjacentHTML("afterbegin", templateFeedBack(params));
            setEventHandlers();
            break;        
    }
    clearFormFeedBack();
}

//Работа с отзывами на сервере через AJAX
function doFeedBack(action, id) {
    var name = $("#fb_name").val();
    var feedback = $("#fb_message").val();  
    $.ajax({
        url: "/api/feedback",
        type: "POST",
        dataType : "json",
        data:{
            action: action,
            id: id,
            name: name,
            feedback: feedback,
            type: $("#fb_type").val(),
            c_id: $("#fb_c_id").val(),
        },
        error: function() {alert("Что-то пошло не так...");},
        success: function(answer){           
            if (answer.result) {
                correctFeedBack(answer.result);   
                document.getElementById('message').innerHTML = answer.message; 
            }
            if (answer.error) {
                alert("Что-то пошло не так...");   
            }	            			
        }
    });    
}

//После загрузки документа отрисуем отзывы и навесим обработчик на кнопку отправить
$(document).ready(function() {
    renderFeedBack();
    $("#send_feedback").on('click', function(evt){
        var id = $("#fb_id").val();
        doFeedBack($("#send_feedback").data()['action'], id);
        evt.preventDefault();
    });
});

