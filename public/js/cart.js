var cartElements = null;

function updateTotalSumInCart(total) {
    $('#total_cart').html(`Итого: ${Number(total)} &#8381;`);
    if (Number(total)>0) {    
        $('#make_order').show();
    } else {
        $('#make_order').hide();
    }    
}

function updateHeaderCart(count) {
    $('#header_cart').text(`Корзина (${Number(count)})`);
}

function renderTotalCart(total, count) {
    updateTotalSumInCart(total);
    updateHeaderCart(count);
}

//Обновляет количество товаров в корзине
function updateTotalCart() {
    $.ajax({
        url: "/api/cart/getTotal",
        type: "GET",
        error: function() {console.log("Cart API (getCountItems): ошибка получения количества товаров в корзине.")},
        success: function(answer) {
            let res = JSON.parse(answer);
            if (!res.error) {
                renderTotalCart(res.result['sum'], res.result['count']);                             
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
                <a href="" data-cart_id='${cartItem['cart_id']}' data-action='subItem' class='cart-item-edit black-button black-button_sm'>-</a>
                <a href="" data-cart_id='${cartItem['cart_id']}' data-action='addItem' class='cart-item-edit black-button black-button_sm'>+</a>
                <a href="" data-cart_id='${cartItem['cart_id']}' data-action='deleteItem' class='cart-item-edit black-button black-button_sm'>X</a>
            </div>
        </div>
    </div>
    `;
}

function renderCart(id) {
    cartElements = document.getElementById(id);
    if (!cartElements) return;
    $.ajax({
        url: "/api/cart/getItems",
        type: "GET",
        error: function() {console.log("Cart API (getItems): ошибка получения товаров из корзины.")},
        success: function(answer) {
            let res = JSON.parse(answer);
            if (res.error || !res.result) return;
            cartElements.innerHTML = '';
            total = 0;
            count = 0;
            for (item in res.result) {
                cartElements.insertAdjacentHTML("beforeend", templateCartItem(res.result[item]));   
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
                correctCartItem(answer['result']['id'], answer['result']['current_item']);
                if (answer['result']['total']) {
                    renderTotalCart(answer['result']['total']['sum'], answer['result']['total']['count']);    
                }
            }      	            			
        }
    });    
}

function correctCartItem(id, cartItem) {
    if (!cartElements) {
        return;
    }
    const el_name = "#cart_item_"+id; 
    const el = $(el_name);
    
    if (cartItem) {
        let tmpl = templateCartItem(cartItem);
        if (el) {
            el.replaceWith(tmpl);    
        } else {
            cartElements.insertAdjacentHTML("beforeend", tmpl); 
        };  
        setEventHandlers(el_name);  
    } else if (el) {
        //есть ID элемента, но нет товара в базе
        el.remove();
    }     
}

//Навешивает обработчики изменения и удаления отзыва
function setEventHandlers(elements='.cart-item-edit') {
    $(elements).off('click');
    $(elements).on('click', function(evt){
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