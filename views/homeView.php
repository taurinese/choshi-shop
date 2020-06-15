<div class="box-content">
    <div class="box-surprise">
        <img src="assets/img/box-choshi-adobexd.png" alt="Box surprise">
        <h2>NOUVELLE BOX SURPRISE <br> DISPONIBLE DES MAINTENANT</h2>
    </div>
</div>
<div class="product-box popular">
    <div class="box-title">
        <div>
            <div class="red-square"></div>
            <div class="green-square"></div>
            <div class="blue-square"></div>
            <h1>POPULAIRES</h1>
            <div class="blue-square"></div>
            <div class="green-square"></div>
            <div class="red-square"></div>
        </div>

        <p>Les produits les plus prisés du moment</p>
    </div>
    <div class="products">
    <?php foreach($newProducts as $product): ?>
        <div class="flex-center">
            <a href="index.php?controller=products&id=<?= $product['id'] ?>">
                <img src="assets/img/products/<?= $product['main_image'] ?>" alt="<?= $product['name'] ?>" class="img-products">
                <h2><?= $product['price'] ?> €</h2>
                <h2><?= $product['name'] ?></h2>
                <p><?= $product['description'] ?></p>
            </a>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<div class="product-box novelty">
    <div class="box-title">
    <div>
            <div class="red-square"></div>
            <div class="green-square"></div>
            <div class="blue-square"></div>
            <h1>NOUVEAUTÉS</h1>
            <div class="blue-square"></div>
            <div class="green-square"></div>
            <div class="red-square"></div>
        </div>
        <p>Les produits les plus récents</p>
    </div>
    <div class="products">
    <?php foreach($newProducts as $product): ?>
        <div class="flex-center">
            <a href="index.php?controller=products&id=<?= $product['id'] ?>">
                <img src="assets/img/products/<?= $product['main_image'] ?>" alt="<?= $product['name'] ?>" class="img-products">
                <h2><?= $product['price'] ?> €</h2>
                <h2><?= $product['name'] ?></h2>
                <p><?= $product['description'] ?></p>
            </a>
        </div>
    <?php endforeach; ?>
    </div>
</div>
