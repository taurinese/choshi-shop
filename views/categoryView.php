<div class="category">
    <h2><?= $currentCategory['name'] ?></h2>
    <button id="filter-btn">Filtres</button>
    <div class="category-content flex-row">
        <aside class="filters">
            <h5>Filtres</h5>
            <!-- Seulement un filtre actif à la fois et boutons filtres non développés en responsive -->
            <ul>
                <li>
                    <h5>En stock</h5>
                    <form action="index.php?controller=categories&id=<?= $_GET['id'] ?><?php if(!isset($_GET['filter']) || $_GET['filter'] != 'stock'): ?>&filter=stock<?php endif; ?>" id="filter_form_1">
                        <input type="checkbox" name="in_stock" id="in_stock" onclick="window.location.href = document.getElementById('filter_form_1').action" <?php if(isset($_GET['filter']) &&$_GET['filter'] == 'stock'): ?> checked <?php endif ?>>
                        <input type="submit" value="" hidden>
                    </form>
                </li>
                <li>
                    <h5>Prix</h5>
                    <form action="index.php?controller=categories&id=<?= $_GET['id'] ?><?php if(!isset($_GET['filter']) || $_GET['filter'] != 'price-asc'): ?>&filter=price-asc<?php endif; ?>" id="filter_form_2">
                        <input type="checkbox" name="price-asc" id="price-asc" onclick="window.location.href = document.getElementById('filter_form_2').action" <?php if(isset($_GET['filter']) &&$_GET['filter'] == 'price-asc'): ?> checked <?php endif ?>>
                        <label for="price-asc">Croissant</label>
                        <input type="submit" value="" hidden>
                    </form>
                    <form action="index.php?controller=categories&id=<?= $_GET['id'] ?><?php if(!isset($_GET['filter']) || $_GET['filter'] != 'price-desc'): ?>&filter=price-desc<?php endif; ?>" id="filter_form_3">
                        <input type="checkbox" name="price-desc" id="price-desc" onclick="window.location.href = document.getElementById('filter_form_3').action" <?php if(isset($_GET['filter']) &&$_GET['filter'] == 'price-desc'): ?> checked <?php endif ?>>
                        <label for="price-desc">Décroissant</label>
                        <input type="submit" value="" hidden>
                    </form>
                </li>
            </ul>
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