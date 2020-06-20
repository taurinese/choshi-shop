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
		<h2>Formulaire de la licence</h2>
		<form action="index.php?controller=licenses&action=<?= 
		isset($license) ||(isset($_SESSION['old_inputs']) && $_GET['action'] != 'new')  ? 'edit&id=' . $_GET['id']  : 'add' ?>" 
		method="post" enctype="multipart/form-data">

			<label for="license">Licence :</label>
			<input required type="text" name="license" id="license" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['license'] : '' ?><?= isset($license) ? $license['license'] : '' ?>" /><br>
			<input type="submit" value="Enregistrer" />

		</form>
    </div>
</main>
