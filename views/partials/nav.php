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
            <a href="index.php?controller=users&action=<?= !empty($_SESSION['user'])? 'display' : 'form&form=login' ?>"><img src="assets/img/icons/user.png" alt="user"></a>
            <?php if(!empty($_SESSION['user'])): ?>
                <i class="fas fa-caret-up"></i>
                <div class="account-submenu">
                    <ul>
                        <?php if($_SESSION['user']['is_admin'] == 1 ): ?>
                            <li><a href="admin/">Administration</a></li>
                        <?php endif; ?>
                        <li><a href="index.php?controller=users&action=display">Mon compte</a></li>
                        <li><a href="index.php?controller=users&action=disconnect">Se déconnecter</a></li>
                    </ul>
                </div>
            <?php endif; ?>
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
    </div>
</nav>
