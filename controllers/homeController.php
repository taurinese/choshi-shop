<?php

require 'models/Product.php';

$newProducts = getNewProducts();

$view['content'] = 'views/homeView.php';
$view['title'] = "Page d'accueil";