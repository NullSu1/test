-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 23, 2021 at 09:57 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL,
  `user` varchar(20) COLLATE utf8_bin NOT NULL,
  `order` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` varchar(25) COLLATE utf8_bin NOT NULL,
  `time` varchar(10) COLLATE utf8_bin NOT NULL,
  `stats` int(11) NOT NULL,
  PRIMARY KEY (`id`,`order`),
  KEY `id` (`id`,`user`,`order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `td_demo02`
--

DROP TABLE IF EXISTS `td_demo02`;
CREATE TABLE IF NOT EXISTS `td_demo02` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cover_art` varchar(255) COLLATE utf8_bin NOT NULL,
  `pri` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `out_time` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `class` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `author` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`,`book_name`,`pri`,`out_time`,`class`),
  KEY `cover_art` (`cover_art`),
  KEY `author` (`author`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `td_demo02`
--

INSERT INTO `td_demo02` (`id`, `book_name`, `cover_art`, `pri`, `out_time`, `class`, `author`) VALUES
(1, 'book', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'php', ''),
(2, 'book2', 'site/static/images/cover_pic2021-04-22/home.png', '40.00', '2021-04-19 13:24:34', 'javascript', ''),
(3, 'book3', 'site/static/images/cover_pic2021-04-22/home.png', '40.00', '2021-04-19 13:24:34', 'type', ''),
(4, 'book_php', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'php', ''),
(5, 'book2', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'javascript', ''),
(6, 'book3', 'site/static/images/cover_pic2021-04-22/home.png', '40.00', '2021-04-19 13:24:34', 'type', ''),
(7, 'book', 'site/static/images/cover_pic2021-04-22/home.png', '40.00', '2021-04-19 13:24:34', 'php', ''),
(8, 'book2', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'javascript', ''),
(9, 'book3', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'type', ''),
(10, 'book', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'php', ''),
(11, 'book2', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'javascript', ''),
(12, 'book3', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'type', ''),
(15, 'migbook', 'site/static/images/cover_pic2021-04-22/home.png', '50', '2021-04-22 10:21:36', 'other', ''),
(14, 'book_name', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '35', '2021-04-22 10:15:41', 'javascript', ''),
(16, '恐怖谷理论', 'site/static/images/cover_pic2021-04-23/backiee-76264.jpg', '56', '2021-04-23 01:42:56', 'other', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8_bin NOT NULL,
  `passwd` text COLLATE utf8_bin NOT NULL,
  `balance` int(11) NOT NULL,
  `date` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`,`user`),
  KEY `id` (`id`,`user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `passwd`, `balance`, `date`) VALUES
(1, '张三', '77fdqTlifHQfRD+EA7AOiZNqfmrwDuj15t6e1vRqZyrg0YE', 0, '2021-04-23 02:19:09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
