//Обновляет количество товаров в корзине
function updateTotalCart(header_cart = 'header_cart', total_cart="total_cart") {
    $.ajax({
        url: "/api/cart/getTotal",
        type: "GET",
        error: function() {console.log("Cart API (getCountItems): ошибка получения количества товаров в корзине.")},
        success: function(answer) {
            let res = JSON.parse(answer);
            if (!res.error) {
                $('#'+header_cart).text(`Корзина (${res.result['count']})`);
                $('#'+total_cart).html(`Итого: ${res.result['total']} &#8381;`);                                     
            }
        }				
    })  
} 

function templateCartItem(cartItem) {
    return `
    <div class="cart__item" data-id="${cartItem['cart_id']}">
        <div>
            <a href="/catalog/${cartItem['product_id']}">${cartItem['name']}</a>
        </div>    
        <div class="cart__item_right">    
            <div>${cartItem['quantity']} X ${cartItem['price']} = ${cartItem['total']} &#8381;</div>
            <div class="cart__item_buttons">
                <a href="" data-id='${cartItem['cart_id']}' class='cart-minus black-button black-button_sm'>-</a>
                <a href="" data-id='${cartItem['cart_id']}' class='cart-plus black-button black-button_sm'>+</a>
                <a href="" data-id='${cartItem['cart_id']}' class='cart-delete black-button black-button_sm'>X</a>
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
            for (item in res.result) {
                cart.insertAdjacentHTML("beforeend", templateCartItem(res.result[item]));                                  
            }
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
                updateTotalCart();    
            }      	            			
        }
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