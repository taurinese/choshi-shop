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
                        $_SESSION['messages'][] = [
                            'message' => 'Commande effectuée!',
                            'color' => 'green'
                        ];
                    }
                }
            }
        }
        header('Location:index.php');
        exit();
        break;

    case 'list':
        if(isset($_SESSION['user'])){
            if(isset($_GET['id']) && is_numeric($_GET['id'])){
                $orderDetails = getOrderDetails($_GET['id']);
                if($orderDetails == false){
                    header('Location:index.php?controller=users&action=display');
                    exit;
                }
                $total = 0;
                $view['content'] = 'views/orderDetails.php';
                $view['title'] = "Détails commande";
            }
            else{
                header('Location:index.php?controller=users&action=display');
                exit;
            }
        }
        else{
            header('Location:index.php');
            exit;
        }
        break;
    
    default:
        header('Location:index.php');
        exit();
        break;
}

