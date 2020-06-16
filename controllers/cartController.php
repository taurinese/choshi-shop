<?php

if(!isset($_GET['action'])){
    header('Location: index.php');
    exit();
}
else {
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
            # code...
            break;
        case 'update':
            # code...
            break;
        case 'list':
            # code...
            break;
                    
        default:
            # code...
            break;
    }
}
