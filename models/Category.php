<?php

function getCategories()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM categories');
    return $query->fetchAll();
}