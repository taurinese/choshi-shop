<main class="d-flex flex-row col-9 justify-content-around">
	
	<div> <!-- Div du formulaire -->
		<?php if(isset($_SESSION['messages'])): ?>
			<div>
				<?php foreach($_SESSION['messages'] as $message): ?>
					<div class="alert <?= $_SESSION['alertSuccess'] == true ? 'alert-success' : 'alert-danger' ?>" role="alert">
						<?= $message ?><br>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?> <br>
		<h2>Formulaire du produit</h2>
		<form action="index.php?controller=products&action=<?= 
		isset($product) ||(isset($_SESSION['old_inputs']) && $_GET['action'] != 'new')  ? 'edit&id=' . $_GET['id']  : 'add' ?>" 
		method="post" enctype="multipart/form-data">

			<label for="name">Nom :</label>
			<input  type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($product) ? $product['name'] : '' ?>" /><br>
			
            <label for="price">Prix :</label>
			<input  type="text" name="price" id="price" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['price'] : '' ?><?= isset($product) ? $product['price'] : '' ?>" /><br>

            <label for="categories[]">Catégories :</label>
            <select name="categories[]" id="categories[]" multiple>
                <?php foreach($categories as $category): ?>
					<option value="<?= $category['id'] ?>" <?php if(isset($selectedCategories) && in_array($category['id'], $selectedCategories)): ?> selected="selected" <?php endif; ?>><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="description">Description :</label>
			<input  type="text" name="description" id="description" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['description'] : '' ?><?= isset($product) ? $product['description'] : '' ?>" /><br>

            <label for="quantity">Quantité :</label>
			<input  type="text" name="quantity" id="quantity" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['quantity'] : '' ?><?= isset($product) ? $product['quantity'] : '' ?>" /><br>

			<label for="license_id">Licence :</label>
			<select name="license_id" id="license_id">
					<option value=""></option>
				<?php foreach($licenses as $license): ?>
					<option value="<?= $license['id'] ?>" <?php if(isset($product) && $license['id'] == $product['license_id']): ?> selected="selected" <?php endif; ?>><?= $license['license'] ?></option>
				<?php endforeach; ?>
			</select><br>


			<label for="is_displayed">Afficher le produit :</label>
					<input type="checkbox" name="is_displayed" id="is_displayed" value="1" <?php if(isset($product) && $product['is_displayed'] == 1): ?> checked <?php endif; ?>><br>

            <?php if(isset($product) && $product['main_image'] != null): ?> 
				<span class="badge badge-danger">/!\ Attention, ajouter une nouvelle image principale supprimera l'actuelle /!\</span><br>
				<img class="w-25" src="../assets/img/products/<?= $product['main_image'] ?>" alt="<?= $product['name'] ?>"><br>
			<?php endif; ?>
			<label for="main_image">Image principale :</label>
            <input type="file" name="main_image" id="main_image" /><br>
			
			<label for="images[]">Images secondaires :</label>
			<?php if(isset($images)): ?>
			<table class="table">
				<tr>
				<?php foreach($images as $key => $image): ?>
						<td>
							<img class="w-25" src="../assets/img/products/alt/<?= $image ?>" alt="<?= $product['name'] ?>"><br>
							<a onclick="return confirm('Are you sure?')" href="index.php?controller=products&action=delete_img&id=<?= $_GET['id'] ?>&img_id=<?= $images_id[$key] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
						</td>
				<?php endforeach; ?>
				</tr>
			</table>
			<?php endif; ?>
			<input type="file" name="images[]" id="images[]" multiple="multiple" /><br>
			
			<input type="submit" value="Enregistrer" />

		</form>
    </div>
</main>
