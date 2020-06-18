<?php

require 'models/Product.php';

$newProducts = getNewProducts();
$popularProducts = getPopularProducts();
$view['content'] = 'views/homeView.php';
$view['title'] = "Page d'accueil";