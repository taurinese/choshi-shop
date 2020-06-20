<nav id="nav-bar">
    <div class="nav-container">
        <div>
            <a href=""><span class="material-icons" id="icon-burger"> menu </span></a>
        </div>
        <div>
            <img src="assets/img/icons/search.png" alt="search" id="icon-search">
            <div class="search-bar">
                <input type="text" name="search-input" id="search-input" autocomplete="off">
            </div>
        </div>
        <div>
            <a href="index.php"><img src="assets/img/logo_choshi.png" alt="Logo choshi" id="logo-nav"></a>
        </div>
        <div>
            <img src="assets/img/icons/user.png" alt="user">
            <i class="fas fa-caret-up"></i>
            <div class="account-submenu">
                <ul>
                    <?php if(!empty($_SESSION['user']) && $_SESSION['user']['is_admin'] == 1 ): ?>
                        <li><a href="admin/">Administration</a></li>
                    <?php endif; ?>
                    <?php if(!empty($_SESSION['user'])): ?>
                    <li><a href="index.php?controller=users&action=display">Mon compte</a></li>
                    <li><a href="index.php?controller=users&action=disconnect">Se déconnecter</a></li>
                    <?php else: ?>
                    <li><a href="index.php?controller=users&action=form&form=login">Se connecter</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div>
            <a href="index.php?controller=cart&action=list"><span id="cart-qty"><?= count($_SESSION['cart']) ?></span><img src="assets/img/icons/cart.png" alt="cart"></a>
        </div>
    </div>
    <div class="burger">
        <div class="burger-row">
            <?php foreach($categories as $category): ?>
                <a href="index.php?controller=categories&id=<?= $category['id'] ?>" class="menu-category">
                    <img src="assets/img/categories/<?= $category['image'] ?>" alt="<?= $category['name'] ?>">
                </a>
            <?php endforeach; ?>
        </div>
        <div class="burger-row">
            <?php if(isset($_SESSION['user'])): ?>
                <?php if($_SESSION['user']['is_admin'] == 1): ?>
                    <a href="admin/" class="menu-category">
                        <button class="admin-btn">Administration</button>
                    </a>
                <?php endif; ?>
                <a href="index.php?controller=users&action=display" class="menu-category">
                    <button class="user-btn">Mon compte</button>
                </a>
                <a href="index.php?controller=users&action=disconnect" class="menu-category">
                    <button class="user-btn">Se déconnecter</button>
                </a>
            <?php else: ?>
                <a href="index.php?controller=users&action=form&form=login" class="menu-category">
                    <button class="user-btn">Se connecter / S'inscrire</button>
                </a>
            <?php endif; ?>
            <?php foreach($categories as $category): ?>
                <a href="index.php?controller=categories&id=<?= $category['id'] ?>" class="menu-category">
                    <button class="category-btn"><?= $category['name'] ?></button>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>
