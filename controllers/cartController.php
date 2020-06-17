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
            foreach ($_SESSION['cart'] as $key => $cartProduct) {
                if($cartProduct['product_id'] == $_GET['id']){
                    unset($_SESSION['cart'][$key]);
                }
            }
            goto listCase;
            break;
        case 'update':
            # code...
            break;
        case 'list':
            listCase:
            $cartProducts = getProductsForCart($_SESSION['cart']);
            /* var_dump($cartProducts);
            die(); */
            $total = 0;
            foreach($cartProducts as $key => $cartProduct){
                foreach ($_SESSION['cart'] as $key => $cart_product) {
                    if($cartProduct['id'] == $cart_product['product_id']){
                        $total += $cartProduct['price'] * $cart_product['quantity'];
                    }
                }
            }
            $view['content'] = 'views/cartList.php';
            $view['title'] = 'Panier';
            break;
                    
        default:
            # code...
            break;
    }
}
