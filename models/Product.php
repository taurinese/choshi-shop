<?php

function getProducts($productId = null)
{
    $db = dbConnect();

    if($productId != null){
        $query = $db->prepare('SELECT p.*, GROUP_CONCAT(cp.category_id), l.license AS license_name, GROUP_CONCAT(DISTINCT ip.image) AS images FROM products p INNER JOIN categories_products cp ON p.id = cp.product_id LEFT JOIN licenses l ON l.id = p.license_id INNER JOIN images_products ip ON ip.product_id = p.id WHERE p.id = ? AND p.is_displayed = 1');
        $query->execute([$productId]);
        return $query->fetch();
    }
    else{
        $query = $db->query('SELECT * FROM products WHERE is_displayed = 1');
        return $query->fetchAll();
    }
}

function getNewProducts()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM products WHERE is_displayed = 1 ORDER BY created_at DESC LIMIT 3');
    return $query->fetchAll();
}

function getPopularProducts()
{
    $db = dbConnect();
    $query = $db->query('SELECT p.*, sum(op.quantity) AS total_quantity
    FROM products p
    JOIN orders_products op ON p.id = op.product_id
    WHERE op.product_id IS NOT NULL AND p.is_displayed = 1
    GROUP BY p.id
    ORDER BY total_quantity DESC
    LIMIT 3');
    return $query->fetchAll();
}
function getProductsByCategoryId($categoryId,$categoryFilter = null)
{
    $db = dbConnect();
    $queryString = 'SELECT p.* FROM products p INNER JOIN categories_products cp ON p.id = cp.product_id WHERE cp.category_id = ? AND p.is_displayed = 1 ';
    
    if($categoryFilter != null){
        switch ($categoryFilter) {
            case 'stock':
                $queryString .= 'AND  p.quantity > 0';
                break;
            case 'price-asc':
                $queryString .= 'ORDER BY p.price ASC';
                break;
            case 'price-desc':
                $queryString .= 'ORDER BY p.price DESC';
                break;
            default:
                break;
        }
    }  
    $query = $db->prepare($queryString);
    $query->execute([
        $categoryId
    ]);
    return $query->fetchAll();
}

function getProductsName()
{
    $db = dbConnect();
    $query = $db->query('SELECT name, id FROM products WHERE is_displayed = 1');
    return $query->fetchAll();
}

function getProductsForCart($cart)
{
    $db = dbConnect();
    $queryArray = '';
    foreach($cart as $key => $product){
        $queryArray .= $product['product_id'];
        if($key != array_key_last($cart)){
            $queryArray .= ',';
        }
    }
    $query = $db->query("SELECT p.* , l.license FROM products p LEFT JOIN licenses l ON l.id = p.license_id WHERE p.id IN ($queryArray)");
    return $query->fetchAll();
}

function updateProductQuantity($cart)
{
    $db = dbConnect();
    foreach ($cart as $key => $product) {
        $query = $db->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");
        $result = $query->execute([
            $product['quantity'],
            $product['product_id']
        ]);
        if(!$result){
            exit();
        }
    }
    return $result;
}