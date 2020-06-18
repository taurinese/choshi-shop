<?php

require 'models/Product.php';
require 'models/Order.php';
require 'models/User.php';

switch ($_GET['action']) {
    case 'add':
        $user = getUser($_SESSION['user']['id']);
        $cartProducts = getProductsForCart($_SESSION['cart']);
        if (!empty($cartProducts)) {
            $order = addOrder($user);
            if($order['result']){
                $result = addOrderProducts($cartProducts, $order['order_id']);
                if($result){
                    $result = updateProductQuantity($_SESSION['cart']);
                    if($result){
                        unset($_SESSION['cart']);
                    }
                }
            }
        }
        header('Location:index.php');
        exit();
        break;

    case 'list':
        # code...
        break;
    
    default:
        # code...
        break;
}

/* $view['content'] = 'views/homeView.php';
$view['title'] = "Page d'accueil"; */