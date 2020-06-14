<?php

session_start();

if(!$_SESSION['user']['is_admin']){
    header('Location: /choshi/index.php');
    exit;
} 

require ('../helpers.php');


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
        case 'promotions':
            require 'controllers/promotionController.php';
        break;
        case 'orders':
            require 'controllers/orderController.php';
            break;
        case 'rates':
            require 'controllers/rateController.php';
            break;
        case 'licenses':
            require 'controllers/licenseController.php';
            break;
        case 'index':
            require 'controllers/indexController.php';
        break;

        default :
            require 'controllers/indexController.php';
    }
}
else{
    require 'controllers/indexController.php';
}

require 'views/admin.php';

if(isset($_SESSION['messages'])){
    unset($_SESSION['messages']);	
}
if(isset($_SESSION['old_inputs'])){
    unset($_SESSION['old_inputs']);	
}
?>	


