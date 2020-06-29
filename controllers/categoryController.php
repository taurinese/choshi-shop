<?php

if(!isset($_GET['id']) && $_GET['controller'] != 'categories'){
    header('Location:index.php');
    exit();
}
require 'models/Product.php';
if(!isset($_GET['filter']) || ctype_alpha($_GET['filter'])){
    $category_products = getProductsByCategoryId($_GET['id']);
}
else{   
    $category_products = getProductsByCategoryId($_GET['id'], $_GET['filter']);
}  
if($category_products == false){
    header('Location:index.php');
    exit();
}  
$currentCategory = getCategories($_GET['id']);

$view['content'] = 'views/categoryView.php';
$view['title'] = $currentCategory['name'];