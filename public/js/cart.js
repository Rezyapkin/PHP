function updateTotalSumInCart(total) {
    $('#total_cart').html(`Итого: ${total} &#8381;`);

}

//Обновляет количество товаров в корзине
function updateTotalCart(header_cart = 'header_cart') {
    $.ajax({
        url: "/api/cart/getTotal",
        type: "GET",
        error: function() {console.log("Cart API (getCountItems): ошибка получения количества товаров в корзине.")},
        success: function(answer) {
            let res = JSON.parse(answer);
            if (!res.error) {
                $('#'+header_cart).text(`Корзина (${res.result['count']})`);
                updateTotalSumInCart(res.result['total']);                                     
            }
        }				
    })  
} 

function templateCartItem(cartItem) {
    return `
    <div class="cart__item" id="cart_item_${cartItem['cart_id']}">
        <div>
            <a href="/catalog/${cartItem['product_id']}">${cartItem['name']}</a>
        </div>    
        <div class="cart__item_right">    
            <div>${cartItem['quantity']} X ${cartItem['price']} = ${cartItem['total']} &#8381;</div>
            <div class="cart__item_buttons">
                <a href="" data-cart_id='${cartItem['cart_id']}' data-quantity='-1' data-action='incQuantityItem' class='cart-item-edit black-button black-button_sm'>-</a>
                <a href="" data-cart_id='${cartItem['cart_id']}' data-quantity='1' data-action='incQuantityItem' class='cart-item-edit black-button black-button_sm'>+</a>
                <a href="" data-cart_id='${cartItem['cart_id']}' data-action='deleteItem' class='cart-item-edit black-button black-button_sm'>X</a>
            </div>
        </div>
    </div>
    `;
}

function renderCart(id) {
    cart = document.getElementById(id);
    if (!cart) return;
    $.ajax({
        url: "/api/cart/getItems",
        type: "GET",
        error: function() {console.log("Cart API (getItems): ошибка получения количества товаров в корзине.")},
        success: function(answer) {
            let res = JSON.parse(answer);
            if (res.error || !res.result) return;
            cart.innerHTML = '';
            total = 0;
            for (item in res.result) {
                cart.insertAdjacentHTML("beforeend", templateCartItem(res.result[item]));   
                total += Number(res.result[item]['total']);                               
            }
            updateTotalSumInCart(total);   
            setEventHandlers();     
        }				
    }); 
}

function doActCart(el, method="addItem", params={}) {
    $.ajax({
        url: "/api/cart/"+method,
        type: "POST",
        dataType : "json",
        data: params,
        error: function() {console.log(`Ошибка работы метода ${method}.`);},
        success: function(answer){    
            if (answer.error) {
                console.log(`Ошибка работы метода ${method}.`);   
            } else {
                correctCartItem(answer.action, answer.id, answer.result);
                updateTotalCart();    
            }      	            			
        }
    });    
}

function correctCartItem(action, id, cartItem) {
    var el = $("#cart_item_"+id);
    switch (action) {
        case 'delete':
            el.remove();
            break;
        case 'edit':
            el.replaceWith(templateCartItem(cartItem));
            setEventHandlers("#cart_item_"+id);  
            break;
    }       
}

//Навешивает обработчики изменения и удаления отзыва
function setEventHandlers(elements='.cart-item-edit') {
    $(".cart-item-edit").off('click');
    $(".cart-item-edit").on('click', function(evt){
        doActCart(evt.target, evt.target.dataset['action'], evt.target.dataset);
        evt.preventDefault();
    });   
     
}

$(document).ready(function() {
    $(".btn-buy").on('click', function(evt){
        doActCart(evt.target, "addItem", {
            'product_id': evt.target.dataset['id'],
        });
        evt.preventDefault();
    });
});