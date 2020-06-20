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
		<h2>Formulaire de l'utilisateur</h2>
		<form action="index.php?controller=users&action=<?= 
		isset($user) ||(isset($_SESSION['old_inputs']) && $_GET['action'] != 'new')  ? 'edit&id=' . $_GET['id']  : 'add' ?>" 
		method="post" enctype="multipart/form-data">

			<label for="first_name">Prénom :</label>
			<input required type="text" name="first_name" id="first_name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['first_name'] : '' ?><?= isset($user) ? $user['first_name'] : '' ?>" /><br>
			<label for="last_name">Nom de famille :</label>
			<input required type="text" name="last_name" id="last_name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['last_name'] : '' ?><?= isset($user) ? $user['last_name'] : '' ?>" /><br>
            <label for="adresse">Adresse :</label>
			<input required type="text" name="adresse" id="adresse" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['adresse'] : '' ?><?= isset($user) ? $user['adresse'] : '' ?>" /><br>
            <label for="email">Email :</label>
			<input required type="email" name="email" id="email" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['email'] : '' ?><?= isset($user) ? $user['email'] : '' ?>" /><br>
			<label for="password">Mot de passe :</label>
			<input required type="password" name="password" id="password" value="" /><br>
            <label for="is_admin">Administrateur :</label>
            <select name="is_admin" id="is_admin" required>
                <option value="0" <?php if(isset($user) && $user['is_admin'] == '0'): ?> selected="selected" <?php endif; ?>>Non</option>
                <option value="1" <?php if(isset($user) && $user['is_admin'] == '1'): ?> selected="selected" <?php endif; ?>>Oui</option>
            </select><br>
			<input type="submit" value="Enregistrer" />

		</form>
    </div>
</main>
