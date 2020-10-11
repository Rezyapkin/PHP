<?php

function getNews() {
    return getAssocResult("SELECT * FROM news");
}

function getOneNews($id) {
    return getAssocResult("SELECT * FROM news WHERE id = {$id}")[0];
}