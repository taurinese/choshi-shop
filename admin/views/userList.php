<main class="col-12">
	<?php if(isset($_SESSION['messages'])): ?>
	<div>
		<?php foreach($_SESSION['messages'] as $message): ?>
			<div class="alert <?= $_SESSION['alertSuccess'] == true ? 'alert-success' : 'alert-danger' ?>" role="alert">
                <?= $message ?><br>
            </div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<h2>Liste complète des utilisateurs : </h2>	<a href="index.php?controller=users&action=new"><button type="button" class="btn btn-primary">Ajouter un utilisateur</button></a> 
    <table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($users as $user): ?>
			<tr>
				<th scope="row"><?= $user['id'] ?></th>
                <td><?=  $user['first_name'] ?></td>
                <td><?=  $user['last_name'] ?></td>
                <td><?=  $user['email']  ?></td>
				<td>		<a href="index.php?controller=users&action=edit&id=<?= $user['id'] ?>"><button type="button" class="btn btn-warning">Modifier</button></a>  </td>
				<td>		<a onclick="return confirm('Are you sure?')" href="index.php?controller=users&action=delete&id=<?= $user['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</main>