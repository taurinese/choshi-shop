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
		<h2>Formulaire de la catégorie</h2>
		<form action="index.php?controller=categories&action=<?= 
		isset($category) ||(isset($_SESSION['old_inputs']) && $_GET['action'] != 'new')  ? 'edit&id=' . $_GET['id']  : 'add' ?>" 
		method="post" enctype="multipart/form-data">

			<label for="name">Nom :</label>
			<input  type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($category) ? $category['name'] : '' ?>" /><br>

            <?php if(isset($category) && $category['image'] != null): ?> 
				<span class="badge badge-danger">/!\ Attention, une image principale existe déjà pour cette catégorie /!\</span><br>
			<?php endif; ?>
			<label for="image">Image :</label>
            <input type="file" name="image" id="image" /><br>

			<input type="submit" value="Enregistrer" />

		</form>
    </div>
</main>
