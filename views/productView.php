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
            <h3>Quantité : <button id="decrement-qtt">-</button><input type="number" name="product-quantity" id="product-quantity" value="1" min="1" max="<?= $selectedProduct['quantity'] ?>"><button id="increment-qtt">+</button></h3>
            <button type="submit" id="add-cart">Ajouter au panier</button>
        </aside>
    </div>
    <div class="product-row rates">
        <h3>Avis</h3><br>
        <div class="rate-content">
            <div class="rates-views">
                <div class="rate-review">
                    <aside>
                        <h5>Prénom</h5>
                        <span>il y a x jours</span>
                    </aside>
                    <div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <span><?= '5' ?>/5</span>
                        </div>
                        <p>
                            Ce produit est vraiment super ! Quel produit incroyable wow !
                        </p>
                    </div>
                </div>

                <div class="rate-review">
                    <aside>
                        <h5><?= $_SESSION['user']['first_name'] ?></h5>
                        <span><?= strftime("%A %d %B %G", strtotime(time())) ?></span>
                    </aside>
                    <div>
                        <form method="post" action="index.php?controller=rates&action=add&id=<?= $_GET['id'] ?>">
                            <div>
                            <div class="stars-outer">
                                <div class="stars-inner"></div>
                            </div>
                                <input type="text" name="product-rate" id="product-rate"> /5
                            </div>
                        
                            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                            <input type="submit" id="rate-submit" value="Commenter">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
