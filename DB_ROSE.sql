-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 18, 2021 at 11:59 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rose`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_username` varchar(20) NOT NULL,
  `account_email` varchar(30) NOT NULL,
  `account_password` varchar(256) NOT NULL,
  `u_city` varchar(30) DEFAULT NULL,
  `u_phone` tinytext NOT NULL,
  `account_access_level` enum('Administrator','Editor','User') NOT NULL DEFAULT 'User',
  `account_creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_status` int(1) NOT NULL DEFAULT '1',
  `verification_status` int(11) NOT NULL DEFAULT '0',
  `account_description` text CHARACTER SET armscii8,
  PRIMARY KEY (`account_id`),
  KEY `account_email` (`account_email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_username`, `account_email`, `account_password`, `u_city`, `u_phone`, `account_access_level`, `account_creation_time`, `account_status`, `verification_status`, `account_description`) VALUES
(1, 'Username', '123@gmail.com', '123', 'Location', ' 0645334223  ', 'Administrator', '2021-03-15 02:06:19', 1, 1, '<p>Aenean tristique orci non sapien sollicitudin dignissim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin id sem ut orci condimentum congue. Aenean a dapibus. <br /><strong>+381 123 4567</strong></p>'),
(2, 'Username1', '1234@gmail.com', '1234', 'Location', '069 1234 56 75  ', 'Editor', '2021-03-15 02:06:19', 1, 1, '<p>Coding bugs!!!!! AND MORE BUGS !!!</p>'),
(3, 'Username2', '12345@gmail.com', '12345', 'Location', '069 1234 56 75', 'User', '2021-03-15 02:06:19', 1, 0, '<p>Aenean tristique orci non sapien sollicitudin dignissim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin id sem ut orci condimentum congue. Aenean a dapibus. <br /><strong>+381 123 4567 / +381 987 6543</strong><br />Condimentum congue aenean a dapibus.</p>'),
(5, 'Username3', '123456@gmail.com', '123456', 'Location', '069 1234 56 75', 'User', '2021-03-15 02:06:19', 1, 0, '<p>Aenean tristique orci non sapien sollicitudin dignissim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;&nbsp;<br /><strong>+381 123 4567 / +381 987 6543</strong><br />Condimentum congue aenean a dapibus.</p>'),
(6, 'Username4', 'nano@gmail.com', 'nano', 'Location', '12345678910 ', 'User', '2021-07-01 23:43:08', 1, 0, '<p>Some description</p>');

-- --------------------------------------------------------

--
-- Table structure for table `account_comments`
--

