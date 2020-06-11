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
			<select name="is_displayed" id="is_displayed">
				<option value="0" <?php if(isset($product) && $product['is_displayed'] == false): ?> selected="selected" <?php endif; ?>>Non</option>
                <option value="1" <?php if(isset($product) && $product['is_displayed'] == true): ?> selected="selected" <?php endif; ?>>Oui</option>
            </select><br>

            <?php if(isset($product) && $product['main_image'] != null): ?> 
				<span class="badge badge-danger">/!\ Attention, une image principale existe déjà pour ce produit /!\</span><br>
			<?php endif; ?>
			<label for="main_image">Image principale :</label>
            <input type="file" name="main_image" id="main_image" /><br>
            
            <label for="images[]">Images secondaires :</label>
			<input type="file" name="images[]" id="images[]" multiple="multiple" /><br>
			
			<input type="submit" value="Enregistrer" />

		</form>
    </div>
    




<!-- 	<?php if(isset($artist)): ?>
		<div class="card" style="width: 18rem;">
			<h3 class="border-dark border-bottom">Affichage de l'artiste</h3>
			<?php if(!empty($artist['image'])): ?>
				<img class="card-img-top" src="../assets/images/artist/<?= $artist['image'] ?>" alt="Card image cap">
			<?php endif; ?>
			<div class="card-body">
				<h5 class="card-title"><?= $artist['name'] ?></h5>
				<?php foreach($artist_labels as $a_label): ?>
					<h6 class="card-title"><?= $a_label['name'] ?></h6>
				<?php endforeach; ?>
				<p class="card-text"><?= $artist['biography'] ?></p>
		</div>
	<?php endif; ?> -->
</main>
