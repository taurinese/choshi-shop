<?php

function checkUser($informations)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT id, first_name, last_name, email, adresse, is_admin FROM users WHERE email = :email AND password = :password');
    $query->execute([
        'email' => $informations['user-email'],
        'password' => hash('md5', $informations['user-password'])
    ]);
    return $query->fetch();
}

function getUser($id)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM users WHERE id = ?');
    $query->execute([$id]);
    return $query->fetch();
}

function addUser($informations)
{
    $db = dbConnect();
    $query =$db->prepare('SELECT * FROM users WHERE email = ?');
    $query->execute([
        $informations['user-email']
    ]);
    $result = $query->fetch();
    $result = !empty($result) ? ['exists' => true] : '';
    if(is_array($result)){
        return $result;
    }
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

function editUser($informations, $id)
{
    $db = dbConnect();

    $queryString = 'UPDATE users SET first_name = :first_name, last_name = :last_name, adresse = :adresse,' . (!empty($informations['password'])? 'password = :password,': '') . 'email = :email, is_admin = :is_admin WHERE id = :id';
    $queryArray = [
        'first_name' => $informations['first_name'],
        'last_name' => $informations['last_name'],
        'adresse' => $informations['adresse'],
        'email' => $informations['user-email'],
        'is_admin' => 0,
		'id' => $id
    ];
    if(!empty($informations['user-password'])){
        $queryArray['password'] = hash('md5', $informations['user-password']);
    }
    $query = $db->prepare($queryString);
    return $query->execute($queryArray);
}