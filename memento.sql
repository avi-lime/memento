-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2023 at 10:29 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

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
  `id` int NOT NULL AUTO_INCREMENT,
  `addressname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` text NOT NULL,
  `pincode` int NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_addresss_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `addressname`, `address`, `user_id`, `city`, `state`, `country`, `pincode`, `is_default`) VALUES
(1, 'Jigyasu Sharma', 'Shubh Mangal Appartment,opp SBI Bank, Adajan', 2, 'surat', 'Gujarat', 'sad', 395009, 0),
(2, 'Avinash Singh', 'B-704, Rameshwaram Keshav Heights, Opposite Broadway international school, Althan', 1, 'Surat', 'Gujarat', 'India', 395007, 0),
(9, 'Neha Singh', 'I-301, Rajhans Platinum, Palanpur Canal road', 1, 'Surat', 'Gujarat', 'India', 395009, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `superadmin` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `username`, `superadmin`) VALUES
(3, 'admin@admin.com', '$2y$10$p1hI3LduLkki2cIIsH1WmeHI.dmygMs3mGHNkhWIg/WSlAlERJQBG', 'admin', 1),
(6, 'sa3198154+admin@gmail.com', '$2y$10$xnoWTawUw7cOUgDDNfXqa.au9NX1asVTMrLOfsxFIHrCH/HcaSLsO', 'avi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `size` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cart_product` (`product_id`),
  KEY `FK_card_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `size`, `user_id`) VALUES
(26, 3, 2, 'l', 2),
(32, 4, 1, 'm', 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(12, 'Male', '1680890995.png'),
(13, 'Female', '1680891009.png'),
(14, 'Kids', '1680891022.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `replied_to` int DEFAULT NULL,
  `replied_by` int DEFAULT NULL,
  `replied` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `sent_time`, `replied_to`, `replied_by`, `replied`) VALUES
(3, 'asdfsd', 'sa3198154@gmail.com', 'asfasdf', '2023-04-06 20:27:06', NULL, NULL, 1),
(8, 'asdfsd', 'sa3198154@gmail.com', 'asfasdf', '2023-04-06 20:27:06', NULL, NULL, 1),
(15, 'asdf', 'sa3198154@gmail.com', 'manoj chutiya manoj chutiya bsdka loda ek kaam ni karta chutiya mc kya kareaga  zindagi me bsdwala job karne wala tha loda isko koi job pe rakhega ek project me to kaam ho ni ra mai kya karu lode isse kya hoga zindagi me mar jayenga ye', '2023-04-06 20:27:06', NULL, NULL, 1),
(17, 'asdf', 'sa3198154@gmail.com', 'manoj chutiya manoj chutiya bsdka loda ek kaam ni karta chutiya mc kya kareaga  zindagi me bsdwala job karne wala tha loda isko koi job pe rakhega ek project me to kaam ho ni ra mai kya karu lode isse kya hoga zindagi me mar jayenga ye', '2023-04-06 20:40:18', NULL, NULL, 1),
(18, 'avi', 'sa3198154@gmail.com', 'lamba message\r\n\r\ndsaf\r\ndsaf\r\n', '2023-04-06 20:57:54', 17, 6, 0),
(19, 'avi', 'sa3198154@gmail.com', 'lamba message\r\n\r\ndsaf\r\ndsaf\r\n', '2023-04-06 20:57:57', 17, 6, 0),
(24, '', 'sa3198154@gmail.com', ' okkkkkk', '2023-04-07 08:02:53', 8, 3, 0),
(25, '', 'sa3198154@gmail.com', ' okay', '2023-04-07 08:03:35', 8, 3, 0),
(26, '', 'sa3198154@gmail.com', ' okay', '2023-04-07 08:03:56', 3, 3, 0),
(27, '', 'sa3198154@gmail.com', ' okayyy', '2023-04-07 08:04:28', 15, 3, 0),
(28, '', 'jigyasusharma2803@gmail.com', 'ab admin kisi ko b email bhej skta, tere mail se, but tere mail se khud ko jayega k nai wo ni malum ðŸ’€', '2023-04-07 08:11:16', 15, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `address_id` int NOT NULL,
  `amount` int NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `quantity` int NOT NULL,
  `size` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_user` (`user_id`),
  KEY `FK_order_product` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `product_id`, `address_id`, `amount`, `status`, `date`, `quantity`, `size`) VALUES
