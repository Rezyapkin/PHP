<h2>Каталог</h2>
<div class="products">
    <?php foreach($catalog as $product): ?>
    <div class="product-item">
        <a class="product-item__link" href="/catalog/<?=$product['id']?>">
             <img class="product_item__img" src="/images/products/<?=$product['image']?>" alt="<?=$product['name']?>" >
             <p><?=$product['name']?></p>
        </a>
        <div class="product_item__price"><?=$product['price']?> &#8381;</div><a href="#" class="black-button btn-buy">В корзину</a>
    </div>
    <?php endforeach; ?>
</div>