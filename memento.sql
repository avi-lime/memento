-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2023 at 09:08 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memento`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `landmark` text NOT NULL,
  `locality` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_addresss_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `superadmin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `username`, `superadmin`) VALUES
(3, 'admin@admin.com', '$2y$10$p1hI3LduLkki2cIIsH1WmeHI.dmygMs3mGHNkhWIg/WSlAlERJQBG', 'admin', 1),
(4, 'allahhuakbar911@boomboom.com', '$2y$10$8MWn2jmfEz5BkAGgR6NSqel7gmEtLIZM.EurMbCp9VxY4mNtgMiN.', 'allah hu akbar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cart_product` (`product_id`),
  KEY `FK_card_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(11, 'Active wear', '1677002061.png'),
(12, 'Casual wear', '1677001996.jpg'),
(13, 'Professional wear', '1677002044.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `extra_expenses` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_user` (`user_id`),
  KEY `FK_order_product` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `address_id`, `amount`, `status`, `date`, `extra_expenses`, `quantity`) VALUES
(1, 1, 7, 1, 123, 'asd', 123, 123, 123);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_payment_order` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `description` text NOT NULL,
  `discount` int(3) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `subcat_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_cat` (`cat_id`),
  KEY `FK_product_sub` (`subcat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `quantity`, `description`, `discount`, `cat_id`, `subcat_id`) VALUES
(7, 'Shelby Valdez', 520, 11, 'Velit iusto quo cul', 20, 12, 11),
(15, 'Shelby Valdez', 520, 11, 'Velit iusto quo cul', 11, 12, 11),
(20, 'Teegan Ray', 452, 510, 'Laboris lorem minim ', 74, 13, 12),
(22, 'Connor Weber', 968, 38, 'Et enim repudiandae ', 2, 13, 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_image` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`) VALUES
(18, 20, '16770125620.png'),
(19, 20, '16770125621.png'),
(20, 20, '16770125622.png'),
(21, 15, '16770129240.png'),
(22, 15, '16770129241.png'),
(23, 15, '16770129242.png'),
(27, 7, '16770129580.png'),
(28, 7, '16770129581.png'),
(29, 7, '16770129582.png'),
(30, 22, '16770130220.png'),
(31, 22, '16770130221.png'),
(32, 22, '16770130222.png');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `content`, `image`) VALUES
(2, 'Bevis Baldwin', '1677013293.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subcat`
--

DROP TABLE IF EXISTS `subcat`;
CREATE TABLE IF NOT EXISTS `subcat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_sub_cat` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcat`
--

INSERT INTO `subcat` (`id`, `name`, `cat_id`, `image`) VALUES
(10, 'Mandarin shirt', 11, '1677002251.png'),
(11, 'T-Shirts', 12, '1677002262.png'),
(12, 'Blazers', 13, '1677002269.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobileno` varchar(10) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `mobileno`, `state`, `city`, `image`) VALUES
(1, 'Avi', 'sa3198154@gmail.com', '$2y$10$Zk6ThOmwRDgv5UtLSrMqk.bm9p9vHKaSymjMEBqCWG1BaamcblXHO', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_addresss_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_card_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_cart_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_order_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_payment_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_product_sub` FOREIGN KEY (`subcat_id`) REFERENCES `subcat` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `FK_product_image` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `subcat`
--
ALTER TABLE `subcat`
  ADD CONSTRAINT `FK_sub_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
