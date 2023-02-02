-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 02, 2023 at 03:48 PM
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
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `username`, `superadmin`) VALUES
(1, 'marvel@gmail.com', '$2y$10$d0k8Mbj8yULvhkOHAPMMJu/inRQ7s2wTkxHeUNT4YABFU0ifkUpuK', 'MARVEL', 0),
(2, 'dc@gmail.com', '$2y$10$.CS/0hvGf4XQD4m34sb.Z.N/ktjXGgUpEX973mWHZmbIDtn.4.MY.', 'DC', 0),
(3, 'admin@admin.com', '$2y$10$p1hI3LduLkki2cIIsH1WmeHI.dmygMs3mGHNkhWIg/WSlAlERJQBG', 'admin', 1),
(4, 'allahhuakbar911@boomboom.com', '$2y$10$8MWn2jmfEz5BkAGgR6NSqel7gmEtLIZM.EurMbCp9VxY4mNtgMiN.', 'allah hu akbar', 0),
(5, 'vomajabij@mailinator.com', '$2y$10$9TQHj7jJ3hGZLiKHugcHHO34wRiAWCnN5uF1Qs51eqteMQE2T26kC', 'Ria Nash', 0),
(6, 'gotihovusy@mailinator.com', '$2y$10$X.8WTy0GpCNHe5W0ZYv.cerZHVUrXb10H5JXEu6J8Kwx4eq87rE1S', 'Geoffrey Hernandez', 0),
(7, 'bemah@mailinator.com', '$2y$10$OmtantmKfK6cGjp9eMpt3OsJdDiCi3a4gnYVtEdx.7I5xVRhwR/TG', 'Maxwell Gonzalez', 0),
(8, 'xitezum@mailinator.com', '$2y$10$W/sS6/Non3lucszAXbUwheJlJNoYZQIncHpwTe/5m/P8sQibiXiM6', 'Iliana Greer', 0),
(9, 'mysudemoh@mailinator.com', '$2y$10$D13vVkv3m6hnTGmvVyOYD.CijycmJJIJaJOLg.vaujnRI7ugc6Fg2', 'Idola Ryan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(11, 'Shirt', 'Screenshot (4).png'),
(3, 'Tees', 'Screenshot (6).png'),
(10, 'rahul', 'Screenshot (4).png'),
(12, 'Casual wear', 'autri-taheri-QAwtEAY6V8I-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productid` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(20) NOT NULL,
  `product_quantity` int(20) NOT NULL,
  `product_desc` text NOT NULL,
  `product_dis` int(3) NOT NULL,
  `catid` int(10) NOT NULL,
  `subcatid` int(10) NOT NULL,
  `product_companyid` int(20) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_series` varchar(255) NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `product_name`, `product_price`, `product_quantity`, `product_desc`, `product_dis`, `catid`, `subcatid`, `product_companyid`, `product_img`, `product_series`) VALUES
(6, 'Captain America: Colourblock', 2000, 800, 'Official Licensed Captain America Oversized Full Sleeve T-shirt.\r\n\r\nAre you ready to take your Streetwear game to the next level? Are you ready to have all the attention on you?\r\n\r\nIf yes, then you definitely need this ultra-stylish and extraordinarily comfortable Oversized Tee! And what better one than the one with Captain America\'s Shield on it which automatically makes it 10x cooler!\r\n\r\nBelieve us when we say that this is truly one of the most good-looking pieces of clothing you will ever own simply because of how innovative and different it is!\r\n\r\nWith our trademark quirky designs and unbelievably great quality, we guarantee that you will always look your best wherever you go!\r\n\r\nBe the trendsetter in your group and grab this tee today!\r\n\r\nShop for the best T-shirts online, exclusively at The Souled Store!', 12, 3, 2, 1, 'Screenshot (5).png', 'Captain America'),
(7, 'Batman: Go Hawai', 2500, 500, 'Official Licensed Batman Summer Shirt\r\n\r\nWhen Batman requested us to make him a premium shirt, we couldn\'t deny him! Presenting to you this super-stylish and comfortable Batman shirt.\r\n\r\nBuy Batman Shirts online, available in India only at The Souled Store.', 0, 11, 10, 1, 'Screenshot (6).png', 'Batman');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcat`
--

INSERT INTO `subcat` (`id`, `name`, `cat_id`, `image`) VALUES
(2, 'full sleeve', 3, 'Screenshot (5).png'),
(9, 'Plain shirt ', 3, 'Screenshot (3).png'),
(10, 'mandarin shirt', 11, 'image_2022-09-09_061323574.png'),
(11, 'T-Shirts', 12, 'image_2022-09-03_164709322.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `addressid` int(25) NOT NULL,
  `mobileno` int(10) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `img` blob NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
