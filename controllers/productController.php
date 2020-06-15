<?php

require 'models/Product.php';

if(!isset($_GET['id'])){
    header('Location:index.php');
    exit();
}
$selectedProduct = getProducts($_GET['id']);
$view['content'] = 'views/productView.php';
$view['title'] = $selectedProduct['name'];