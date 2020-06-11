<?php

function getPromotions($promoId = null)
{
    $db = dbConnect();

    if($promoId != null){
        $query = $db->prepare('SELECT * FROM promotions WHERE id = ?');
        $query->execute([$promoId]);
        return $query->fetch();
    }
    else{
        //Test requête pour afficher le total de la commande mais à vérifier lorsqu'il y aura de la donnée
        $query = $db->query('SELECT * FROM promotions');
        return $query->fetchAll();
    }
}

function addPromotion($informations)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO promotions(name, discount) VALUES (:name, :discount)');
    return $query->execute([
        'name' => $informations['name'],
        'discount' => $informations['discount']
    ]);
}

function updatePromotion($id, $informations)
{
    $db = dbConnect();
	
	$query = $db->prepare("UPDATE promotions SET name = :name, discount = :discount WHERE id = :id");
    return $query->execute([
        'name' => $informations['name'],
        'discount' => $informations['discount']
    ]);
}

function deletePromotion($id)
{
    $db = dbConnect();
    $query = $db->prepare('DELETE FROM promotions WHERE id = ?');
	return $query->execute([
		$id
	]);    
}