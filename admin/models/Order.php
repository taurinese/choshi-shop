<?php

function getOrders($orderId = null)
{
    $db = dbConnect();

    if($orderId != null){
        $query = $db->prepare('SELECT * FROM orders WHERE id = ?');
        $query->execute([$orderId]);
        return $query->fetch();
    }
    else{
        //Test requête pour afficher le total de la commande mais à vérifier lorsqu'il y aura de la donnée
        $query = $db->query('SELECT o.id, o.first_name, o.last_name, SUM(op.price * quantity) AS total, COUNT(op.id) AS nb_products FROM orders o INNER JOIN orders_products op ON o.id = op.order_id LEFT JOIN users u ON u.id = o.user_id GROUP BY o.id ');
        return $query->fetchAll();
    }
}

function getOrderDetails($orderId)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT o.first_name, o.last_name, o.delivery_address, o.email ,op.product_id, op.name, op.quantity, op.price, p.main_image FROM orders o INNER JOIN orders_products op ON op.order_id = o.id LEFT JOIN products p ON p.id = op.product_id WHERE o.id = ? GROUP BY op.name');
    $query->execute([ $orderId ]);
    return $query->fetchAll();
}