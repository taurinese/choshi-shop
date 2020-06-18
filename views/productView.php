<div class="product-content">
    <div class="product-row">
        <aside class="product-img">
            <div class="alternate-images">
                <img src="assets/img/products/<?= $selectedProduct['main_image'] ?>" alt="<?= $selectedProduct['name'] ?>" class="alt-img">
                <?php if(!empty($images)): ?>
                    <?php foreach($images as $altImg): ?>
                        <img src="assets/img/products/alt/<?= $altImg ?>" alt="<?= $selectedProduct['name'] ?>" class="alt-img">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="main-img">
                <img src="assets/img/products/<?= $selectedProduct['main_image'] ?>" alt="<?= $selectedProduct['name'] ?>" id="current-img">
            </div>
        </aside>
        <aside class="product-desc">
            <h3><?= $selectedProduct['name'] ?></h3>
            <h3><?= $selectedProduct['price'] ?>€</h3>
            <h3>Description : </h3>
            <p><?= $selectedProduct['description'] ?></p>
            <h3>Licence : <?= $selectedProduct['license_name'] ?></h3>
            <h3>Quantité : <button id="decrement-qtt">-</button><input type="number" name="product-quantity" id="product-quantity" value="0" min="0" max="<?= $selectedProduct['quantity'] ?>"><button id="increment-qtt">+</button></h3>
            <button type="submit" id="add-cart">Ajouter au panier</button>
        </aside>
    </div>
    <div class="product-row rates">
        <h3>Avis</h3><br>
        <div class="rate-content">
            <aside id="product-display">
                <h4><?= $selectedProduct['name'] ?></h4>
                <img src="assets/img/products/<?= $selectedProduct['main_image'] ?>" alt="<?= $selectedProduct['name'] ?>"><br>
                <!-- Notes / 5 -->
                <!-- Nb d'avis -->
                <button>Donner mon avis</button><br>
                <button>Voir tous les avis</button><br>
            </aside>
            <div class="rates-views">
                <div class="rate-review">
                    <aside>
                        <h5>Prénom</h5>
                        <span>il y a x jours</span>
                    </aside>
                    <div>
                        <div>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            5/5
                        </div>
                        <p>
                            Ce produit est vraiment super ! Quel produit incroyable wow !
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>