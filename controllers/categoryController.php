<?php

if(!isset($_GET['id']) && $_GET['controller'] != 'categories'){
    header('Location:index.php');
    exit();
}
require 'models/Product.php';
$category_products = getProductsByCategoryId($_GET['id']);
$currentCategory = getCategories($_GET['id']);
/* var_dump($category);
die(); */
$view['content'] = 'views/categoryView.php';
$view['title'] = $currentCategory['name'];