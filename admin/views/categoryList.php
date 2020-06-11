<main class="col-9">
	<?php if(isset($_SESSION['messages'])): ?>
	<div>
		<?php foreach($_SESSION['messages'] as $message): ?>
			<div class="alert <?= $_SESSION['alertSuccess'] == true ? 'alert-success' : 'alert-danger' ?>" role="alert">
                <?= $message ?><br>
            </div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<h2>Liste complète des catégories : </h2>	<a href="index.php?controller=categories&action=new"><button type="button" class="btn btn-primary">Ajouter une catégorie</button></a> 
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nom</th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($categories as $category): ?>
			<tr>
				<th scope="row"><?= $category['id'] ?></th>
				<td><?=  htmlspecialchars($category['name']) ?></td>
				<td class="w-25"><a href="index.php?controller=categories&action=edit&id=<?= $category['id'] ?>"><button type="button" class="btn btn-warning">Modifier</button></a>  </td>
				<td class="w-25"><a onclick="return confirm('Are you sure?')" href="index.php?controller=categories&action=delete&id=<?= $category['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</main>