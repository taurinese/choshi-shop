<?php

session_start();

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
        default :
            require 'controllers/homeController.php';
    }
}
else{
    require 'controllers/homeController.php';
}

require 'views/view.php';


?>	


