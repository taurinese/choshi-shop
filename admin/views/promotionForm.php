<main class="d-flex flex-row col-12 justify-content-around">
	
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
		<h2>Formulaire de la promotion</h2>
		<form action="index.php?controller=promotions&action=<?= 
		isset($promotion) ||(isset($_SESSION['old_inputs']) && $_GET['action'] != 'new')  ? 'edit&id=' . $_GET['id']  : 'add' ?>" 
		method="post" enctype="multipart/form-data">

			<label for="name">Nom :</label>
			<input required type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?><?= isset($promotion) ? $promotion['name'] : '' ?>" /><br>
			<label for="discount">Promotion :</label>
			<input required type="text" name="discount" id="discount" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['discount'] : '' ?><?= isset($promotion) ? $promotion['discount'] : '' ?>" /><br>
			<input type="submit" value="Enregistrer" />

		</form>
    </div>
</main>
