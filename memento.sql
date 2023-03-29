-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2023 at 07:22 PM
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
  `addressname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` text NOT NULL,
  `pincode` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_addresss_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `addressname`, `address`, `user_id`, `city`, `state`, `country`, `pincode`) VALUES
(1, 'Jigyasu Sharma', 'Shubh Mangal Appartment,opp SBI Bank, Adajan', 2, 'surat', 'Gujarat', 'sad', 395009);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `username`, `superadmin`) VALUES
(3, 'admin@admin.com', '$2y$10$p1hI3LduLkki2cIIsH1WmeHI.dmygMs3mGHNkhWIg/WSlAlERJQBG', 'admin', 1),
(4, 'allahhuakbar911@boomboom.com', '$2y$10$8MWn2jmfEz5BkAGgR6NSqel7gmEtLIZM.EurMbCp9VxY4mNtgMiN.', 'allah hu akbar', 0),
(6, 'sa3198154+admin@gmail.com', '$2y$10$xnoWTawUw7cOUgDDNfXqa.au9NX1asVTMrLOfsxFIHrCH/HcaSLsO', 'avi', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `size`, `user_id`) VALUES
(25, 3, 3, 'm', 1),
(26, 3, 2, 'l', 2),
(32, 4, 1, 'm', 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(12, 'Casual wear', '1677211700.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_user` (`user_id`),
  KEY `FK_order_product` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `product_id`, `address_id`, `amount`, `status`, `date`, `quantity`, `size`) VALUES
(10, 'order_LXOFKKfLprSUL4', 3, 3, 1, 399, NULL, '2023-03-29 21:00:30', 1, 'm'),
(11, 'order_LXOGr2XDS8tR6g', 3, 5, 1, 749, NULL, '2023-03-29 21:01:57', 1, 'l');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `transaction_date`, `payment_mode`, `status`, `amount`) VALUES
(8, 'order_LXOFKKfLprSUL4', '2023-03-29 21:00:30', 'NetBanking', 'Completed', 399),
(9, 'order_LXOGr2XDS8tR6g', '2023-03-29 21:01:57', 'NetBanking', 'Completed', 749);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `quantity`, `description`, `discount`, `cat_id`, `subcat_id`) VALUES
(3, 'Coding', 499, 40, 'Eat, Sleep, Code, Repeat!\r\n\r\nNo Errors here.', 30, 12, 11),
(4, 'Real Lies', 699, 30, 'Real eyes\r\nRealize\r\nReal lies\r\n\r\n', 21, 12, 13),
(5, 'Spider Sense', 999, 20, 'Your Friendly Neighborhood Spider-Man\r\n\r\nP.S. Don\'t forget the hyphen!\r\n\r\n', 25, 12, 14),
(6, 'Itachi\'s Genjutsu', 999, 20, 'Itachi Uchiha\r\n\r\nYou\'re already under his genjutsu', 25, 12, 14),
(7, 'Dust Brick BVM', 999, 30, 'One of our first and favorite Hoodies.\r\n\r\nFrom the collaboration and exhibition done at BVM college', 25, 12, 14),
(8, 'Illusion', 999, 10, 'One\'s reality is another\'s illusion\r\n\r\nLimited Edition, Memento Blue Hoodie\r\n\r\n', 25, 12, 14),
(9, 'F.R.I.E.N.D.S', 499, 30, 'A twist on the classic FRIENDS t-shirt where you can put a photo of your friends in the photo frame available at the front!\r\nCustomizations available soon! :D', 20, 12, 11),
(10, 'Wanted!', 699, 30, 'One Piece Wanted Poster!\r\nFor all the straw hats out there\r\nOversized for extra air flow when you sail through the seas', 21, 12, 13),
(11, 'Spotify', 699, 30, 'For all the music lovers out there\r\n\r\nIdea: You can also get the name of your favourite song printed on the back!\r\nCustomization available soon! ', 21, 12, 13),
(12, 'Human\'s Cry', 999, 15, 'We cry, we love,\r\nBut we do whatever we do, in style!\r\nLimited Edition, so grab it before it\'s gone!!', 25, 12, 14),
(13, 'Work is Worship', 499, 25, 'Cool yet Classy!\r\nAnother one from the BVM Collaboration.\r\nLimited stock.\r\n', 30, 12, 11),
(14, 'BVM White', 499, 15, 'White T-Shirt with a cool design made for the collab with BVM University\r\n', 30, 12, 11),
(15, 'BVM Beige', 499, 15, 'Beige T-Shirt from our BVM T-Shirt collection\r\n\r\nFrom our collab with BVM University', 30, 12, 11);

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`) VALUES
(9, 4, '16778027110.JPG'),
(10, 4, '16778027111.JPG'),
(13, 5, '16778033460.JPG'),
(14, 5, '16778033461.JPG'),
(15, 6, '16778034270.JPG'),
(16, 6, '16778034271.JPG'),
(17, 7, '16778035830.JPG'),
(18, 7, '16778035831.JPG'),
(21, 9, '16778048000.JPG'),
(22, 9, '16778048001.JPG'),
(23, 10, '16778049700.JPG'),
(24, 10, '16778049701.JPG'),
(25, 11, '16778051260.JPG'),
(26, 11, '16778051261.JPG'),
(27, 8, '16778051540.JPG'),
(28, 8, '16778051541.JPG'),
(29, 12, '16778053400.JPG'),
(30, 12, '16778053401.JPG'),
(31, 13, '16778054620.JPG'),
(32, 13, '16778054621.JPG'),
(33, 3, '16778250240.JPG'),
(34, 3, '16778250241.JPG'),
(43, 14, '16778699720.JPG'),
(44, 14, '16778699721.JPG'),
(45, 15, '16778704780.JPG'),
(46, 15, '16778704781.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `small` int(11) NOT NULL,
  `medium` int(11) NOT NULL,
  `large` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subcat_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `content`, `cat_id`, `subcat_id`, `image`) VALUES
(9, 'Marvel', 12, 13, '1680114446.jpg'),
(11, 'StreetWear23', 12, NULL, '1680114617.jpg'),
(12, 'OverSize', 12, 13, '1680117750.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcat`
--

INSERT INTO `subcat` (`id`, `name`, `cat_id`, `image`) VALUES
(11, 'T-Shirts', 12, '1677212967.png'),
(13, 'Oversized Tees', 12, '1677802580.jpg'),
(14, 'Hoodies', 12, '1677802602.jpg');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `mobileno`) VALUES
(1, 'Avi', 'sa3198154@gmail.com', '$2y$10$Zk6ThOmwRDgv5UtLSrMqk.bm9p9vHKaSymjMEBqCWG1BaamcblXHO', '9727445634'),
(2, 'Jigyasu', 'jigyasu@gmail.com', '$2y$10$5/PZI2ecSCuJ9ewSnBg0.u.OpeGJ3C9D9ffiIPjTlj5vnF0hKZuiq', '7405263599'),
(3, 'Rekha', 'rekhasharma2799@gmail.com', '$2y$10$uwRzy.3bCcCgap30.JriCO9/MlJAFZybHOVGiN3Aj1TeUVqVMpwJG', '8866405292');

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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`) VALUES
(63, 1, 13),
(64, 2, 3),
(65, 2, 4),
(66, 2, 5),
(67, 3, 3),
(68, 3, 4),
(69, 3, 5);

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
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_product_sub` FOREIGN KEY (`subcat_id`) REFERENCES `subcat` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `FK_product_image` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slider_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `subcat`
--
ALTER TABLE `subcat`
  ADD CONSTRAINT `FK_sub_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
