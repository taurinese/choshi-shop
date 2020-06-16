<?php

if(!isset($_GET['action'])){
    header('Location: index.php');
    exit();
}
else {
    require 'models/Product.php';
    switch ($_GET['action']) {
        case 'add':
            $encodedData = file_get_contents("php://input");
            $product = json_decode($encodedData, true);
            if(isset($product['product_id']) && isset($product['quantity'])){
                $_SESSION['cart'][] = [
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity']
                ];
                echo json_encode(['success' => true]);
                exit();
            }
            else{
                echo json_encode(['success' => false]);
                exit();
            }
            break;
        case 'delete':
            if(!isset($_GET['id'])){
                header('Location:index.php?controller=cart&action=list');
                exit();
            }
            break;
        case 'update':
            # code...
            break;
        case 'list':
            $cartProducts = getProductsForCart($_SESSION['cart']);
            $total = 0;
            foreach($cartProducts as $key => $cartProduct){
                $total += $cartProduct['price'] * $_SESSION['cart'][$key]['quantity'];
            }
            $view['content'] = 'views/cartList.php';
            $view['title'] = 'Panier';
            break;
                    
        default:
            # code...
            break;
    }
}
