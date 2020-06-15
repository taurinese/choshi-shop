<?php

function getProducts($productId = null)
{
    $db = dbConnect();

    if($productId != null){
        $query = $db->prepare('SELECT p.*, GROUP_CONCAT(cp.category_id), l.license AS license_name FROM products p INNER JOIN categories_products cp ON p.id = cp.product_id LEFT JOIN licenses l ON l.id = p.license_id WHERE p.id = ?');
        $query->execute([$productId]);
        return $query->fetch();
    }
    else{
        $query = $db->query('SELECT p.*, GROUP_CONCAT(c.name) FROM products p INNER JOIN categories_products cp ON p.id = cp.product_id INNER JOIN categories c on c.id = cp.category_id');
        return $query->fetchAll();
    }
}

function getNewProducts()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM products ORDER BY created_at DESC LIMIT 3');
    return $query->fetchAll();
}

function getProductsByCategoryId($categoryId)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT p.* FROM products p INNER JOIN categories_products cp ON p.id = cp.product_id WHERE cp.category_id = ?');
    $query->execute([
        $categoryId
    ]);
    return $query->fetchAll();
}