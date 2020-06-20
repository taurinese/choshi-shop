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

	<h2>Liste complète des licences : </h2>	<a href="index.php?controller=licenses&action=new"><button type="button" class="btn btn-primary">Ajouter une licence</button></a> 
    <table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
                <th scope="col">Licence</th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($licenses as $license): ?>
			<tr>
				<th scope="row"><?= $license['id'] ?></th>
                <td><?=  $license['license'] ?></td>
				<td><a href="index.php?controller=licenses&action=edit&id=<?= $license['id'] ?>"><button type="button" class="btn btn-warning">Modifier</button></a>  </td>
				<td><a onclick="return confirm('Are you sure?')" href="index.php?controller=licenses&action=delete&id=<?= $license['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</main>