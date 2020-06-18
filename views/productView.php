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
                <?php foreach($rates as $rate): ?>
                <div class="rate-review">
                    <aside>
                        <h5><?= $rate['first_name'] ?></h5>
                        <span><?php $diff = date_diff($currentDate, date_create($rate['created_at']));
                        echo $diff->format('il y a %d jours'); ?></span>
                    </aside>
                    <div>
                        <div class="stars">
                            <?php for($i = 0; $i < $rate['rate']; $i++ ): ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                            <span><?= $rate['rate'] ?>/5</span>
                        </div>
                        <p>
                            <?= $rate['content'] ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="rate-review">
                    <aside>
                        <h5><?= $_SESSION['user']['first_name'] ?></h5>
                        <span><?= date_create()->format('d-m-Y H:i:s') ?></span>
                    </aside>
                    <div>
                        <form method="post" action="index.php?controller=rates&action=add&id=<?= $_GET['id'] ?>">
                            <div>
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
