<?php

if(!isset($_GET['id']) && $_GET['controller'] != 'categories'){
    header('Location:index.php');
    exit();
}
require 'models/Product.php';
if(!isset($_GET['filter'])){
    $category_products = getProductsByCategoryId($_GET['id']);
}
else{   
    $category_products = getProductsByCategoryId($_GET['id'], $_GET['filter']);
}    
$currentCategory = getCategories($_GET['id']);
/* var_dump($category);
die(); */
$view['content'] = 'views/categoryView.php';
$view['title'] = $currentCategory['name'];