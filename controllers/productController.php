<?php

require 'models/Product.php';
require 'models/Rate.php';

if(isset($_GET['action']) && $_GET['action'] == 'list'){
    $products = getProductsName();
    echo json_encode($products);
    exit();
}
if(!isset($_GET['id'])){
    header('Location:index.php');
    exit();
}
$selectedProduct = getProducts($_GET['id']);
$alreadyRated = 0;
if(isset($_SESSION['user'])){
    $alreadyRated = empty(getRateByUserId($_SESSION['user']['id'], $_GET['id'])) ? 0 : 1;
}
$images = array();
if(!empty($selectedProduct['images'])){    
    $images = explode(',', $selectedProduct['images']);
}
$rates = getRatesByProductId($_GET['id']);
$currentDate = date_create();
$view['content'] = 'views/productView.php';
$view['title'] = $selectedProduct['name'];