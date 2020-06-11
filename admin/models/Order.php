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
        $query = $db->query('SELECT o.id, u.first_name, u.last_name, SUM(op.price) AS total FROM orders o INNER JOIN orders_products op ON o.id = op.order_id INNER JOIN users u ON u.id = o.user_id GROUP BY o.id ');
        return $query->fetchAll();
    }
}