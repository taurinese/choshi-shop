<?php

function addRate($productId, $userId, $informations)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO products_rates (product_id, user_id, rate, content) VALUES (:product_id, :user_id, :rate, :content) ');
    return $query->execute([
        'product_id' => $productId,
        'user_id' => $userId,
        'rate' => intval($informations['product-rate']),
        'content' => $informations['comment']
    ]);
}

function getRatesByProductId($productId)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT pr.*, u.first_name FROM products_rates pr INNER JOIN users u ON u.id = pr.user_id WHERE product_id = ?');
    $query->execute([
        $productId
    ]);
    return $query->fetchAll();

}

function getRateByUserId($userId, $productId)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM products_rates WHERE product_id = ? AND user_id = ?');
    $query->execute([
        $productId,
        $userId
    ]);
    return $query->fetch();
}