(10, 'order_LXOFKKfLprSUL4', 3, 3, 1, 399, NULL, '2023-03-29 21:00:30', 1, 'm'),
(11, 'order_LXOGr2XDS8tR6g', 3, 5, 1, 749, NULL, '2023-03-29 21:01:57', 1, 'l'),
(12, 'order_LYugUXNIQDoZPp', 1, 5, 1, 749, NULL, '2023-04-02 17:23:25', 1, 'l'),
(13, 'order_La2sFe6JiITglX', 1, 5, 1, 749, NULL, '2023-04-05 14:03:06', 1, 'm'),
(14, 'order_Lb3ZO1MaFWZ9PH', 1, 13, 1, 399, NULL, '2023-04-08 03:22:56', 1, 'm');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `transaction_date`, `payment_mode`, `status`, `amount`) VALUES
(8, 'order_LXOFKKfLprSUL4', '2023-03-29 21:00:30', 'NetBanking', 'Completed', 399),
(9, 'order_LXOGr2XDS8tR6g', '2023-03-29 21:01:57', 'NetBanking', 'Completed', 749),
(10, 'order_LYugUXNIQDoZPp', '2023-04-02 17:23:25', 'NetBanking', 'Completed', 749),
(11, 'order_La2sFe6JiITglX', '2023-04-05 14:03:06', 'NetBanking', 'Completed', 749),
(12, 'order_Lb3ZO1MaFWZ9PH', '2023-04-08 03:22:56', 'NetBanking', 'Completed', 399);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `description` text NOT NULL,
  `discount` int NOT NULL,
  `cat_id` int NOT NULL,
  `subcat_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_cat` (`cat_id`),
  KEY `FK_product_sub` (`subcat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

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
(15, 'BVM Beige', 499, 15, 'Beige T-Shirt from our BVM T-Shirt collection\r\n\r\nFrom our collab with BVM University', 30, 12, 11),
(16, 'Superman', 404, 100, 'Men White Printed Round Neck Pure Cotton T-shirt', 10, 12, 11),
(17, 'Grey Melange Solid Round Neck T-shirt', 599, 50, 'Grey melange solid T-shirt, has a round neck, short sleeves', 10, 12, 11),
(18, 'PUMA Classic No.1 Logo Women\'s T-Shirt', 669, 100, 'Classics are called so for a reason because no matter what time, they never get old, only better. The PUMA No.1 Classic Logo Women\'s T-Shirt is simple, sophisticated and versatile.	', 10, 13, 17),
(19, 'Men Purple Boxy Fit Printed Round Neck Pure Cotton T-shirt	', 626, 200, 'Purple printed T-shirt, has a round neck, short sleeves	', 5, 12, 11),
(20, 'Women Off White Pure Cotton Printed Regular Kurta', 2659, 50, 'Women Off White Pure Cotton Printed Regular Kurta with Trousers & Dupatta	', 10, 13, 17),
(21, 'Women Black 2-In-1 Solid Dri-Fit Running Shorts	', 1895, 20, 'A wider elastic waistband offers a smooth look and feel. Mesh-lined waistband and tipping provides ventilation. Internal pockets store small items, such as keys or cards. Standard fit for a relaxed, easy feel	', 5, 13, 18),
(22, 'Boys Black & White Punisher Printed Sweatshirt	', 699, 100, 'Black printed sweatshirt has a round neck, long sleeves, closure, straight hem	', 10, 14, 20),
(23, 'tank-top', 499, 10, 'naylon based tank top', 0, 12, 15),
(24, 'sportswear set', 999, 10, 'a set of both top and track', 0, 12, 15),
(25, 'cotton shirt', 699, 10, '100% blue cotton shirt', 0, 12, 16),
(26, 'formal pants', 799, 10, '100% cotton black pants \r\n', 0, 12, 16),
(27, 'formal shirt', 599, 10, 'grey formal shirt', 0, 13, 19),
(28, 'formal set', 999, 10, 'formal set', 0, 13, 19),
(29, 'sassy t-shirt', 499, 10, 'sassy kid\'s t-shirt', 0, 14, 21),
(30, 'Go girl t-shirt', 499, 10, 'kid\'s t-shirt', 0, 14, 21);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_image` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`) VALUES
(9, 4, '16778027110.JPG'),
(10, 4, '16778027111.JPG'),
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
(46, 15, '16778704781.JPG'),
(47, 5, '16803449890.JPG'),
(48, 5, '16803449891.JPG'),
(49, 16, '16808953620.png'),
(50, 17, '16808958390.png'),
(51, 18, '16808958960.png'),
(52, 19, '16808961330.png'),
(53, 20, '16808962160.png'),
(54, 21, '16808962780.png'),
(55, 22, '16808963850.png'),
(56, 23, '16809059540.jpg'),
(57, 24, '16809060670.jpg'),
(58, 25, '16809061350.jpg'),
(59, 26, '16809061960.jpg'),
(60, 27, '16809062390.jpg'),
(61, 28, '16809062930.webp'),
(62, 29, '16809063700.jpg'),
(63, 30, '16809064040.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `small` int NOT NULL,
  `medium` int NOT NULL,
  `large` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `cat_id` int NOT NULL,
  `subcat_id` int DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `content`, `cat_id`, `subcat_id`, `image`) VALUES
(11, 'StreetWear23', 12, NULL, '1680114617.jpg'),
(12, 'OverSize23', 12, 13, '1680117750.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subcat`
--

DROP TABLE IF EXISTS `subcat`;
CREATE TABLE IF NOT EXISTS `subcat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cat_id` int NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_sub_cat` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcat`
--

INSERT INTO `subcat` (`id`, `name`, `cat_id`, `image`) VALUES
(11, 'Casual Wear', 12, '1677212967.png'),
(13, 'Oversized Tees', 12, '1677802580.jpg'),
(14, 'Hoodies', 12, '1677802602.jpg'),
(15, 'Sportswear', 12, '1680891218.png'),
(16, 'Formal Wear', 12, '1680891246.png'),
(17, 'Casual Wear', 13, '1680891314.png'),
(18, 'Sports Wear', 13, '1680891331.png'),
(19, 'Formal Wear', 13, '1680893024.png'),
(20, 'Boys', 14, '1680893694.png'),
(21, 'Girls', 14, '1680893708.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobileno` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `mobileno`) VALUES
(1, 'Avi', 'sa3198154@gmail.com', '$2y$10$Zk6ThOmwRDgv5UtLSrMqk.bm9p9vHKaSymjMEBqCWG1BaamcblXHO', '9727445634'),
(2, 'Jigyasu', 'jigyasu@gmail.com', '$2y$10$5/PZI2ecSCuJ9ewSnBg0.u.OpeGJ3C9D9ffiIPjTlj5vnF0hKZuiq', '7405263599'),
(3, 'Rekha', 'rekhasharma2799@gmail.com', '$2y$10$uwRzy.3bCcCgap30.JriCO9/MlJAFZybHOVGiN3Aj1TeUVqVMpwJG', '8866405292'),
(4, 'Om', 'ombhatt@gmail.com', '$2y$10$XQx6BuRmnvrpNKs1JH3Glup1rVXj2dIWvDC6M3MKRnt.pGA/iHTdG', '9727445634');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`) VALUES
(64, 2, 3),
(65, 2, 4),
(66, 2, 5),
(67, 3, 3),
(68, 3, 4),
(69, 3, 5),
(70, 1, 5),
(71, 1, 13);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_addresss_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_card_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_cart_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_order_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_product_sub` FOREIGN KEY (`subcat_id`) REFERENCES `subcat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `FK_product_image` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slider_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `subcat`
--
ALTER TABLE `subcat`
  ADD CONSTRAINT `FK_sub_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
