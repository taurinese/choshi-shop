<?php

require 'models/Product.php';
require 'models/Order.php';
require 'models/User.php';

switch ($_GET['action']) {
    case 'add':
        if(!isset($_SESSION['user'])){
            $_SESSION['messages'][] = [
                'message' => 'Vous devez être connecté pour passer une commande!',
                'color' => 'red'
            ];
            header('Location:index.php?controller=cart&action=list');
            exit();
        }
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
        $orderDetails = getOrderDetails($_GET['id']);
/*         var_dump($orderDetails);
        die(); */
        $total = 0;
        $view['content'] = 'views/orderDetails.php';
        $view['title'] = "Détails commande";
        break;
    
    default:
        # code...
        break;
}

/* $view['content'] = 'views/homeView.php';
$view['title'] = "Page d'accueil"; */