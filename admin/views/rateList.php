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

	<h2>Liste complète des avis : </h2> 
    <table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Note</th>
                <th scope="col">Produit</th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($rates as $rate): ?>
			<tr>
				<th scope="row"><?= $rate['id'] ?></th>
                <td><?=  $rate['first_name'] ?></td>
                <td><?=  $rate['last_name'] ?></td>
                <td><?=  $rate['rate']  ?></td>
                <td><?=  $rate['name']  ?></td>
				<td><a href="index.php?controller=rates&action=display&id=<?= $rate['id'] ?>"><button type="button" class="btn btn-warning">Afficher</button></a>  </td>
				<td><a onclick="return confirm('Are you sure?')" href="index.php?controller=rates&action=delete&id=<?= $rate['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</main>