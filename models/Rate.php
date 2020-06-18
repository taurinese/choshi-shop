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