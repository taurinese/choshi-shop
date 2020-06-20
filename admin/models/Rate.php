<?php

function getRates($rateId = null)
{
    $db = dbConnect();

    if($rateId != null){
        $query = $db->prepare('SELECT pr.*, u.*, p.* FROM products_rates pr INNER JOIN users u ON u.id = pr.user_id INNER JOIN products p ON p.id = pr.product_id WHERE pr.id = ?');
        $query->execute([$rateId]);
        return $query->fetch();
    }
    else{
        $query = $db->query('SELECT pr.*, u.first_name, u.last_name, p.name FROM products_rates pr INNER JOIN users u ON u.id = pr.user_id INNER JOIN products p ON p.id = pr.product_id');
        return $query->fetchAll();
    }
}


function deleteRate($id)
{
    $db = dbConnect();
    $query = $db->prepare('DELETE FROM products_rates WHERE id = ?');
	return $query->execute([
		$id
	]);    
}