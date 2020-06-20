<?php

function addOrder($user)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO orders (user_id, delivery_address, first_name, last_name, email) VALUES (:user_id, :address, :first_name, :last_name, :email)');
    $result = $query->execute([
        'user_id' => $user['id'],
        'address' => $user['adresse'],
        'first_name' => $user['first_name'],
        'last_name' => $user['last_name'],
        'email' => $user['email']
    ]);
    $orderId = $db->lastInsertId();
    return [
        'order_id' => $orderId,
        'result' => $result
    ];
}

function addOrderProducts($cartProducts, $orderId)
{
    $db = dbConnect();
    $queryString = 'INSERT INTO orders_products (order_id, product_id, name, quantity, price) VALUES ';
    $queryArray = array();
    foreach ($cartProducts as $index => $cartProduct) {
        $queryString .= "( :order_id, :product_id_$index, :name_$index, :quantity_$index, :price_$index)";
        if($index !== array_key_last($cartProducts)) $queryString .= ',';
        $queryArray["product_id_$index"] = $cartProduct['id'];
        $queryArray["name_$index"] = $cartProduct['name'];
        $queryArray["quantity_$index"] = $_SESSION['cart'][$index]['quantity'];
        $queryArray["price_$index"] = $cartProduct['price'];
    }
    $queryArray['order_id'] = $orderId;
    $query = $db->prepare($queryString);
    return $query->execute($queryArray);
}

function getOrdersByUserId($userId)
{
    $db = dbConnect();
/*     $query = $db->prepare('SELECT o.date, o.delivery_address, p.*  
    FROM orders o 
    INNER JOIN orders_products op ON o.id = op.order_id 
    LEFT JOIN products p ON p.id = op.product_id 
    WHERE user_id = ?
    GROUP BY op.id'); */
    $query = $db->prepare('SELECT o.*, DATE_FORMAT(o.date, "%d/%m/%Y") AS new_date, SUM(op.price) AS total FROM orders o INNER JOIN orders_products op ON o.id = op.order_id WHERE user_id = ? GROUP BY o.id');
    $query->execute([ $userId ]);
    return $query->fetchAll();
}

function getOrderDetails($orderId)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT o.*, SUM(op.price) AS total, op.product_id, op.name, op.quantity, op.price, p.main_image FROM orders o INNER JOIN orders_products op ON op.order_id = o.id LEFT JOIN products p ON p.id = op.product_id WHERE o.id = ? GROUP BY op.name');
    $query->execute([$orderId]);
    return $query->fetchAll();
}