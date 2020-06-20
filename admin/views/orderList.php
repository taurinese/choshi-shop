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

	<h2>Liste complète des commandes : </h2>

	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Prénom</th>
				<th scope="col">Nom</th>
				<th scope="col">Nombre de produits</th>
                <th scope="col">Total</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($orders as $order): ?>
			<tr>
				<th scope="row"><?= $order['id'] ?></th>
				<td><?=  $order['first_name'] ?></td>
				<td><?=  $order['last_name'] ?></td>
				<td><?= $order['nb_products'] ?></td>
				<td><?=  $order['total'] ?>€</td>
				<td><a href="index.php?controller=orders&action=display&id=<?= $order['id'] ?>"><button type="button" class="btn btn-warning">Aperçu</button></a> </td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</main>