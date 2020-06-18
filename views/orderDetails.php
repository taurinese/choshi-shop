<div class="cart-list">
    <table id="cart-table">
        <thead>
            <tr>
                <td>
                    <h3>Commande #<?= $orderDetails[0]['id'] ?></h3>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orderDetails as $index => $orderProduct): ?>
                <tr>
                    <td>
                        <a href="index.php?controller=products&id=<?= $orderProduct['product_id'] ?>">
                            <img class="cart-img" src="assets/img/products/<?= $orderProduct['main_image'] ?>" alt="<?= $orderProduct['name'] ?>">
                        </a>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <?= $orderProduct['name'] ?>
                                </td>
                            </tr>
                            <?php if(isset($orderProduct['license_id'])): ?>
                            <tr>
                                <td>
                                    <?= $orderProduct['license'] ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td>
                                    Prix à l'unité : <?= $orderProduct['price'] ?>€
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Quantité : <?= $orderProduct['quantity'] ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <hr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div id="cart-recap">
        <table>
            <thead>
                <tr>
                    <td>
                        <h3>Prénom</h3>
                    </td>
                    <td>
                        <h3>Nom de famille</h3>
                    </td>
                    <td>
                        <h3>Adresse</h3>
                    </td>
                    <td>
                        <h3>Total</h3>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?= $orderDetails[0]['first_name'] ?>
                    </td>
                    <td>
                        <?= $orderDetails[0]['last_name'] ?>
                    </td>
                    <td>
                        <?= $orderDetails[0]['delivery_address'] ?>
                    </td>
                    <td>
                        <?= $orderDetails[0]['total'] ?>€
                    </td>
                </tr>
            </tbody>
        </table>
</div>