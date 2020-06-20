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

	<h2>Liste complète des promotions : </h2>	<a href="index.php?controller=promotions&action=new"><button type="button" class="btn btn-primary">Ajouter une promotion</button></a> 
    <table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
                <th scope="col">Code promo</th>
                <th scope="col">Montant</th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($promotions as $promotion): ?>
			<tr>
				<th scope="row"><?= $promotion['id'] ?></th>
                <td><?=  $promotion['name'] ?></td>
                <td><?=  $promotion['discount'] ?>%</td>
				<td><a href="index.php?controller=promotions&action=edit&id=<?= $promotion['id'] ?>"><button type="button" class="btn btn-warning">Modifier</button></a>  </td>
				<td><a onclick="return confirm('Are you sure?')" href="index.php?controller=promotions&action=delete&id=<?= $promotion['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</main>