DROP TABLE IF EXISTS `account_comments`;
CREATE TABLE IF NOT EXISTS `account_comments` (
  `account_comments_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_comments_target` int(10) DEFAULT NULL,
  `account_comments_replay_target` int(10) DEFAULT NULL,
  `account_comments_user_id` int(10) NOT NULL,
  `account_comments_content` text CHARACTER SET armscii8 NOT NULL,
  `account_comments_item_name` text,
  `account_comments_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_comments_type` int(10) DEFAULT NULL,
  `comment_correct_desc` int(10) DEFAULT NULL,
  `comment_good_communication` int(10) DEFAULT NULL,
  `comment_good_deal` int(10) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_comments_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_comments`
--

INSERT INTO `account_comments` (`account_comments_id`, `account_comments_target`, `account_comments_replay_target`, `account_comments_user_id`, `account_comments_content`, `account_comments_item_name`, `account_comments_date`, `account_comments_type`, `comment_correct_desc`, `comment_good_communication`, `comment_good_deal`, `deleted`) VALUES
(2, 2, NULL, 1, 'Everything went horrible and bad. I DONT recommend this seller to anyone!', 'SSD 240GB SAMSUNG', '2021-05-06 21:47:05', 0, 5, 3, 2, 0),
(3, 2, NULL, 2, '<p>All good an chill vry nais many wows!!&nbsp;<strong>WITH RICH EDITOR EDITED KEKW!!!!!!!</strong></p>', 'GAMING PC 2600X/1060 6GB/16 GB/500GB SSD', '2021-05-06 21:47:05', 1, 5, 5, 5, 0),
(6, 2, NULL, 3, 'Everything went horrible and bad. I DONT recommend this seller to anyone!', 'GTX 960 2GB / USED', '2021-05-06 21:47:05', 0, 1, 1, 1, 0),
(4, NULL, 2, 1, '<p>koment by MultiSpirit</p>', NULL, '2021-05-06 21:47:05', 0, 0, 0, 0, 0),
(9, NULL, 3, 2, '<p>One&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br />Two<br />Three</p>\n<p>&nbsp;</p>\n<p style=\"text-align: center;\">sadsadsa!!!</p>\n<p style=\"text-align: center;\"><strong>asdsadsa!</strong></p>\n<p style=\"text-align: center;\">&nbsp;</p>\n<p style=\"text-align: right;\">sasadsad</p>\n<p style=\"text-align: right;\">asdsad</p>\n<ul>\n<li style=\"text-align: left;\">123</li>\n<li style=\"text-align: left;\"><em>345</em></li>\n<li style=\"text-align: left;\"><em>666!</em></li>\n</ul>', NULL, '2021-05-14 21:35:31', NULL, 0, 0, 0, 0),
(5, NULL, 2, 2, 'koment by Exora', NULL, '2021-05-06 21:47:05', 0, 0, 0, 0, 0),
(11, NULL, 2, 2, 'FUCK YOU ALL', NULL, '2021-05-14 22:50:36', NULL, 0, 0, 0, 1),
(7, NULL, 2, 3, 'koment by NixGlacie', NULL, '2021-05-06 21:47:05', 0, 0, 0, 0, 0),
(8, NULL, 3, 2, 'Very nais!', NULL, '2021-05-14 21:34:07', NULL, 0, 0, 0, 0),
(10, NULL, 3, 2, 'This is new replay after my brain died!!', NULL, '2021-05-14 22:31:06', NULL, 0, 0, 0, 0),
(12, NULL, 2, 2, 'MAHFHSDFHJSF', NULL, '2021-05-14 22:52:11', NULL, 0, 0, 0, 1),
(13, NULL, 3, 2, 'Another test comment', NULL, '2021-05-14 22:53:09', NULL, 0, 0, 0, 1),
(14, NULL, 2, 2, 'another test comment hahaha', NULL, '2021-05-14 22:53:19', NULL, 0, 0, 0, 1),
(15, NULL, 2, 2, 'Anohter test im tired', NULL, '2021-05-14 22:55:30', NULL, 0, 0, 0, 1),
(16, NULL, 3, 2, 'hahaha', NULL, '2021-05-14 23:14:49', NULL, 0, 0, 0, 1),
(17, NULL, 3, 2, '124124', NULL, '2021-05-14 23:15:08', NULL, 0, 0, 0, 1),
(18, NULL, 3, 2, '346436346', NULL, '2021-05-14 23:17:50', NULL, 0, 0, 0, 1),
(19, NULL, 3, 2, 'Everything went horrible! (edited)', NULL, '2021-05-14 23:18:41', NULL, 0, 0, 0, 1),
(20, NULL, 3, 2, 'Another comment', NULL, '2021-05-15 01:02:28', NULL, 0, 0, 0, 1),
(31, NULL, 3, 2, 'Very good!', NULL, '2021-05-18 15:49:47', NULL, 0, 0, 0, 1),
(21, NULL, 6, 2, 'STOPID!', NULL, '2021-05-15 01:16:10', NULL, 0, 0, 0, 1),
(22, NULL, 3, 2, 'BLYAT!', NULL, '2021-05-15 13:23:29', NULL, 0, 0, 0, 1),
(23, NULL, 3, 2, 'Replay', NULL, '2021-05-15 13:55:13', NULL, 0, 0, 0, 1),
(24, NULL, 3, 2, 'test comment to be deleted //edited before deleting', NULL, '2021-05-15 14:15:24', NULL, 0, 0, 0, 1),
(25, NULL, 2, 2, 'Replay test once again //EDITED before deleting by EXORA', NULL, '2021-05-15 14:16:30', NULL, 0, 0, 0, 1),
(26, NULL, 2, 2, '123', NULL, '2021-05-15 20:15:49', NULL, 0, 0, 0, 1),
(27, NULL, 2, 3, '1234', NULL, '2021-05-15 20:15:49', NULL, 0, 0, 0, 1),
(28, NULL, 2, 3, '1234', NULL, '2021-05-15 20:15:49', NULL, 0, 0, 0, 1),
(29, NULL, 2, 2, 'Halo!', NULL, '2021-05-17 19:11:21', NULL, 0, 0, 0, 1),
(30, NULL, 3, 2, 'View is nice! kekw!', NULL, '2021-05-17 19:12:34', NULL, 0, 0, 0, 1),
(32, NULL, 3, 2, '123', NULL, '2021-05-18 15:51:08', NULL, 0, 0, 0, 1),
(33, NULL, 2, 2, 'Testing replay', NULL, '2021-05-18 15:52:32', NULL, 0, 0, 0, 1),
(34, NULL, 3, 2, 'Hehey', NULL, '2021-05-18 16:03:34', NULL, 0, 0, 0, 1),
(35, NULL, 6, 2, 'Faka you', NULL, '2021-05-18 16:23:43', NULL, 0, 0, 0, 1),
(36, NULL, 2, 2, '<p>HFHFGHD</p>', NULL, '2021-05-22 15:18:27', NULL, 0, 0, 0, 1),
(37, NULL, 2, 2, '<p>sadsa</p>', NULL, '2021-05-22 16:19:50', NULL, NULL, NULL, NULL, 1),
(38, NULL, 6, 2, '<p>STOPID</p>', NULL, '2021-05-22 16:24:21', NULL, NULL, NULL, NULL, 1),
(39, NULL, 6, 2, '<p>Hahahahahaha</p>', NULL, '2021-05-22 16:25:30', NULL, NULL, NULL, NULL, 1),
(40, NULL, 6, 2, '<p>Hahahahhahaha</p>', NULL, '2021-05-22 16:25:50', NULL, NULL, NULL, NULL, 0),
(41, NULL, 2, 2, '<p>Heyo</p>', NULL, '2021-05-25 12:45:14', NULL, NULL, NULL, NULL, 1),
(42, NULL, 3, 2, '<p>Hello</p>', NULL, '2021-05-30 23:58:29', NULL, NULL, NULL, NULL, 1),
(43, NULL, 3, 2, '<p>TESTIING if something broke or not</p>', NULL, '2021-06-02 19:11:51', NULL, NULL, NULL, NULL, 1),
(44, 3, NULL, 2, 'Everything went horrible and bad. I DONT recommend this seller to anyone!', NULL, '2021-05-06 21:47:05', 0, 3, 3, 1, 0),
(45, NULL, 44, 3, '<p>You have no idea what are you talking about!</p>', NULL, '2021-06-17 17:04:39', NULL, NULL, NULL, NULL, 0),
(46, NULL, 3, 2, '<p>Huehue</p>', NULL, '2021-06-21 14:13:21', NULL, NULL, NULL, NULL, 1),
(47, NULL, 3, 2, '<p>KEK</p>', NULL, '2021-06-23 19:02:31', NULL, NULL, NULL, NULL, 1),
(58, 1, NULL, 2, '<p>testing</p>', 'MS test', '2021-06-30 20:25:02', 0, 5, 4, 3, 0),
(59, NULL, 58, 1, '<p>123</p>', NULL, '2021-06-30 20:32:27', NULL, NULL, NULL, NULL, 0),
(63, 1, NULL, 2, '<p>test comment</p>', 'MS test', '2021-06-30 20:42:56', 1, 5, 5, 5, 0),
(61, 5, NULL, 2, '<p>TESTING&nbsp;</p>', '19', '2021-06-30 20:40:15', 0, 5, 3, 3, 1),
(62, 5, NULL, 2, '<p>TESTING&nbsp;</p>', '19', '2021-06-30 20:40:59', 0, 5, 3, 3, 0),
(64, 2, NULL, 1, '<p>AMAZING</p>', '10', '2021-06-30 20:54:02', 1, 5, 5, 5, 0),
(65, 2, NULL, 1, '<p>ANOTHER AMAZING!</p>', '16', '2021-06-30 20:56:12', 1, 5, 5, 5, 0),
(66, 2, NULL, 2, '<p>good i guess</p>', 'TEST 545', '2021-07-04 19:00:43', 1, 4, 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_bookmarks`
--

DROP TABLE IF EXISTS `item_bookmarks`;
CREATE TABLE IF NOT EXISTS `item_bookmarks` (
  `bookmark_id` int(11) NOT NULL AUTO_INCREMENT,
  `bookmark_owner_id` int(11) NOT NULL,
  `bookmark_item_id` int(11) NOT NULL,
  PRIMARY KEY (`bookmark_id`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_bookmarks`
--

INSERT INTO `item_bookmarks` (`bookmark_id`, `bookmark_owner_id`, `bookmark_item_id`) VALUES
(113, 6, 107),
(112, 1, 108),
(108, 1, 55),
(107, 3, 12),
(106, 1, 3),
(105, 1, 1),
(104, 3, 2),
(103, 3, 1),
(102, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

DROP TABLE IF EXISTS `item_categories`;
CREATE TABLE IF NOT EXISTS `item_categories` (
  `item_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_category_name` text NOT NULL,
  PRIMARY KEY (`item_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`item_category_id`, `item_category_name`) VALUES
(1, 'Computers | Desktop'),
(2, 'Computers | Laptop and tablet'),
(3, 'Electronics and lights\r\n'),
(4, 'Electronics and components'),
(5, 'Consoles and games'),
(6, 'Mobile phones'),
(7, 'Mobile phones | gadgets and parts'),
(8, 'TV and Video'),
(9, 'Audio');

-- --------------------------------------------------------

--
-- Table structure for table `item_groups`
--

DROP TABLE IF EXISTS `item_groups`;
CREATE TABLE IF NOT EXISTS `item_groups` (
  `item_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_group_category_id` int(11) NOT NULL,
  `item_group_name` text NOT NULL,
  PRIMARY KEY (`item_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_groups`
--

INSERT INTO `item_groups` (`item_group_id`, `item_group_category_id`, `item_group_name`) VALUES
(1, 1, '3D printers'),
(2, 1, 'Apple desktop'),
(3, 1, 'Apple desktop | Gadgets and parts'),
(4, 1, 'Additional equipment'),
(5, 1, 'Controllers'),
(6, 1, 'Ebook readers'),
(7, 1, 'Gaming equipment'),
(8, 1, 'Graphic cards'),
(9, 1, 'Hard drives'),
(10, 1, 'External hard drives '),
(11, 1, 'SSD hard drives '),
(12, 1, 'Cables and adapters'),
(13, 1, 'Coolers'),
(14, 1, 'Motherboards'),
(15, 1, 'Matrix printers'),
(16, 1, 'Mini pc'),
(17, 1, 'Mining rigs'),
(18, 1, 'Mouses'),
(19, 1, 'Modems and routers'),
(20, 1, 'Monitors'),
(21, 1, 'Network devices'),
(22, 1, 'Power supplys'),
(23, 1, 'NAS devices'),
(24, 1, 'PCs'),
(25, 1, 'Optical devices'),
(26, 1, 'PC speakers'),
(27, 1, 'Used PCs'),
(28, 1, 'Configurations'),
(29, 1, 'Cases'),
(30, 1, 'Processors'),
(31, 1, 'Programs'),
(32, 1, 'RAM memorys'),
(33, 1, 'Retro PCs'),
(34, 1, 'Servers'),
(35, 1, 'Scaners'),
(36, 1, 'Headsets and microphones'),
(37, 1, 'Printers'),
(38, 1, 'Keyboards'),
(39, 1, 'TV cards'),
(40, 1, 'UPS devices'),
(41, 1, 'USB sticks'),
(42, 1, 'Web cameras'),
(43, 1, 'Sound cards'),
(44, 1, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `item_posts`
--

DROP TABLE IF EXISTS `item_posts`;
CREATE TABLE IF NOT EXISTS `item_posts` (
  `item_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `item_owner_id` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_group` int(11) NOT NULL,
  `item_state` int(11) NOT NULL,
  `item_post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_description` text NOT NULL,
  `item_city` varchar(30) NOT NULL,
  `item_phone_num` text NOT NULL,
  `item_rated` int(11) NOT NULL DEFAULT '0',
  `sold_to` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_posts`
--

INSERT INTO `item_posts` (`item_id`, `item_name`, `item_owner_id`, `item_price`, `item_category`, `item_group`, `item_state`, `item_post_date`, `item_description`, `item_city`, `item_phone_num`, `item_rated`, `sold_to`, `deleted`) VALUES
(81, 'TEST ITEM 213', 2, 234, 1, 14, 2, '2021-06-26 02:00:13', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75                                ', 0, NULL, 0),
(80, '10', 2, 234, 1, 5, 2, '2021-06-25 19:00:45', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 1, 0),
(79, '09', 2, 234, 6, 5, 2, '2021-06-25 18:51:55', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, NULL, 0),
(78, '08', 2, 234, 5, 5, 2, '2021-06-25 19:02:15', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, NULL, 0),
(89, '19', 5, 45, 1, 13, 2, '2021-06-27 00:05:28', '<p>testing</p>', 'Potatoland', '069 5555 44 33', 1, 2, 0),
(77, 'TEST ITEM 07', 2, 234, 2, 5, 2, '2021-06-26 01:09:25', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75                ', 0, NULL, 0),
(76, '06', 2, 234, 1, 5, 2, '2021-06-25 22:41:22', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, 2, 0),
(74, '04', 2, 234, 1, 5, 2, '2021-06-25 22:41:22', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, 2, 0),
(75, '05', 2, 234, 1, 5, 2, '2021-06-26 01:09:25', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, 2, 0),
(73, '03', 2, 234, 1, 5, 2, '2021-06-25 19:02:15', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, 2, 0),
(71, '01', 2, 234, 1, 5, 2, '2021-06-25 18:51:55', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, 2, 0),
(72, '02', 2, 234, 3, 5, 2, '2021-06-25 19:00:45', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, NULL, 0),
(88, '18', 5, 45, 1, 9, 1, '2021-06-27 00:04:08', '<p>VERY NEW</p>', 'Hell', '069 1111 22 33', 0, 2, 0),
(82, '14', 2, 234, 1, 5, 2, '2021-06-26 02:00:44', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, 2, 0),
(83, '13', 2, 234, 1, 5, 2, '2021-06-26 02:29:19', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, 5, 0),
(84, '14', 2, 234, 1, 5, 2, '2021-06-26 02:29:31', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, 2, 0),
(85, '15', 2, 234, 1, 5, 2, '2021-06-26 02:29:49', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 0, 2, 0),
(86, '16', 2, 234, 1, 5, 2, '2021-06-26 02:30:05', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 2, 0),
(87, '17', 2, 234, 1, 5, 2, '2021-06-26 02:30:24', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75                ', 0, 2, 0),
(90, 'TESTING 123', 2, 465, 1, 6, 2, '2021-06-30 16:12:36', '<p>asdsadsad</p>', 'Underworld', '069 1234 56 75', 0, 3, 0),
(91, 'TEST 545', 2, 456, 1, 9, 3, '2021-06-30 16:12:48', '<p>sdgsdfg</p>', 'Underworld', '069 1234 56 75', 1, 2, 0),
(92, 'MS test', 1, 123, 1, 5, 2, '2021-06-30 17:31:17', '<p>sedgsdgsdg</p>', 'Hell', '069 543 23 42', 1, 2, 0),
(93, '10', 2, 234, 1, 5, 2, '2021-06-25 19:00:45', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 2, 0),
(94, '16', 2, 234, 1, 5, 2, '2021-06-26 02:30:05', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 2, 0),
(95, '17', 2, 234, 1, 5, 2, '2021-06-26 02:30:24', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75                ', 0, 2, 0),
(96, '10', 2, 234, 1, 5, 2, '2021-06-25 19:00:45', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 1, 0),
(97, '16', 2, 234, 1, 5, 2, '2021-06-26 02:30:05', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 1, 0),
(98, '17', 2, 234, 1, 5, 2, '2021-06-26 02:30:24', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75                ', 0, 5, 0),
(99, '10', 2, 234, 1, 5, 2, '2021-06-25 19:00:45', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 1, 0),
(100, '16', 2, 234, 1, 5, 2, '2021-06-26 02:30:05', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 1, 0),
(101, '17', 2, 234, 1, 5, 2, '2021-06-26 02:30:24', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75                ', 0, 5, 0),
(102, '10', 2, 234, 1, 5, 2, '2021-06-25 19:00:45', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 1, 0),
(103, '16', 2, 234, 1, 5, 2, '2021-06-26 02:30:05', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 1, 0),
(104, '17', 2, 234, 1, 5, 2, '2021-06-26 02:30:24', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75                ', 0, 5, 0),
(105, '16', 2, 234, 1, 5, 2, '2021-06-26 02:30:05', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75', 1, 1, 0),
(106, '17', 2, 234, 1, 5, 2, '2021-06-26 02:30:24', '<p>dfgdfgd</p>', 'Underworld', '069 1234 56 75                ', 0, 5, 0),
(107, 'SDGISDGIJDSG', 2, 45654, 4, 1, 2, '2021-06-30 21:44:32', '<p>fdgdfdfgdf</p>', 'Underworld', '069 1234 56 75', 0, NULL, 0),
(108, 'TEST ITEM 65', 1, 234, 7, 1, 2, '2021-07-01 01:08:16', '<p>dfgdfgdfg</p>', 'Hell', '065 3242 6548                ', 0, 2, 0),
(109, 'TEST ITEM 124', 2, 200, 1, 14, 1, '2021-07-03 02:21:26', '<p>test 00000</p>', 'Underworld', '06912345675                                                 ', 0, NULL, 0),
(110, 'TEST ITEM 353', 2, 111, 1, 10, 2, '2021-07-04 19:03:11', '<p>11111111</p>', 'Underworld', '06912345675                 ', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_post_report`
--

DROP TABLE IF EXISTS `item_post_report`;
CREATE TABLE IF NOT EXISTS `item_post_report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `reporting_user_id` int(11) NOT NULL,
  `report_type` int(11) NOT NULL,
  `report_addressed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_post_report`
--

INSERT INTO `item_post_report` (`report_id`, `item_id`, `reporting_user_id`, `report_type`, `report_addressed`) VALUES
(9, 81, 1, 2, 1),
(8, 79, 1, 1, 1),
(7, 107, 1, 3, 1),
(6, 109, 1, 1, 0),
(5, 107, 6, 2, 1),
(10, 108, 1, 2, 1),
(11, 108, 1, 2, 1),
(12, 110, 1, 3, 0),
(13, 81, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_views`
--

DROP TABLE IF EXISTS `item_views`;
CREATE TABLE IF NOT EXISTS `item_views` (
  `view_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `viewers_ip` text NOT NULL,
  `viewing_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewed_item_id` int(11) NOT NULL,
  PRIMARY KEY (`view_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_views`
--

INSERT INTO `item_views` (`view_id`, `viewers_ip`, `viewing_date`, `viewed_item_id`) VALUES
(20, '::1', '2021-06-24 20:27:51', 19),
(2, '::1', '2021-06-18 20:58:23', 1),
(3, '::1', '2021-06-18 20:59:38', 3),
(4, '::1', '2021-06-18 20:59:39', 2),
(5, '::1', '2021-06-18 20:59:41', 4),
(6, '::1', '2021-06-21 16:45:46', 15),
(19, '::1', '2021-06-23 22:43:15', 17),
(8, '::1', '2021-06-23 20:43:48', 5),
(9, '::1', '2021-06-23 20:43:55', 6),
(10, '::1', '2021-06-23 20:45:44', 7),
(11, '::1', '2021-06-23 20:45:52', 16),
(12, '::1', '2021-06-23 20:45:57', 8),
(13, '::1', '2021-06-23 20:46:03', 9),
(14, '::1', '2021-06-23 20:46:10', 10),
(15, '::1', '2021-06-23 20:48:31', 11),
(16, '::1', '2021-06-23 20:48:38', 13),
(17, '::1', '2021-06-23 20:48:49', 14),
(18, '::1', '2021-06-23 20:50:19', 12),
(21, '::1', '2021-06-24 20:28:14', 18),
(22, '::1', '2021-06-24 23:15:38', 44),
(23, '::1', '2021-06-25 00:20:01', 49),
(24, '::1', '2021-06-25 02:19:47', 55),
(25, '::1', '2021-06-25 13:45:39', 57),
(26, '::1', '2021-06-25 13:45:41', 56),
(27, '::1', '2021-06-25 15:01:27', 70),
(28, '::1', '2021-06-25 18:53:10', 71),
(29, '::1', '2021-06-25 19:03:41', 73),
(30, '::1', '2021-06-25 20:38:04', 72),
(31, '::1', '2021-06-25 22:41:24', 74),
(32, '::1', '2021-06-26 02:34:49', 87),
(33, '::1', '2021-06-26 02:37:59', 86),
(34, '::1', '2021-06-26 02:59:45', 81),
(35, '::1', '2021-06-26 02:59:47', 79),
(36, '::1', '2021-06-26 02:59:49', 78),
(37, '::1', '2021-06-26 03:11:49', 75),
(38, '::1', '2021-06-26 03:11:55', 76),
(39, '::1', '2021-06-26 03:12:01', 77),
(40, '::1', '2021-06-26 03:12:53', 80),
(41, '::1', '2021-06-26 03:13:08', 82),
(42, '::1', '2021-06-26 03:13:18', 83),
(43, '::1', '2021-06-26 03:13:26', 84),
(44, '::1', '2021-06-26 03:13:31', 85),
(45, '::1', '2021-06-27 00:04:11', 88),
(46, '::1', '2021-06-27 00:05:31', 89),
(47, '::1', '2021-06-30 17:31:19', 92),
(48, '::1', '2021-06-30 19:15:09', 91),
(49, '::1', '2021-06-30 21:33:31', 90),
(50, '::1', '2021-06-30 21:59:22', 107),
(51, '::1', '2021-07-01 01:08:20', 108),
(52, '::1', '2021-07-03 21:48:17', 109),
(53, '::1', '2021-07-04 19:03:13', 110);

-- --------------------------------------------------------

--
-- Table structure for table `quick_news`
--

DROP TABLE IF EXISTS `quick_news`;
CREATE TABLE IF NOT EXISTS `quick_news` (
  `quick_news_id` int(99) NOT NULL AUTO_INCREMENT,
  `quick_news_title` text NOT NULL,
  `quick_news_text` text NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`quick_news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quick_news`
--

INSERT INTO `quick_news` (`quick_news_id`, `quick_news_title`, `quick_news_text`, `deleted`) VALUES
(245, 'Sale numbers for MAY', '<p>Monthly sale chart for month MAY. Lots of great deals are still around be sure to check them.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h2>Category ranking by total sales during APRIL</h2>\n<p>[1] Computers | Desktop / 5235</p>\n<p>[2] Computers | Laptop and tablet / 2456</p>\n<p>[3] Electronics and components / 1456</p>\n<p>[4] Consoles and games / 985</p>\n<p>[6] Mobile phones / 766</p>\n<p>[6] Mobile phones | gadgets and parts / 435</p>\n<p>[7] TV and Video / 342</p>\n<p>[8] Audio / 152</p>\n<p>[9] Electronics and lights / 45</p>\n<p class=\"categorys point\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; cursor: pointer; color: #ffffff; font-family: Arial; font-size: 14px;\" data-id=\"9\">&nbsp;</p>', 0),
(246, 'Sale numbers for JUNE', '<p>Monthly sale chart for month JUNE. Lots of great deals are still around be sure to check them.</p>\n<p>&nbsp;</p>\n<p><img src=\"https://www.protocol.com/media-library/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpbWFnZSI6Imh0dHBzOi8vYXNzZXRzLnJibC5tcy8yNDgwODAyNi9vcmlnaW4uanBnIiwiZXhwaXJlc19hdCI6MTY0Nzk1OTgyN30.EB6VeFCGJ6tY_G1nZkf3T1LVSoN4Xeb0HDWQc0HSo8g/image.jpg?width=1245&amp;quality=85&amp;coordinates=28%2C0%2C29%2C0&amp;height=700\" alt=\"\" width=\"600\" height=\"337\" /></p>\n<h2>Category ranking by total sales during JUNE</h2>\n<p>[1] Computers | Desktop / 5235</p>\n<p>[2] Computers | Laptop and tablet / 2456</p>\n<p>[3] Electronics and components / 1456</p>\n<p>[4] Consoles and games / 985</p>\n<p>[6] Mobile phones / 766</p>\n<p>[6] Mobile phones | gadgets and parts / 435</p>\n<p>[7] TV and Video / 342</p>\n<p>[8] Audio / 152</p>\n<p>[9] Electronics and lights / 45</p>\n<p>&nbsp;</p>\n<p class=\"categorys point\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; cursor: pointer; color: #ffffff; font-family: Arial; font-size: 14px;\" data-id=\"9\">&nbsp;</p>', 0),
(244, 'Sale numbers for APRIL', '<p>Monthly sale chart for month APRIL. Lots of great deals are still around be sure to check them.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h2>Category ranking by total sales during APRIL</h2>\n<p>[1] Computers | Desktop / 5235</p>\n<p>[2] Computers | Laptop and tablet / 2456</p>\n<p>[3] Electronics and components / 1456</p>\n<p>[4] Consoles and games / 985</p>\n<p>[6] Mobile phones / 766</p>\n<p>[6] Mobile phones | gadgets and parts / 435</p>\n<p>[7] TV and Video / 342</p>\n<p>[8] Audio / 152</p>\n<p>[9] Electronics and lights / 45</p>\n<p class=\"categorys point\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; border: 0px; cursor: pointer; color: #ffffff; font-family: Arial; font-size: 14px;\" data-id=\"9\">&nbsp;</p>', 0),
(243, 'ARK TITLE 011', '<p>Proin gravida ligula quis purus euismod bibendum. Cras tristique, lacus non iaculis porta, elit ipsum varius ante, eget tempus ex est ut urna. Fusce felis ipsum, vestibulum quis nisi ut, malesuada efficitur orci. Mauris vitae felis nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et lacus sagittis, faucibus tellus quis, porta enim. Praesent tempus volutpat est, eu maximus quam mollis luctus. Aliquam ac sollicitudin odio. Morbi facilisis tristique sem, at rutrum mauris. Fusce fermentum libero magna, non vulputate neque tincidunt faucibus. Nullam pharetra lorem a quam elementum semper. Pellentesque quis dignissim justo, ut volutpat sapien. Sed luctus, elit sed pretium cursus, justo urna fermentum mi, sit amet ornare metus dui in velit. Ut blandit ipsum quis vestibulum molestie. Vestibulum gravida flis nlla.</p>', 0),
(240, 'ARK TITLE 008', '<p>Proin gravida ligula quis purus euismod bibendum. Cras tristique, lacus non iaculis porta, elit ipsum varius ante, eget tempus ex est ut urna. Fusce felis ipsum, vestibulum quis nisi ut, malesuada efficitur orci. Mauris vitae felis nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et lacus sagittis, faucibus tellus quis, porta enim. Praesent tempus volutpat est, eu maximus quam mollis luctus. Aliquam ac sollicitudin odio. Morbi facilisis tristique sem, at rutrum mauris. Fusce fermentum libero magna, non vulputate neque tincidunt faucibus. Nullam pharetra lorem a quam elementum semper. Pellentesque quis dignissim justo, ut volutpat sapien. Sed luctus, elit sed pretium cursus, justo urna fermentum mi, sit amet ornare metus dui in velit. Ut blandit ipsum quis vestibulum molestie. Vestibulum gravida felis null.</p>', 0),
(241, 'ARK TITLE 009', '<p>Proin gravida ligula quis purus euismod bibendum. Cras tristique, lacus non iaculis porta, elit ipsum varius ante, eget tempus ex est ut urna. Fusce felis ipsum, vestibulum quis nisi ut, malesuada efficitur orci. Mauris vitae felis nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et lacus sagittis, faucibus tellus quis, porta enim. Praesent tempus volutpat est, eu maximus quam mollis luctus. Aliquam ac sollicitudin odio. Morbi facilisis tristique sem, at rutrum mauris. Fusce fermentum libero magna, non vulputate neque tincidunt faucibus. Nullam pharetra lorem a quam elementum semper. Pellentesque quis dignissim justo, ut volutpat sapien. Sed luctus, elit sed pretium cursus, justo urna fermentum mi, sit amet ornare metus dui in velit. Ut blandit ipsum quis vestibulum molestie. Vestibulum gravida felis nula.</p>', 0),
(242, 'ARK TITLE 010', '<p>Proin gravida ligula quis purus euismod bibendum. Cras tristique, lacus non iaculis porta, elit ipsum varius ante, eget tempus ex est ut urna. Fusce felis ipsum, vestibulum quis nisi ut, malesuada efficitur orci. Mauris vitae felis nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et lacus sagittis, faucibus tellus quis, porta enim. Praesent tempus volutpat est, eu maximus quam mollis luctus. Aliquam ac sollicitudin odio. Morbi facilisis tristique sem, at rutrum mauris. Fusce fermentum libero magna, non vulputate neque tincidunt faucibus. Nullam pharetra lorem a quam elementum semper. Pellentesque quis dignissim justo, ut volutpat sapien. Sed luctus, elit sed pretium cursus, justo urna fermentum mi, sit amet ornare metus dui in velit. Ut blandit ipsum quis vestibulum molestie. Vestibulum gravida flis nulla.</p>', 0),
(239, 'ARK TITLE 007', '<p>Proin gravida ligula quis purus euismod bibendum. Cras tristique, lacus non iaculis porta, elit ipsum varius ante, eget tempus ex est ut urna. Fusce felis ipsum, vestibulum quis nisi ut, malesuada efficitur orci. Mauris vitae felis nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et lacus sagittis, faucibus tellus quis, porta enim. Praesent tempus volutpat est, eu maximus quam mollis luctus. Aliquam ac sollicitudin odio. Morbi facilisis tristique sem, at rutrum mauris. Fusce fermentum libero magna, non vulputate neque tincidunt faucibus. Nullam pharetra lorem a quam elementum semper. Pellentesque quis dignissim justo, ut volutpat sapien. Sed luctus, elit sed pretium cursus, justo urna fermentum mi, sit amet ornare metus dui in velit. Ut blandit ipsum quis vestibulum molestie. Vestibulum gravida felis nullaa.</p>', 0),
(238, 'ARK TITLE 006', '<p>Proin gravida ligula quis purus euismod bibendum. Cras tristique, lacus non iaculis porta, elit ipsum varius ante, eget tempus ex est ut urna. Fusce felis ipsum, vestibulum quis nisi ut, malesuada efficitur orci. Mauris vitae felis nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et lacus sagittis, faucibus tellus quis, porta enim. Praesent tempus volutpat est, eu maximus quam mollis luctus. Aliquam ac sollicitudin odio. Morbi facilisis tristique sem, at rutrum mauris. Fusce fermentum libero magna, non vulputate neque tincidunt faucibus. Nullam pharetra lorem a quam elementum semper. Pellentesque quis dignissim justo, ut volutpat sapien. Sed luctus, elit sed pretium cursus, justo urna fermentum mi, sit amet ornare metus dui in velit. Ut blandit ipsum quis vestibulum molestie. Vestibulum gravida felis nulla.</p>', 0),
(237, 'ARK TITLE 005', '<p style=\"text-align: left; margin: 0px 0px 15px; padding: 0px; background-color: #ffffff;\">Proin gravida ligula quis purus euismod bibendum. Cras tristique, lacus non iaculis porta, elit ipsum varius ante, eget tempus ex est ut urna. Fusce felis ipsum, vestibulum quis nisi ut, malesuada efficitur orci. Mauris vitae felis nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et lacus sagittis, faucibus tellus quis, porta enim. Praesent tempus volutpat est, eu maximus quam mollis luctus. Aliquam ac sollicitudin odio. Morbi facilisis tristique sem, at rutrum mauris. Fusce fermentum libero magna, non vulputate neque tincidunt faucibus. Nullam pharetra lorem a quam elementum semper. Pellentesque quis dignissim justo, ut volutpat sapien. Sed luctus, elit sed pretium cursus, justo urna fermentum mi, sit amet ornare metus dui in velit. Ut blandit ipsum quis vestibulum molestie. Vestibulum gravida felis nulla.</p>', 0),
(234, 'ARK TEST 002', '<p>\r\nVestibulum id ultrices ligula. Pellentesque suscipit elementum turpis eu euismod. Sed eu urna at lacus tincidunt suscipit. Aenean vitae volutpat nisl. Etiam in risus ac augue tristique convallis non sed nibh. Phasellus turpis dolor, egestas eget suscipit non, posuere non elit. Vestibulum posuere dapibus ligula id pulvinar. Aliquam eu libero quis lorem eleifend tristique. Nullam id nisi diam. Quisque rhoncus cursus quam, eu accumsan nisl imperdiet sed. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc eget gravida sapien.</p>', 0),
(235, 'ARK TEST 003', '<p>\r\nNam eget placerat sapien, id bibendum tortor. Pellentesque facilisis neque mattis lacus feugiat mattis nec id erat. Maecenas ultricies est non sem maximus, ut facilisis ex porttitor. Cras a consequat lorem. Cras tempus arcu faucibus neque ultrices, sit amet euismod lorem laoreet. Aenean in vulputate dolor, sit amet rutrum quam. Integer efficitur vehicula maximus. Vestibulum at massa in neque tristique varius. Donec at libero bibendum, faucibus velit vel, malesuada diam.\r\n<br><br>\r\n\r\nVestibulum id ultrices ligula. Pellentesque suscipit elementum turpis eu euismod. Sed eu urna at lacus tincidunt suscipit. Aenean vitae volutpat nisl. Etiam in risus ac augue tristique convallis non sed nibh. Phasellus turpis dolor, egestas eget suscipit non, posuere non elit. Vestibulum posuere dapibus ligula id pulvinar. Aliquam eu libero quis lorem eleifend tristique. Nullam id nisi diam. Quisque rhoncus cursus quam, eu accumsan nisl imperdiet sed. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc eget gravida sapien.</p>', 0),
(236, 'ARK TEST 004', '<p>Proin gravida ligula quis purus euismod bibendum. Cras tristique, lacus non iaculis porta, elit ipsum varius ante, eget tempus ex est ut urna. Fusce felis ipsum, vestibulum quis nisi ut, malesuada efficitur orci. Mauris vitae felis nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et lacus sagittis, faucibus tellus quis, porta enim. Praesent tempus volutpat est, eu maximus quam mollis luctus. Aliquam ac sollicitudin odio. Morbi facilisis tristique sem, at rutrum mauris. Fusce fermentum libero magna, non vulputate neque tincidunt faucibus. Nullam pharetra lorem a quam elementum semper. Pellentesque quis dignissim justo, ut volutpat sapien. Sed luctus, elit sed pretium cursus, justo urna fermentum mi, sit amet ornare metus dui in velit. Ut blandit ipsum quis vestibulum molestie. Vestibulum gravida felis nulla.\r\n\r\nOrci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu nunc tristique, ultrices lacus et, hendrerit dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris at tempus lorem, nec hendrerit dui. Duis sit amet ullamcorper metus. Phasellus lacus purus, luctus quis nisl non, pretium sodales augue. Proin neque metus, maximus venenatis hendrerit a, dictum sit amet justo. Donec condimentum, turpis vel iaculis mollis, lorem enim ultrices urna, congue dignissim leo mi ac magna. Donec tristique sapien mauris.</p', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

DROP TABLE IF EXISTS `user_ratings`;
CREATE TABLE IF NOT EXISTS `user_ratings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rating_target_id` int(10) NOT NULL,
  `rating_user_id` int(10) NOT NULL,
  `rating_value` int(1) NOT NULL,
  `rating_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_ratings`
--

INSERT INTO `user_ratings` (`id`, `rating_target_id`, `rating_user_id`, `rating_value`, `rating_date`) VALUES
(1, 3, 1, 4, '2021-05-17 23:28:25'),
(2, 1, 2, 3, '2021-05-17 23:28:25');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_account_comments`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_account_comments`;
CREATE TABLE IF NOT EXISTS `view_account_comments` (
`account_comments_id` int(10) unsigned
,`account_comments_target` int(10)
,`account_comments_replay_target` int(10)
,`account_username` varchar(20)
,`account_comments_user_id` int(10)
,`account_comments_item_name` text
,`account_comments_content` text
,`account_comments_date` timestamp
,`account_comments_type` int(10)
,`deleted` int(1)
,`comment_correct_desc` int(10)
,`comment_good_communication` int(10)
,`comment_good_deal` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_item_bookmarks`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_item_bookmarks`;
CREATE TABLE IF NOT EXISTS `view_item_bookmarks` (
`bookmark_owner_id` int(11)
,`bookmark_item_id` int(11)
,`item_id` int(11) unsigned
,`item_name` varchar(50)
,`item_price` int(11)
,`item_post_date` timestamp
,`sold_to` int(11)
,`deleted` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_item_posts`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_item_posts`;
CREATE TABLE IF NOT EXISTS `view_item_posts` (
`item_id` int(11) unsigned
,`item_name` varchar(50)
,`item_owner_id` int(11)
,`account_username` varchar(20)
,`item_price` int(11)
,`item_category_id` int(11)
,`item_category_name` text
,`item_group_name` text
,`item_group_id` int(11)
,`item_state` int(11)
,`item_post_date` timestamp
,`item_description` text
,`item_city` varchar(30)
,`item_phone_num` text
,`item_rated` int(11)
,`sold_to` int(11)
,`deleted` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_item_reports`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_item_reports`;
CREATE TABLE IF NOT EXISTS `view_item_reports` (
`report_id` int(11)
,`item_id` int(11)
,`report_reason` int(11)
,`report_addressed` int(11)
,`item_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_purchase_history`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_purchase_history`;
CREATE TABLE IF NOT EXISTS `view_purchase_history` (
`item_id` int(11) unsigned
,`item_name` varchar(50)
,`item_price` int(11)
,`item_owner_id` int(11)
,`purchased_from_name` varchar(20)
,`item_category_id` int(11)
,`item_category_name` text
,`item_group_name` text
,`item_group_id` int(11)
,`sold_to_id` int(11)
,`item_rated` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sale_history`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_sale_history`;
CREATE TABLE IF NOT EXISTS `view_sale_history` (
`item_id` int(11) unsigned
,`item_name` varchar(50)
,`item_price` int(11)
,`item_owner_id` int(11)
,`item_category_id` int(11)
,`item_category_name` text
,`item_group_name` text
,`item_group_id` int(11)
,`sold_to_name` varchar(20)
,`sold_to_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Structure for view `view_account_comments`
--
DROP TABLE IF EXISTS `view_account_comments`;

DROP VIEW IF EXISTS `view_account_comments`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_account_comments`  AS  select `account_comments`.`account_comments_id` AS `account_comments_id`,`account_comments`.`account_comments_target` AS `account_comments_target`,`account_comments`.`account_comments_replay_target` AS `account_comments_replay_target`,`accounts`.`account_username` AS `account_username`,`account_comments`.`account_comments_user_id` AS `account_comments_user_id`,`account_comments`.`account_comments_item_name` AS `account_comments_item_name`,`account_comments`.`account_comments_content` AS `account_comments_content`,`account_comments`.`account_comments_date` AS `account_comments_date`,`account_comments`.`account_comments_type` AS `account_comments_type`,`account_comments`.`deleted` AS `deleted`,`account_comments`.`comment_correct_desc` AS `comment_correct_desc`,`account_comments`.`comment_good_communication` AS `comment_good_communication`,`account_comments`.`comment_good_deal` AS `comment_good_deal` from (`account_comments` join `accounts` on((`account_comments`.`account_comments_user_id` = `accounts`.`account_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_item_bookmarks`
--
DROP TABLE IF EXISTS `view_item_bookmarks`;

DROP VIEW IF EXISTS `view_item_bookmarks`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_item_bookmarks`  AS  select `item_bookmarks`.`bookmark_owner_id` AS `bookmark_owner_id`,`item_bookmarks`.`bookmark_item_id` AS `bookmark_item_id`,`item_posts`.`item_id` AS `item_id`,`item_posts`.`item_name` AS `item_name`,`item_posts`.`item_price` AS `item_price`,`item_posts`.`item_post_date` AS `item_post_date`,`item_posts`.`sold_to` AS `sold_to`,`item_posts`.`deleted` AS `deleted` from (`item_bookmarks` join `item_posts` on((`item_bookmarks`.`bookmark_item_id` = `item_posts`.`item_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_item_posts`
--
DROP TABLE IF EXISTS `view_item_posts`;

DROP VIEW IF EXISTS `view_item_posts`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_item_posts`  AS  select `item_posts`.`item_id` AS `item_id`,`item_posts`.`item_name` AS `item_name`,`item_posts`.`item_owner_id` AS `item_owner_id`,`accounts`.`account_username` AS `account_username`,`item_posts`.`item_price` AS `item_price`,`item_categories`.`item_category_id` AS `item_category_id`,`item_categories`.`item_category_name` AS `item_category_name`,`item_groups`.`item_group_name` AS `item_group_name`,`item_groups`.`item_group_id` AS `item_group_id`,`item_posts`.`item_state` AS `item_state`,`item_posts`.`item_post_date` AS `item_post_date`,`item_posts`.`item_description` AS `item_description`,`item_posts`.`item_city` AS `item_city`,`item_posts`.`item_phone_num` AS `item_phone_num`,`item_posts`.`item_rated` AS `item_rated`,`item_posts`.`sold_to` AS `sold_to`,`item_posts`.`deleted` AS `deleted` from (((`item_posts` join `item_categories` on((`item_categories`.`item_category_id` = `item_posts`.`item_category`))) join `item_groups` on((`item_groups`.`item_group_id` = `item_posts`.`item_group`))) join `accounts` on((`accounts`.`account_id` = `item_posts`.`item_owner_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_item_reports`
--
DROP TABLE IF EXISTS `view_item_reports`;

DROP VIEW IF EXISTS `view_item_reports`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_item_reports`  AS  select `item_post_report`.`report_id` AS `report_id`,`item_post_report`.`item_id` AS `item_id`,`item_post_report`.`report_type` AS `report_reason`,`item_post_report`.`report_addressed` AS `report_addressed`,`item_posts`.`item_name` AS `item_name` from (`item_post_report` join `item_posts` on((`item_post_report`.`item_id` = `item_posts`.`item_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_purchase_history`
--
DROP TABLE IF EXISTS `view_purchase_history`;

DROP VIEW IF EXISTS `view_purchase_history`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_purchase_history`  AS  select `item_posts`.`item_id` AS `item_id`,`item_posts`.`item_name` AS `item_name`,`item_posts`.`item_price` AS `item_price`,`item_posts`.`item_owner_id` AS `item_owner_id`,`accounts`.`account_username` AS `purchased_from_name`,`item_categories`.`item_category_id` AS `item_category_id`,`item_categories`.`item_category_name` AS `item_category_name`,`item_groups`.`item_group_name` AS `item_group_name`,`item_groups`.`item_group_id` AS `item_group_id`,`item_posts`.`sold_to` AS `sold_to_id`,`item_posts`.`item_rated` AS `item_rated` from (((`item_posts` join `item_categories` on((`item_categories`.`item_category_id` = `item_posts`.`item_category`))) join `item_groups` on((`item_groups`.`item_group_id` = `item_posts`.`item_group`))) join `accounts` on((`accounts`.`account_id` = `item_posts`.`item_owner_id`))) where ((`item_posts`.`deleted` = 0) and (`item_posts`.`sold_to` is not null)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_sale_history`
--
DROP TABLE IF EXISTS `view_sale_history`;

DROP VIEW IF EXISTS `view_sale_history`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sale_history`  AS  select `item_posts`.`item_id` AS `item_id`,`item_posts`.`item_name` AS `item_name`,`item_posts`.`item_price` AS `item_price`,`item_posts`.`item_owner_id` AS `item_owner_id`,`item_categories`.`item_category_id` AS `item_category_id`,`item_categories`.`item_category_name` AS `item_category_name`,`item_groups`.`item_group_name` AS `item_group_name`,`item_groups`.`item_group_id` AS `item_group_id`,`accounts`.`account_username` AS `sold_to_name`,`accounts`.`account_id` AS `sold_to_id` from (((`item_posts` join `item_categories` on((`item_categories`.`item_category_id` = `item_posts`.`item_category`))) join `item_groups` on((`item_groups`.`item_group_id` = `item_posts`.`item_group`))) join `accounts` on((`accounts`.`account_id` = `item_posts`.`sold_to`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
