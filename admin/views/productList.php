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

	<h2>Liste complète des produits : </h2>	<a href="index.php?controller=products&action=new"><button type="button" class="btn btn-primary">Ajouter un produit</button></a> 

	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Catégories</th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($products as $product): ?>
			<tr>
				<th scope="row"><?= $product['id'] ?></th>
                <td><?=  $product['name'] ?></td>
                <td><?=  $product['GROUP_CONCAT(c.name)'] ?></td>
				<td><a href="index.php?controller=products&action=edit&id=<?= $product['id'] ?>"><button type="button" class="btn btn-warning">Modifier</button></a>  </td>
				<td><a onclick="return confirm('Are you sure?')" href="index.php?controller=products&action=delete&id=<?= $product['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></p></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</main>