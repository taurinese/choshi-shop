<?php

function checkUser($informations)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT first_name, last_name, email, adresse FROM users WHERE email = :email AND password = :password');
    $query->execute([
        'email' => $informations['user-email'],
        'password' => hash('md5', $informations['user-password'])
    ]);
    return $query->fetch();
}