<?php

if(!isset($_GET['action'])){
    header('Location:/choshi/admin/index.php');
    exit;
}

require 'models/Order.php';

switch ($_GET['action']) {
    case 'list':
        $orders = getOrders();
        $view['content'] = 'views/orderList.php';
        $view['title'] = 'Liste commandes';
        break;
    
    case 'display':
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $order = getOrderDetails($_GET['id']);
            $total = 0;
            $view['content'] = 'views/orderDisplay.php';
            $view['title'] = 'Aperçu commande';
        }
        else{
            header('Location:index.php?controller=orders&action=list');
            exit;
        }
        break;
    

    default:
        header('Location:/choshi/admin/index.php');
        exit;
        break;
}