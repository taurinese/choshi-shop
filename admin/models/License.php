<?php

function getLicenses($licenseId = null)
{
    $db = dbConnect();

    if($licenseId != null){
        $query = $db->prepare('SELECT * FROM licenses WHERE id = ?');
        $query->execute([$licenseId]);
        return $query->fetch();
    }
    else{
        $query = $db->query('SELECT * FROM licenses');
        return $query->fetchAll();
    }
}

function addLicense($informations)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO licenses(license) VALUES (:license)');
    return $query->execute([
        'license' => $informations['license']
    ]);
}

function updateLicense($id, $informations)
{
    $db = dbConnect();
	
	$query = $db->prepare("UPDATE licenses SET license = :license WHERE id = :id");
    return $query->execute([
        'license' => $informations['license'],
        'id' => $id
    ]);
}

function deleteLicense($id)
{
    $db = dbConnect();
    $query = $db->prepare('DELETE FROM licenses WHERE id = ?');
	return $query->execute([
		$id
	]);    
}