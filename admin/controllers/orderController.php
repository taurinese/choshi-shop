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
        $order = getOrderDetails($_GET['id']);
        $total = 0;
        $view['content'] = 'views/orderDisplay.php';
        $view['title'] = 'Aperçu commande';
        break;
    

    default:
        header('Location:/choshi/admin/index.php');
        exit;
        break;
}