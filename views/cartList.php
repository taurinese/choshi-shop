<div class="cart-list">
    <table id="cart-table">
        <thead>
            <tr>
                <td>
                    Mon panier
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cartProducts as $cartProduct): ?>
                <tr>
                    <td>
                        <img class="cart-img" src="assets/img/products/<?= $cartProduct['main_image'] ?>" alt="<?= $cartProduct['name'] ?>">
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <?= $cartProduct['name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?= $cartProduct['license_id'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Prix à l'unité : <?= $cartProduct['price'] ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>