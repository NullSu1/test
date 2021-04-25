-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2021 at 10:17 AM
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8_bin NOT NULL,
  `book_id` int(11) NOT NULL,
  `order` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` varchar(25) COLLATE utf8_bin NOT NULL,
  `time` varchar(10) COLLATE utf8_bin NOT NULL,
  `stats` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order`),
  UNIQUE KEY `order_2` (`order`),
  KEY `id` (`id`,`user`,`order`),
  KEY `order` (`order`),
  KEY `book_id` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user`, `book_id`, `order`, `date`, `time`, `stats`) VALUES
(1, '张三', 1, '2NWZpJ8W79BI6b1kkqenodCkcUwA7xvNzWWSqKPRj87HnGU=', '2021-04-25 07:26:47', '1619335607', 1),
(2, '张三', 5, '2NWZpJ8W79BI6b1kkqenodCkcUwA7xvNzWWSqKPRj87HnGk=', '2021-04-25 07:30:13', '1619335813', 1),
(3, '张三', 3, '2NWZpJ8W79BI6b1kkqenodCkcUwA7xvNzWWSqKPRj87HnGc=', '2021-04-25 07:30:47', '1619335847', 1),
(4, '李四', 1, '2NWZpJ8X0L5JzM9kkqenodCkcUsfARrqu2WSqKPRj87HnGU=', '2021-04-25 09:21:26', '1619342486', 0),
(5, '李四', 2, '2NWZpJ8X0L5JzM9kkqenodCkcUwA7xvNzWWSqKPRj87HnGY=', '2021-04-25 09:22:02', '1619342522', 1),
(6, '李四', 3, '2NWZpJ8X0L5JzM9kkqenodCkcUwA7xvNzWWSqKPRj87HnGc=', '2021-04-25 09:59:16', '1619344756', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `td_demo02`
--

INSERT INTO `td_demo02` (`id`, `book_name`, `cover_art`, `pri`, `out_time`, `class`, `author`) VALUES
(1, 'book', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'php', '张三'),
(2, 'book2', 'site/static/images/cover_pic2021-04-22/home.png', '40.00', '2021-04-19 13:24:34', 'javascript', '李四'),
(3, 'book3', 'site/static/images/cover_pic2021-04-22/home.png', '40.00', '2021-04-19 13:24:34', 'type', '李四'),
(4, 'book_php', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'php', '李四'),
(5, 'book2', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'javascript', '李四'),
(6, 'book3', 'site/static/images/cover_pic2021-04-22/home.png', '40.00', '2021-04-19 13:24:34', 'type', '李四'),
(7, 'book', 'site/static/images/cover_pic2021-04-22/home.png', '40.00', '2021-04-19 13:24:34', 'php', '李四'),
(8, 'book2', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'javascript', '李四'),
(9, 'book3', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'type', '李四'),
(10, 'book', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'php', '李四'),
(11, 'book2', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'javascript', '李四'),
(12, 'book3', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '40.00', '2021-04-19 13:24:34', 'type', '李四'),
(15, 'migbook', 'site/static/images/cover_pic2021-04-22/home.png', '50', '2021-04-22 10:21:36', 'other', '李四'),
(14, 'book_name', 'site/static/images/cover_pic2021-04-22/backiee-102533.jpg', '35', '2021-04-22 10:15:41', 'javascript', '李四'),
(16, '恐怖谷理论', 'site/static/images/cover_pic2021-04-23/backiee-76264.jpg', '56', '2021-04-23 01:42:56', 'other', '李四'),
(17, 'migc', 'site/static/images/cover_pic2021-04-25/deer-3275594_1920.jpg', '80', '2021-04-25 02:01:02', 'other', '李四');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `passwd`, `balance`, `date`) VALUES
(1, '张三', '77fdqTlifHQfRD+EA7AOiZNqfmrwDuj15t6e1vRqZyrg0YE', 50, '2021-04-23 02:19:09'),
(3, '李四', 'fe1akLz82zCLTkxBEpUgV3hHZz1zNSJ812RkGuH4a1FJnLg', 0, '2021-04-25 09:19:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
