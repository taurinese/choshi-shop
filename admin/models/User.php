<?php

function getUsers($userId = null)
{
    $db = dbConnect();

    if($userId != null){
        $query = $db->prepare('SELECT * FROM users WHERE id = ?');
        $query->execute([$userId]);
        return $query->fetch();
    }
    else{
        $query = $db->query('SELECT * FROM users');
        return $query->fetchAll();
    }
}

function addUser($informations)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO users(first_name, last_name, adresse, password, email, is_admin) VALUES (:first_name, :last_name, :adresse, :password, :email, :is_admin)');
    return $query->execute([
        'first_name' => $informations['first_name'],
        'last_name' => $informations['last_name'],
        'adresse' => $informations['adresse'],
        'password' => hash('md5', $informations['password']),
        'email' => $informations['email'],
        'is_admin' => $informations['is_admin']
    ]);
}

function updateUser($id, $informations)
{
    $db = dbConnect();
	
	$query = $db->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, adresse = :adresse, password = :password, email = :email, is_admin = :is_admin WHERE id = :id");
	return $query->execute([
        'first_name' => $informations['first_name'],
        'last_name' => $informations['last_name'],
        'adresse' => $informations['adresse'],
        'password' => hash('md5', $informations['password']),
        'email' => $informations['email'],
        'is_admin' => $informations['is_admin'],
		'id' => $id
	]);
}

function deleteUser($id)
{
    $db = dbConnect();
    $query = $db->prepare('DELETE FROM users WHERE id = ?');
	return $query->execute([
		$id
	]);
}