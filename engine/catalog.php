<?php

function getProducts() {
    return getAssocResult("SELECT * FROM products");
}

function getProductById($id) {
    return getAssocResult("SELECT * FROM products WHERE id = {$id}")[0];
}