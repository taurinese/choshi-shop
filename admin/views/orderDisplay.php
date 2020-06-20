<main>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $order[0]['first_name']  ?></td>
                <td><?= $order[0]['last_name']  ?></td>
                <td><?= $order[0]['delivery_address']  ?></td>
                <td><?= $order[0]['email']  ?></td>
            </tr>
        </tbody>
    </table>



    <table class="table">
		<thead>
			<tr>
				<th scope="col">Image</th>
				<th scope="col">Nom</th>
				<th scope="col">Prix unitaire</th>
                <th scope="col">Quantité</th>
                <th scope="col">Prix total</th>
			</tr>
		</thead>
		<tbody>
        <?php foreach($order as $product): ?>
			<tr>
				<th scope="row"><img class="w-50" src="../assets/img/products/<?= $product['main_image'] ?>" alt="<?= $product['name'] ?>"></th>
				<td><?=  $product['name'] ?></td>
				<td><?=  $product['price'] ?></td>
                <td><?= $product['quantity'] ?></td>
                <td><?= $currentTotal = $product['price'] * $product['quantity'] ?>€</td>
                <?php $total += $currentTotal ?>
			</tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total :</td>
            <td><?= $total ?>€</td>
        </tr>
		</tbody>
	</table>
</main>