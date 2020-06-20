<?php

function getProducts($productId = null)
{
    $db = dbConnect();

    if($productId != null){
        $query = $db->prepare('SELECT p.*, GROUP_CONCAT(cp.category_id), GROUP_CONCAT(ip.image) AS images, GROUP_CONCAT(ip.id) AS img_id FROM products p INNER JOIN categories_products cp ON p.id = cp.product_id LEFT JOIN images_products ip ON ip.product_id = p.id WHERE p.id = ?');
        $query->execute([$productId]);
        return $query->fetch();
    }
    else{
        $query = $db->query('SELECT p.*, GROUP_CONCAT(c.name) FROM products p INNER JOIN categories_products cp ON p.id = cp.product_id INNER JOIN categories c on c.id = cp.category_id GROUP BY p.id');
        return $query->fetchAll();
    }
}


function addProduct($informations)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO products(name, price, description, quantity, is_displayed, license_id) VALUES (:name, :price, :description, :quantity, :is_displayed, :license_id)');
    $result = $query->execute([
		'name' => $informations['name'],
		'price' => $informations['price'],
        'description' => $informations['description'],
        'quantity' => $informations['quantity'],
		'is_displayed' => $informations['is_displayed'],
		'license_id' => $informations['license_id']
    ]);
    $productId = $db->lastInsertId();
	if($result) $result = addProductCategories($productId, $informations['categories']); 

	if($result && !empty($_FILES['main_image']['tmp_name'])){
		$result = updateProductImg(false, $productId);
	}
	if($result && !empty($_FILES['images']['tmp_name'][0])){
		$result = addMultipleProductImg($productId);
	}
    return $result;

}

function deleteProduct($productId)
{
    $db = dbConnect();
	

	$result = productImageExist($productId);
	if(!empty($result)){
		unlink('../assets/img/products/' . $result['main_image']) ;
		if(isset($result['images']) && !empty($result['images'])){
			$images = explode(',', $result['images']);
			foreach($images as $image){
				unlink('../assets/img/products/alt/' . $image) ;
			}
		}
	}
	$query = $db->prepare('DELETE FROM products WHERE id = ?');
	$result = $query->execute([$productId]);
	
	return $result;
}

function updateProduct($id, $informations)
{
    $db = dbConnect();
	
	$query = $db->prepare("UPDATE products SET name = :name, price = :price, description = :description, quantity = :quantity, is_displayed = :is_displayed, license_id = :license_id WHERE id = :id");
	$result = $query->execute([
		'name' => $informations['name'],
        'price' => $informations['price'],
        'description' => $informations['description'],
        'quantity' => $informations['quantity'],
		'is_displayed' => $informations['is_displayed'],
		'license_id' => $informations['license_id'],
		'id' => $id,
	]);
	if($result) $result = deleteProductCategories($id);
	if($result) $result = addProductCategories($id, $informations['categories']); // ici
	if($result && !empty($_FILES['main_image']['tmp_name'])) $result = updateProductImg(true, $id);
	if($result && !empty($_FILES['images']['tmp_name'][0])){
		$result = addMultipleProductImg($id);
	}
	return $result;
}

function updateProductImg($fileMayExists = true, $productId)
{
    $db = dbConnect();
	if($fileMayExists == true){
		//Vérification si image déjà présente
		$images = productImageExist($productId);
		$fileMayExists = !empty($images) ? true : false;
		//Si oui, suppression de l'ancienne image

		if ($fileMayExists){
			unlink('../assets/images/products/' . $images['main_image']) ;
			$fileMayExists = false;
		} 
	}
	if($fileMayExists == false){
		//Insertion de l'image
		$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png', 'jfif' );
		$my_file_extension = pathinfo( $_FILES['main_image']['name'] , PATHINFO_EXTENSION);
		if (in_array($my_file_extension , $allowed_extensions)){
			$new_file_name = $productId . '.' . $my_file_extension ;
			$destination = '../assets/img/products/' . $new_file_name;
			$result = move_uploaded_file( $_FILES['main_image']['tmp_name'], $destination);
			if($result){
				$query = $db->prepare("UPDATE products SET main_image = '$new_file_name' WHERE id = ? ");
				return $query->execute([$productId]);
			}
			
		}
	}
	return false;
	
}

function addMultipleProductImg($productId)
{
	$db = dbConnect();
	$query = $db->prepare('SELECT COUNT(image) FROM images_products WHERE product_id = ?');
	$query->execute([ $productId ]);
	$nbImg = $query->fetchColumn();
	$queryString = 'INSERT INTO images_products (product_id, image) VALUES ';
	$queryValues = array();
	$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png', 'jfif' );
	foreach ($_FILES['images']['name'] as $key => $image) {
		$my_file_extension = pathinfo( $image, PATHINFO_EXTENSION);
		if (in_array($my_file_extension , $allowed_extensions)){
			$new_file_name = $productId . '_' . $nbImg . '.' . $my_file_extension ;
			$destination = '../assets/img/products/alt/' . $new_file_name;
			$result = move_uploaded_file( $_FILES['images']['tmp_name'][$key], $destination);
			if($result){
				$queryString .= "( :product_id_$key , :image_$key )" ;
				if($key !== array_key_last($_FILES['images']['name'])) $queryString .= ',';
				$queryValues["product_id_$key"]= intval($productId);
				$queryValues["image_$key"] = $new_file_name;
			}
			
		}
		$nbImg ++;
	}
	$query = $db->prepare($queryString);
	$result = $query->execute($queryValues);
	return $result;
	
}


function productImageExist($id)
{
    $db = dbConnect();
	$query = $db->prepare('SELECT p.main_image, GROUP_CONCAT(ip.image) AS images FROM products p LEFT JOIN images_products ip ON p.id = ip.product_id WHERE p.id = ?');
	$query->execute([$id]);
	return $query->fetch();
}


function addProductCategories($productId, $categoriesId)
{
    $db = dbConnect();
    $queryString = 'INSERT INTO categories_products (product_id, category_id) VALUES ';
	$queryValues = array();
	foreach($categoriesId as $key => $categoryId){

		//génération dynamique de $queryString
		$queryString .= "( :product_id_$key , :category_id_$key )" ;
		if($key !== array_key_last($categoriesId)) $queryString .= ',';

		//génération dynamique de queryValues
		$queryValues["product_id_$key"]= $productId;
		$queryValues["category_id_$key"] = $categoryId;
	}

	$query = $db->prepare($queryString);
	$result = $query->execute(
		$queryValues
	);
	return $result;
}

function deleteProductCategories($productId)
{
    $db = dbConnect();
    $query = $db->prepare('DELETE FROM categories_products WHERE product_id = ?');
	return $query->execute([
		$productId
	]);
}

function deleteAltImg($imageId)
{
	$db = dbConnect();
	$query = $db->prepare('SELECT image FROM images_products WHERE id = ?');
	$query->execute([ $imageId]);
	$image = $query->fetchColumn();
	$query = $db->prepare('DELETE FROM images_products WHERE id = ?');
	$result = $query->execute([
		$imageId
	]);
	unlink('../assets/img/products/alt/' . $image);
	return $result;
}