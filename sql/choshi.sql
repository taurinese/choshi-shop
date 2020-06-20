-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 20 juin 2020 à 22:09
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `choshi`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Mangas', '1.png'),
(2, 'Figurines', '2.png'),
(3, 'Vêtements', '3.png'),
(4, 'Alimentation', '4.png'),
(6, 'Box surprise', '6.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categories_products`
--

DROP TABLE IF EXISTS `categories_products`;
CREATE TABLE IF NOT EXISTS `categories_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_products_product_id` (`product_id`),
  KEY `categories_products_category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories_products`
--

INSERT INTO `categories_products` (`id`, `product_id`, `category_id`) VALUES
(11, 2, 2),
(12, 3, 2),
(13, 4, 1),
(14, 5, 3),
(22, 7, 2),
(24, 8, 2),
(25, 6, 2),
(46, 9, 2),
(47, 27, 4),
(58, 28, 2),
(61, 35, 1),
(64, 36, 4),
(65, 37, 2),
(66, 38, 3),
(67, 39, 3),
(68, 40, 4),
(70, 42, 3),
(71, 43, 2),
(72, 44, 4),
(73, 45, 1),
(74, 46, 1),
(75, 47, 1),
(76, 48, 1),
(77, 49, 4),
(78, 50, 3),
(79, 51, 3),
(80, 52, 4),
(81, 53, 1),
(82, 54, 1),
(83, 55, 1),
(84, 56, 1),
(85, 57, 1),
(86, 58, 4),
(87, 59, 3),
(88, 60, 3),
(89, 61, 3),
(90, 62, 3),
(91, 63, 4),
(93, 41, 4),
(96, 1, 2),
(97, 64, 6);

-- --------------------------------------------------------

--
-- Structure de la table `images_products`
--

DROP TABLE IF EXISTS `images_products`;
CREATE TABLE IF NOT EXISTS `images_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `images_products_product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `images_products`
--

INSERT INTO `images_products` (`id`, `product_id`, `image`) VALUES
(5, 9, '9_0.jpg'),
(6, 9, '9_1.jpg'),
(7, 38, '38_0.jpg'),
(8, 39, '39_0.jpg'),
(11, 41, '41_0.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `licenses`
--

DROP TABLE IF EXISTS `licenses`;
CREATE TABLE IF NOT EXISTS `licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `license` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `licenses`
--

INSERT INTO `licenses` (`id`, `license`) VALUES
(2, 'One Piece'),
(3, 'Naruto'),
(4, 'Attack on Titan'),
(5, 'My Hero Academia'),
(6, 'Dragon Ball');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `delivery_address` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `date`, `user_id`, `delivery_address`, `first_name`, `last_name`, `email`) VALUES
(6, '2020-06-17 13:00:04', 3, 'Adresse admin', 'admin1', 'admin', 'admin@admin.com'),
(7, '2020-06-17 14:24:07', 4, 'okok', 'Enzo', 'Moi', 'enzo@mail.com'),
(8, '2020-06-17 14:24:23', 4, 'okok', 'Enzo', 'Moi', 'enzo@mail.com'),
(9, '2020-06-18 09:44:38', 3, 'Adresse admin', 'admin1', 'admin', 'admin@admin.com'),
(10, '2020-06-19 22:16:14', 3, 'Adresse admin', 'admin1', 'admin', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Structure de la table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_products_order_id` (`order_id`),
  KEY `orders_products_product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `name`, `quantity`, `price`) VALUES
(1, 6, 1, 'Jiraya', 2, 34),
(2, 6, 2, 'Livai', 2, 35),
(3, 6, 4, 'One Piece Vol. 96', 2, 12),
(4, 7, 3, 'Erwin', 1, 35),
(5, 7, 5, 'T-shirt Ramen', 2, 35),
(6, 8, 1, 'Jiraya', 1, 34),
(7, 9, 1, 'Jiraya', 47, 34),
(8, 10, 3, 'Erwin', 2, 35);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_displayed` tinyint(1) NOT NULL,
  `main_image` varchar(200) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `license_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_license_id` (`license_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `quantity`, `is_displayed`, `main_image`, `created_at`, `license_id`) VALUES
(1, 'Jiraya', 34, 'Figurine de Jiraya', 0, 1, '1.png', '2020-06-10', 3),
(2, 'Livai', 35, 'Figurine de Livai : eseuinguise nguisen uigsenuignseuig nseiug niusengiusengiuseng uisneuignsei ugnsuiegnsiue ngiusenguisengu isneiugns euign siuengiuseng iusngi usngiusenui', 200, 1, '2.png', '2020-06-10', 4),
(3, 'Erwin', 35, 'Figurine d\'Erwin', 198, 1, '3.png', '2020-06-10', 4),
(4, 'One Piece Vol. 96', 12, 'One Piece Tome 96', 200, 1, '4.png', '2020-06-10', 2),
(5, 'T-shirt Ramen', 35, 'T-shirt imprimé japonais', 200, 1, '5.png', '2020-06-10', NULL),
(6, 'Luxus Draer', 30, 'Figurine de Luxus Draer', 200, 1, '6.png', '2020-06-14', NULL),
(7, 'Sasuke', 30, 'Figurine de Sasuke', 200, 1, '7.png', '2020-06-14', 3),
(8, 'Sagittarius', 30, 'Figurine de Sagittarius', 200, 1, '8.png', '2020-06-14', NULL),
(9, 'Luffy Snake Man', 50.85, 'Figurine de Luffy Snake Man', 200, 1, '9.jpg', '2020-06-17', 2),
(27, 'Cheetos', 5, 'Paquet de chips', 200, 1, '27.jpg', '2020-06-20', NULL),
(28, 'Son Goku', 85, 'Figurine de Son Goku', 50, 1, '28.png', '2020-06-20', 6),
(35, 'Dr Stone Vol 8', 14, 'Manga Dr Stone Volume 8', 200, 1, '35.jpg', '2020-06-20', NULL),
(36, 'Cheetos BBQ', 5, 'Paquet de chips goût BBQ', 200, 1, '36.jpg', '2020-06-20', NULL),
(37, 'Roronoa Zoro', 60, 'Figurine de Roronoa Zoro', 50, 1, '37.png', '2020-06-20', 2),
(38, 'Kimono Fleurs', 39.99, 'Kimono imprimé fleurs', 50, 1, '38.jpg', '2020-06-20', NULL),
(39, 'Kimono Démon', 39.99, 'Kimono imprimé démon', 50, 1, '39.jpg', '2020-06-20', NULL),
(40, 'Coca-Cola Pêche', 3.49, 'Coca-Cola goût Pêche', 200, 1, '40.jpg', '2020-06-20', NULL),
(41, 'Limonade ramune', 2.99, 'Limonade japonaise', 200, 1, '41.jpg', '2020-06-20', NULL),
(42, 'Short Poketto', 25, 'Short Poketto', 50, 1, '42.jpg', '2020-06-20', NULL),
(43, 'Hisoka', 40, 'Figurine de Hisoka', 200, 1, '43.png', '2020-06-20', NULL),
(44, 'Thé vert', 4, 'Thé vert en canette', 200, 1, '44.jpg', '2020-06-20', NULL),
(45, 'Dragon Ball Vol 1', 9.99, 'Dragon Ball Volume 1', 100, 1, '45.jpg', '2020-06-20', 6),
(46, 'Dragon Ball Vol 2', 9.99, 'Dragon Ball Volume 2', 200, 1, '46.jpg', '2020-06-20', 6),
(47, 'Death Note Vol 6', 8.99, 'Death Note Volume 6', 200, 1, '47.jpg', '2020-06-20', NULL),
(48, 'Death Note Vol 13', 8.99, 'Death Note Volume 13', 100, 1, '48.jpg', '2020-06-20', NULL),
(49, 'Pepsi Japan', 2.49, 'Pepsi Japan', 200, 1, '49.jpg', '2020-06-20', NULL),
(50, 'T-shirt Akuma', 15, 'Tee-shirt Akuma', 100, 1, '50.jpg', '2020-06-20', NULL),
(51, 'Cargo Shinobi', 39.99, 'Pantalon cargo shinobi', 50, 1, '51.jpg', '2020-06-20', NULL),
(52, 'Fanta raisin', 3, 'Fanta goût raisin', 100, 1, '52.jpg', '2020-06-20', NULL),
(53, 'MHA Vol 24', 10, 'My Hero Academia Volume 24', 200, 1, '53.jpg', '2020-06-20', 5),
(54, 'MHA Vol 26', 10, 'My Hero Academia Volume 26', 200, 1, '54.jpg', '2020-06-20', 5),
(55, 'MHA Vol 26', 10, 'My Hero Academia Volume 26', 200, 1, '55.jpg', '2020-06-20', 5),
(56, 'One Piece Vol 92', 10.99, 'One Piece Volume 92', 200, 1, '56.jpg', '2020-06-20', 2),
(57, 'One Piece Vol 95', 11.99, 'One Piece Volume 95', 200, 1, '57.jpg', '2020-06-20', 2),
(58, 'Pop Corn Caramel Pêche', 8, 'Pop Corn Caramel Pêche', 100, 1, '58.jpg', '2020-06-20', NULL),
(59, 'Veste Harajuku', 39.99, 'Veste Harajuku', 50, 1, '59.jpg', '2020-06-20', NULL),
(60, 'Yukata Femme Bleu', 45, 'Yukata Femme Bleu', 100, 1, '60.jpg', '2020-06-20', NULL),
(61, 'Yukata Femme Rouge', 45, 'Yukata Femme Rouge', 100, 1, '61.jpg', '2020-06-20', NULL),
(62, 'T-shirt Katsuko', 15, 'Tee-shirt Katsuko', 200, 1, '62.jpg', '2020-06-20', NULL),
(63, 'Salty Litchi', 5, 'Salty Litchi', 100, 1, '63.jpg', '2020-06-20', NULL),
(64, 'Box surprise Juin', 30, 'Box surprise - spécial Juin', 20, 1, '64.jpg', '2020-06-20', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `products_rates`
--

DROP TABLE IF EXISTS `products_rates`;
CREATE TABLE IF NOT EXISTS `products_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `products_rates_product_id` (`product_id`),
  KEY `products_rates_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products_rates`
--

INSERT INTO `products_rates` (`id`, `product_id`, `user_id`, `rate`, `content`, `created_at`) VALUES
(2, 3, 3, 1, 'Article bof', '2020-06-18'),
(3, 2, 3, 4, 'eskj geskij gjesknguisenguiosenuigse', '2020-06-18'),
(4, 1, 17, 5, 'Ce produit est vraiment incroyable je suis super fan !', '2020-06-20'),
(5, 2, 17, 1, 'Je n\'aime pas moi j\'aime le rock et la basse!', '2020-06-20');

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `discount`) VALUES
(3, 'TEST', 50);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `adresse`, `password`, `email`, `is_admin`) VALUES
(3, 'admin1', 'admin', 'Adresse admin', '098f6bcd4621d373cade4e832627b4f6', 'admin@admin.com', 1),
(4, 'Enzo', 'Moi', 'okok', '6b5b0dd03c9c85725032ce5f3a0918ae', 'enzo@mail.com', 0),
(5, 'rgrdeg', 'egregre', 'ergerger', '098f6bcd4621d373cade4e832627b4f6', 'exemple@mail.com', 0),
(7, 'Enzo', 'Oui', 'adresse bateau', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', 0),
(8, 'User', 'Admin', 'Administrator', '21232f297a57a5a743894a0e4a801fc3', 'user@admin.com', 1),
(9, 'Morgan', 'Mosta', 'Regular user address', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@user.com', 0),
(10, 'egege', 'esgsegse', 'segse', '098f6bcd4621d373cade4e832627b4f6', 'e@mail.com', 0),
(14, 'esgseges', 'segseges', 'gegegegege', 'b2a5abfeef9e36964281a31e17b57c97', 'ege@mail.com', 0),
(15, 'segsegseg', 'segsegseg', 'gesgesges', 'b2a5abfeef9e36964281a31e17b57c97', 'gegeg@mail.com', 0),
(16, 'sgsegesggse', 'gsegse', 'egseges', 'bf7dffde1bf23ebb5d9462dafcd857dd', 'egegege@mail.com', 0),
(17, 'Maxibebou', 'Maxichou', 'Chez Maxinounours', 'ff00e77e8acfca03a57527372edd6635', 'maxichou@maxime.com', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories_products`
--
ALTER TABLE `categories_products`
  ADD CONSTRAINT `categories_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_products_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `images_products`
--
ALTER TABLE `images_products`
  ADD CONSTRAINT `images_products_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_products_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_license_id` FOREIGN KEY (`license_id`) REFERENCES `licenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `products_rates`
--
ALTER TABLE `products_rates`
  ADD CONSTRAINT `products_rates_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_rates_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
