<div class="cart-list">
    <?php if (isset($cartProducts)): ?>
    <table id="cart-table">
        <thead>
            <tr>
                <td>
                    <h3>Mon panier</h3>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cartProducts as $index => $cartProduct): ?>
                <tr>
                    <td>
                        <img class="cart-img" src="assets/img/products/<?= $cartProduct['main_image'] ?>" alt="<?= $cartProduct['name'] ?>">
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <?= $cartProduct['name'] ?>
                                    <a href="index.php?controller=cart&action=delete&id=<?= $cartProduct['id'] ?>" onclick="confirm('Êtes-vous surs de supprimer cet article de votre panier?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php if(isset($cartProduct['license_id'])): ?>
                            <tr>
                                <td>
                                    <?= $cartProduct['license'] ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td>
                                    Prix à l'unité : <?= $cartProduct['price'] ?>€
                                </td>
                            </tr>
                            <tr>
                                <td>
                            <div class="qtt-buttons"><span>Quantité : </span><button id="decrement-qtt">-</button><input type="number" name="product-quantity" id="<?= $cartProduct['id'] ?>" value="<?php foreach($_SESSION['cart'] as $cart_product): ?><?php if($cartProduct['id'] == $cart_product['product_id']): ?><?= $cart_product['quantity'] ?><?php endif; ?><?php endforeach; ?>" min="0" max="<?= $cartProduct['quantity'] ?>"><button id="increment-qtt">+</button></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div id="cart-recap">
        <table>
            <thead>
                <tr>
                    <td>
                        <h3>MONTANT DE VOTRE PANIER</h3>
                        <hr>
                    </td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($cartProducts as $key => $cartProduct): ?>
                <tr>
                    <td class="table-row-flex">
                        <span><?= $cartProduct['name'] ?></span>
                        <span><?php foreach($_SESSION['cart'] as $cart_product): ?><?php if($cartProduct['id'] == $cart_product['product_id']): ?><?= $cart_product['quantity'] ?><?php endif; ?><?php endforeach; ?> x <?= $cartProduct['price'] ?>€</span>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td class="table-row-flex">
                    <span>TOTAL</span>
                    <span><?= $total ?>€</span>
                </td>
            </tr>
            </tbody>
        </table>
        <a href="index.php?controller=orders&action=add">
            <button id="cart-add">
                Valider mon panier
            </button>
        </a>
        <?php else: ?>
        <div class="cart-message">
            <h4> Votre panier est vide ! </h4>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php var_dump($_SESSION); ?>