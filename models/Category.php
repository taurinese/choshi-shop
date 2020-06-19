<?php

function getCategories($categoryId = null)
{
    $db = dbConnect();
    if($categoryId == null){
        $query = $db->query('SELECT * FROM categories');
        return $query->fetchAll();
    }
    else{
        $query = $db->prepare('SELECT * FROM categories WHERE id = :id');
        $query->execute([
            'id' => $categoryId
        ]);

        return $query->fetch();
    }
}