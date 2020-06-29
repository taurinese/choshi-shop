<?php

//Pour afficher les dates en français sur le site
setlocale(LC_TIME, "fr_FR", "French");

session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

require ('helpers.php');
require ('models/Category.php');
$categories = getCategories();

if(isset($_GET['controller'])){
    switch ($_GET['controller']){
        case 'products' :
            require 'controllers/productController.php';
            break;
        case 'categories':
            require 'controllers/categoryController.php';
            break;
        case 'users':
            require 'controllers/userController.php';
            break;
        case 'home':
            require 'controllers/homeController.php';
            break;
        case 'cart':
            require 'controllers/cartController.php';
            break;
        case 'orders':
            require 'controllers/orderController.php';
            break;
        case 'rates':
            require 'controllers/rateController.php';
            break;
        default :
            header('Location:index.php?controller=home');
            exit();
    }
}
else{
    header('Location:index.php?controller=home');
    exit();
}

require 'views/view.php';

if(isset($_SESSION['messages'])){
    unset($_SESSION['messages']);	
}

?>	


