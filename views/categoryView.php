<div class="category">
    <h2><?= $currentCategory['name'] ?></h2>
    <div class="category-content flex-row">
        <aside class="filters">
            Filtres
        </aside>
        <div>
            <div class="category-products">
                <?php  foreach($category_products as $product): ?>
                <a href="index.php?controller=products&id=<?= $product['id'] ?>">
                    <div class="flex-center">
                        <img src="assets/img/products/<?= $product['main_image'] ?>" alt="<?= $product['name'] ?>">
                        <h3><?= $product['price'] ?>€</h3>
                        <h3><?= $product['name'] ?></h3>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>