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
        $query = $db->query('SELECT * FROM products');
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

function getProductsName()
{
    $db = dbConnect();
    $query = $db->query('SELECT name, id FROM products');
    return $query->fetchAll();
}