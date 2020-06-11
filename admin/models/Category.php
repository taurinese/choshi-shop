<?php

function getCategories($categoryId = null)
{
    $db = dbConnect();

    if($categoryId != null){
        $query = $db->prepare('SELECT * FROM categories WHERE id = ?');
        $query->execute([$categoryId]);
        return $query->fetch();
    }
    else{
        $query = $db->query('SELECT * FROM categories');
        return $query->fetchAll();
    }
}


function addCategory($categoryName)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO categories (name) VALUES (?)');
    $result = $query->execute([ $categoryName]);
    $categoryId = $db->lastInsertId();
	if($result && !empty($_FILES['image']['tmp_name'])){
		$result = updateCategoryImg(false, $categoryId);
    }
    return $result;
}

function updateCategory($id, $category)
{
    $db = dbConnect();
    $query = $db->prepare("UPDATE categories SET name = :name WHERE id = :id");
    $result = $query->execute([ 'name' => $category['name'], 'id' => $id]);
	if($result && !empty($_FILES['image']['tmp_name'])){
		$result = updateCategoryImg(true, $id);
    }
    return $result;
}

function deleteCategory($categoryId)
{
    $db = dbConnect();
	
	//ne pas oublier de supprimer le fichier lié s'il y en un
	//avec la fonction unlink de PHP
	$result = categoryImageExist($categoryId);
	if(!empty($result)) unlink('../assets/images/categories/' . $result['image']) ;
	$query = $db->prepare('DELETE FROM categories WHERE id = ?');
	$result = $query->execute([$categoryId]);
	
	return $result;
}

function updateCategoryImg($fileMayExists = true, $categoryId)
{
    $db = dbConnect();
	if($fileMayExists == true){
		//Vérification si image déjà présente
		$image = categoryImageExist($categoryId, $db);
		$fileMayExists = !empty($image['image']) ? true : false;
		//Si oui, suppression de l'ancienne image
		if ($fileMayExists){
                unlink('../assets/images/categories/' . $image['image']) ;
			$fileMayExists = false;
		} 
	}
	if($fileMayExists == false){
		//Insertion de l'image
		$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png', 'jfif' );
		$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);
		if (in_array($my_file_extension , $allowed_extensions)){
			$new_file_name = $categoryId . '.' . $my_file_extension ;
			$destination = '../assets/img/categories/' . $new_file_name;
			$result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);
			if($result){
				$query = $db->prepare("UPDATE categories SET image = '$new_file_name' WHERE id = ? ");
				return $query->execute([$categoryId]);
			}
			
		}
	}
	return false;
	
}

function categoryImageExist($id)
{
    $db = dbConnect();
	$query = $db->prepare('SELECT image FROM categories WHERE id = ?');
	$query->execute([$id]);
	$result = $query->fetch();
	return $result;
}