<?php

function checkUser($informations)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT id, first_name, last_name, email, adresse FROM users WHERE email = :email AND password = :password');
    $query->execute([
        'email' => $informations['user-email'],
        'password' => hash('md5', $informations['user-password'])
    ]);
    return $query->fetch();
}

function addUser($informations)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO users (first_name, last_name, adresse, password, email, is_admin) 
                           VALUES (:first_name, :last_name, :adresse, :password, :email, :is_admin)');
    return $query->execute([
        'first_name' => $informations['first_name'],
        'last_name' => $informations['last_name'],
        'adresse' => $informations['address'],
        'password' => hash('md5', $informations['user-password']),
        'email' => $informations['user-email'],
        'is_admin' => 0
    ]);
}